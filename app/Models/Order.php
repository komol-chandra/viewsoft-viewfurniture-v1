<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function scopeIsCustomer($query)
    {
        return $query->where('customer_id', auth()->user()->id);
    }

    public function scopeIsPending($query)
    {
        return $query->where('order_status', 0);
    }

    public function scopeIsProcessing($query)
    {
        return $query->where('order_status', 1);
    }

    public function scopeIsRejected($query)
    {
        return $query->where('order_status', 2);
    }
    public function scopeIsDelivered($query)
    {
        return $query->where('order_status', 3);
    }
    public function scopeIsReturned($query)
    {
        return $query->where('order_status', 4);
    }

    public function scopeIsDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }

    public function Division()
    {
        return $this->belongsTo('Devfaysal\BangladeshGeocode\Models\Division', 'division', 'id');
    }
    public function District()
    {
        return $this->belongsTo('Devfaysal\BangladeshGeocode\Models\District', 'district', 'id');
    }
    public function Customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id', 'id');
    }

    public function WalletUsingOrder()
    {
        return $this->hasOne('App\Models\Wallet', 'order_id', 'order_id');
    }
    // public function Product()
    // {
    //     return $this->belongsTo('App\Models\Product', 'billing_id', 'id');
    // }

}
