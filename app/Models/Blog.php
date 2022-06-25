<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $primaryKey = "id";

    protected $fillable = [
        "category_id",
        "title",
        "slug",
        "image",
        "short_des",
        "des",
        "viewer",
        "tag",
        "status",
        "is_deleted",
        "created_by",
        "updated_by",
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'Like', '%' . $search . '%');
    }

    public function scopeCategorySearch($query, $search)
    {
        return $query->where('category_id', $search);
    }

    public function scopeRandomBlog($query)
    {
        return $query->inRandomOrder()->take(10);
    }

    public function user()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public static function booted()
    {
        static::saving(function ($model) {
            $model->created_by = Auth::user()->id ?? null;
            Cache::forget('blogs');

        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id ?? null;
            Cache::forget('blogs');

        });

        static::deleting(function ($model) {

        });
    }
}
