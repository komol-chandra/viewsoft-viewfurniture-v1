<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Banner extends Model
{
    use HasFactory;
    // protected $fillable = ['title', 'discount', 'image', 'url', 'short_desc'];

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
            Cache::forget('banners');
        });

        static::updating(function ($model) {
            Cache::forget('banners');
        });

        static::deleting(function ($model) {
            //
        });
    }
}
