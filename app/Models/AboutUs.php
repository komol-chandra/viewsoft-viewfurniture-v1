<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory;
    public static function booted()
    {
        static::saving(function ($model) {
            Cache::forget('aboutUs');
        });

        static::updating(function ($model) {
            Cache::forget('aboutUs');
        });

        static::deleting(function ($model) {
            //
        });
    }
}
