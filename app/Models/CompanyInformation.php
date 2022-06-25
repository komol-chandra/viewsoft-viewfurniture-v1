<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CompanyInformation extends Model
{
    use HasFactory;

    public static function booted()
    {
        static::saving(function ($model) {
            Cache::forget('companyInformation');
        });

        static::updating(function ($model) {
            Cache::forget('companyInformation');
        });

        static::deleting(function ($model) {
            //
        });
    }
}
