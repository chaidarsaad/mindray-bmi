<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'slug',
        'name',
        'subname',
        'images',
        'is_show',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    // public function setSubnameAttribute($value)
    // {
    //     $this->attributes['subname'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    //     // $this->attributes['slug'] = Str::slug($value) . '-' . Str::random(4);
    // }

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug) && !empty($product->subname)) {
                // $product->slug = Str::slug($product->subname) . '-' . Str::random(4);
                $product->slug = Str::slug($product->subname);
            }
        });

        static::updating(function ($product) {
            // Optional: regenerate slug only if subname changes
            if ($product->isDirty('subname')) {
                // $product->slug = Str::slug($product->subname) . '-' . Str::random(4);
                $product->slug = Str::slug($product->subname);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function descriptions(): HasMany
    {
        return $this->hasMany(ProductDescription::class);
    }
}
