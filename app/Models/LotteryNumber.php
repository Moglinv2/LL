<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryNumber extends Model
{
    use HasFactory;

    protected $fillable = ['numbers'];
    protected $casts = [
        'numbers' => 'array'
    ];

    public static function GenerateNumbers()
    {
        $numbers = [0, 0, 0, 0, 0, 0, 0];

        while (in_array(0, $numbers)) {
            $new_number = rand(1, 60);
            if (!in_array($new_number, $numbers)) {
                $numbers[array_search(0, $numbers)] = $new_number;
            }
        }

        sort($numbers);
        return new LotteryNumber(['numbers' => $numbers]);
    }

    public static function Accumulated()
    {
        return 1000 + LotteryTicket::sum('price') - LotteryTicket::sum('profit');
    }
}
