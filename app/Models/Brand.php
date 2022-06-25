<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeIsDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }
    public static function booted()
    {
        static::saving(function ($model) {
            Cache::forget('brands');
        });

        static::updating(function ($model) {
            Cache::forget('brands');
        });

        static::deleting(function ($model) {
            //
        });
    }
}
