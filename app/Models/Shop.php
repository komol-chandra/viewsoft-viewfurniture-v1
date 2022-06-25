<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function ShopCategory()
    {
        return $this->belongsTo('App\Models\ShopCategory', 'shopcategory_id', 'id');
    }
    public function Product()
    {
        return $this->hasMany(Product::class, 'shop_id', 'id')->isActive()->isDeleted()->isApprove();
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
        return $query->where('is_approve', 1);
    }
    public function scopeIsDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }
    public function scopeIsUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
