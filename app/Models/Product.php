<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'slug',
        'name',
        'subname',
        'images',
        'description',
        'is_show',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function setSubnameAttribute($value)
    {
        $this->attributes['subname'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
