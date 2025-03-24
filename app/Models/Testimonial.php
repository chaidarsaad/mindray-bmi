<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'uid',
        'name',
        'title',
        'review',
        'subreview',
        'rating',
        'is_show',
    ];

    protected static function booted()
    {
        static::creating(function (Testimonial $model) {
            $model->uid = (string) str()->uuid();
        });

        static::saving(function (Testimonial $model) {
            $model->uid = (string) str()->uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
