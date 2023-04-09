<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'reason',
        'amount',
        'fee',
        'txId'
    ];

    protected $appends = [
        'total'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalAttribute()
    {
        return $this->amount - $this->fee;        
    }
    
}
