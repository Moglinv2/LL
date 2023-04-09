<?php

namespace App\Models\Profit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referer extends Model
{
    use HasFactory;

    protected $table = 'referers_profit';

    protected $fillable = [
        'user_id',
        'referer_id',
        'amount'
    ];
}
