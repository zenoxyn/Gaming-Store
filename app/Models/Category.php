<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'spec_template',
    ];

    protected function casts(): array
    {
        return [
            'spec_template' => 'array',
        ];
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
