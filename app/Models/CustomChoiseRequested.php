<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomChoiseRequested extends Model
{
    use HasFactory;

    public function Product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function Customer()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function Vendor()
    {
        return $this->belongsTo('App\Models\User', 'vendor_id', 'id');
    }
    public function Color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id', 'id');
    }
    public function Material()
    {
        return $this->belongsTo('App\Models\Materials', 'material_id', 'id');
    }
    public function FinishedColor()
    {
        return $this->belongsTo('App\Models\FinishedColor', 'finished_color_id', 'id');
    }
}
