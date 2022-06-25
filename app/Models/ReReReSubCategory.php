<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReReReSubCategory extends Model
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
        return $this->belongsTo('App\Models\ResubCategory', 're_sub_category', 'id');
    }
    public function ReReSubCategory_id()
    {
        return $this->belongsTo('App\Models\ReReSubCategory', 're_sub_category', 'id');
    }
}
