<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReReSubCategory extends Model
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

    public function Category_id()
    {
        return $this->belongsTo('App\Models\Category', 'category', 'id');
    }
    public function SubCategory_id()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category', 'id');
    }
    public function ReSubCategory_id()
    {
        return $this->belongsTo('App\Models\ReSubCategory', 're_sub_category', 'id');
    }

    public function reReSubCategory()
    {
        return $this->hasMany('App\Models\ReReSubCategory', 'category', 'id');
    }

    public function reReReSubCategory()
    {
        return $this->hasMany('App\Models\ReReReSubCategory', 'category', 'id')->where('is_active', 1)->where('is_deleted', 0);
    }

}
