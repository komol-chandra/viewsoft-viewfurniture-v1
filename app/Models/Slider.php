<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Slider extends Model
{
    use HasFactory;

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
    public static function booted()
    {
        static::saving(function ($model) {
            Cache::forget('sliders');
        });

        static::updating(function ($model) {
            Cache::forget('sliders');
        });

        static::deleting(function ($model) {
            //
        });
    }
}
