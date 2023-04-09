<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'plan', 'expired_at'];

    public function scopeEco($query)
    {
        return $query->where('plan', 'eco');
    }

    public function scopeRocket($query)
    {
        return $query->where('plan', 'rocket');
    }

    public function scopeActive($query)
    {
        return $query->where('expired_at', '>', Carbon::now());
    }
}
