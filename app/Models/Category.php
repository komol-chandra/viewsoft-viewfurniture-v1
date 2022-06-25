<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
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
    public function Product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function activeProduct()
    {
        return $this->hasMany('App\Models\Product')->where('is_active', 1)->where('is_deleted', 0)->where('is_approve', 1)->orderBy('sell_qty', 'DESC');
    }

    public function subCategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category')->where('is_active', 1)->where('is_deleted', 0);
    }
    public function reSubCategory()
    {
        return $this->hasMany('App\Models\ResubCategory', 'category')->where('is_active', 1)->where('is_deleted', 0);
    }
    public static function booted()
    {
        static::saving(function ($model) {
            Cache::forget('maincate');
            Cache::forget('limitCategory');
            Cache::forget('categories');
        });

        static::updating(function ($model) {
            Cache::forget('maincate');
            Cache::forget('limitCategory');
            Cache::forget('categories');
        });

        static::deleting(function ($model) {
            //
        });
    }
}
