<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referer_id',
        'balance',
        'profit',
        'withdraw_address',
        'referer_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function Referers()
    {
        return $this->hasMany(User::class, 'referer_id', 'id');
    }

    public function Parent()
    {
        return $this->belongsTo(User::class, 'referer_id');
    }

    public function Deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function Investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function Withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function RefererProfits()
    {
        return $this->hasMany(Profit\Referer::class);
    }

    public function MinerProfits()
    {
        return $this->hasMany(MinerProfit::class);
    }

    public function LotteryTickets()
    {
        return $this->hasMany(LotteryTicket::class);
    }

    public function ActiveLotteryTickets()
    {
        return $this->LotteryTickets()->Active();
    }

    public function getRocketPriceAttribute()
    {
        return (($this->total_investment * 4) / 100) - $this->rocket_total;
    }

    public function getIsRocketActiveAttribute()
    {
        return $this->rocket_total >= ($this->total_investment * 4) / 100;
    }

    public function getRocketTotalAttribute()
    {
        return $this->Investments()->rocket()->sum('amount');
    }

    public function getTotalInvestmentAttribute()
    {
        return $this->Investments()->eco()->sum('amount');
    }

    public function getTotalActiveInvestmentAttribute()
    {
        return $this->Investments()->eco()->active()->sum('amount');
    }

    public function getTotalProfitAttribute()
    {
        return $this->RefererProfits()->sum('amount') + $this->MinerProfits()->sum('amount') + $this->LotteryTickets()->sum('profit');
    }

    public function getReferersCountAttribute()
    {
        $referers = [
            [
                'total' => 0,
                'active' => 0
            ],
            [
                'total' => 0,
                'active' => 0
            ],
            [
                'total' => 0,
                'active' => 0
            ]
        ];

        $referers[0]['total'] = $this->Referers()->count();
        $referers[0]['active'] = $this->Referers()->has('deposits')->count();

        foreach ($this->Referers()->lazy() as $referer) {
            $referers[1]['total'] += $referer->Referers()->count();
            $referers[1]['active'] += $referer->Referers()->has('deposits')->count();


            foreach ($referer->Referers()->lazy() as $referer) {
                $referers[2]['total'] += $referer->Referers()->count();
                $referers[2]['active'] += $referer->Referers()->has('deposits')->count();
            }
        }

        return $referers;
    }
    public function fixBalance()
    {
        $deposits = $this->Deposits()->sum('amount');
        $invesments = $this->Investments()->sum('amount');
        $lottery_tickets = $this->LotteryTickets()->sum('price');

        $this->update([
            'balance' => $deposits - ($invesments + $lottery_tickets)
        ]);
    }

    public function fixProfit()
    {
        $withdraws = $this->Withdraws()->sum('amount');
        $this->update([
            'profit' => $this->total_profit - $withdraws
        ]);
    }

    public function MakeDeposit($depositData)
    {
        $newDeposit = $this->Deposits()->create($depositData);
        $this->fixBalance();
        $this->PayReferer($depositData['amount']);
        return $newDeposit;
    }

    public function PayReferer($amount, $level = 0)
    {
        $rates = [
            config('system.referer_profit_1', 10),
            config('system.referer_profit_2', 8),
            config('system.referer_profit_3', 6),
        ];
        $profit = ($amount * $rates[$level]) / 100;

        $parent = $this->Parent()->first();
        if ($parent) {
            $profit_limit = $parent->total_investment * 2;
            $total_profit = $parent->total_profit;
            $profit = ($profit + $total_profit > $profit_limit) ? $profit_limit - $total_profit  : $profit;

            $profit = $parent->RefererProfits()->create([
                'referer_id' => $this->id,
                'amount' => $profit
            ]);

            $parent->fixProfit();

            if ($level < 2) {
                $level++;
                $parent->PayReferer($amount, $level);
            }
        }
    }

    public function Mined()
    {
        $profit_limit = $this->total_investment * 2;
        $total_profit = $this->total_profit;

        if ($total_profit < $profit_limit) {
            $investment_profit = ($this->is_rocket_active) ? config('system.boost_profit', 1.7) : config('system.plan_profit', 0.4);
            $profit = ($this->total_active_investment * $investment_profit) / 100;
            $profit = ($profit + $total_profit > $profit_limit) ? $profit_limit - $total_profit  : $profit;

            $this->minerProfits()->create([
                'amount' => $profit
            ]);

            $this->fixProfit();
        }
    }

    public function ScopeName($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }
}
