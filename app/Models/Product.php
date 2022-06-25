<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;
    public function Review()
    {
        return $this->hasMany(Review::class, 'product_id', 'id')->where('is_active', 1);
    }
    public function Brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
    public function scopeSearch($query, $search)
    {
        return $query->where('product_name', 'LIKE', $search . '%');
    }
    public function selectData($query)
    {
        return $query->select(['id', 'shop_id', 'product_name', 'product_slug', 'product_qty', 'product_sku', 'sell_qty', 'product_size', 'product_weight', 'product_price', 'have_a_discount', 'offer', 'discount_price', 'discount_price_type', 'discount_condition', 'from_date', 'to_date', 'offer_stock_type', 'offer_qty', 'checkout_offer_qty', 'image']);
    }
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeIsApprove($query)
    {
        return $query->where('is_approve', 1);
    }
    public function scopeIsNotApprove($query)
    {
        return $query->where('is_approve', 0);
    }
    public function scopeIsDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }

    public function scopeNotID($query, $id)
    {
        return $query->where('id', '!=', $id);
    }
    public function scopeIsUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function scopeIsID($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeOffer11($query)
    {
        return $query->where('offer', '11_offer');
    }

    public function scopeOffer22($query)
    {
        return $query->where('offer', '22_offer');
    }

    public function scopeSpecialOffer($query)
    {
        return $query->where('offer', 'special_offer');
    }
    public function scopeHaveDiscount($query)
    {
        return $query->where('have_a_discount', 1);
    }
    public function scopeTrendingProduct($query)
    {
        return $query->where('trending_product', 1);
    }
    public function scopeFeatureProduct($query)
    {
        return $query->where('feature_product', 1);
    }
    public function scopeTopCollectionProduct($query)
    {
        return $query->where('top_collection_product', 1);
    }
    public function scopeUsedProduct($query)
    {
        return $query->where('product_condition', '!=', 'New');
    }

    public function Category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function SubCategory_id()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id', 'id');
    }
    public function Vendor()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function MainShop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id', 'id');
    }

    public static function booted()
    {
        static::saving(function ($model) {
            Cache::forget('bestsellproduct');
            Cache::forget('trandingproduct');
            Cache::forget('newproduct');
            Cache::forget('featureproduct');
            Cache::forget('onlythreeBestproduct');
            Cache::forget('latestproduct');
            Cache::forget('topProducts');
            Cache::forget('topCollectionProducts');
            Cache::forget('bigSavings');
            Cache::forget('countElevenProduct');
            Cache::forget('countSpecialProduct');
            Cache::forget('countTwentyTwoProduct');
        });

        static::updating(function ($model) {
            Cache::forget('bestsellproduct');
            Cache::forget('trandingproduct');
            Cache::forget('newproduct');
            Cache::forget('featureproduct');
            Cache::forget('onlythreeBestproduct');
            Cache::forget('latestproduct');
            Cache::forget('topProducts');
            Cache::forget('topCollectionProducts');
            Cache::forget('bigSavings');
            Cache::forget('countElevenProduct');
            Cache::forget('countSpecialProduct');
            Cache::forget('countTwentyTwoProduct');
        });

        static::deleting(function ($model) {
            //
        });
    }

}
