<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = ['view_count'];

    public function ScopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function ScopeIsDeleted($query)
    {
        return $query->where('is_deleted', 0);
    }
}