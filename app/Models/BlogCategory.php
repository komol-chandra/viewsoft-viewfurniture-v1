<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = "blog_categories";

    protected $primaryKey = "id";

    protected $fillable = [
        "title",
        "image",
        "icon",
        "status",
        "created_by",
        "updated_by",
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    public static function booted()
    {
        static::saving(function ($model) {
            $model->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id ?? null;
        });
    }
}
