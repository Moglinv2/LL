<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryTicket extends Model
{
    use HasFactory;

    protected $fillable = ['numbers', 'price', 'profit', 'expired_at'];
    protected $casts = [
        'numbers' => 'array',
        'price' => 'float'
    ];

    public function scopeActive($query)
    {
        return $query->where('profit', null);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
