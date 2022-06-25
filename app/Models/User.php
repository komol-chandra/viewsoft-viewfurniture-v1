<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type',
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeIsVerified($query)
    {
        return $query->where('is_verified', 1);
    }
    public function scopeIsUser($query)
    {
        return $query->where('id', Auth::user()->id);
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
    public function scopeIsVendor($query)
    {
        return $query->where('is_vendor', 1);
    }

    public function vendorShop()
    {
        return $this->hasMany(Shop::class, 'user_id')->where('is_active', 1)->where('is_deleted', 0)->where('is_approve', 1);
    }

    public function vendorProducts()
    {
        return $this->hasMany(Product::class, 'user_id')->where('is_active', 1)->where('is_deleted', 0)->where('is_approve', 1);
    }
    public function vendorProductsCount()
    {
        return $this->hasMany(Product::class, 'user_id')->where('is_active', 1)->where('is_deleted', 0)->where('is_approve', 1)->count();
    }
}
