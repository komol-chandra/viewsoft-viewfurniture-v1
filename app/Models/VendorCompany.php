<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCompany extends Model
{
    use HasFactory;

    public function vendorShop()
    {
        return $this->hasMany(Shop::class, 'company_id');
    }
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeIsApprove($query)
    {
        return $query->where('is_approve', 1);
    }
    public function scopeIsDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }
}
