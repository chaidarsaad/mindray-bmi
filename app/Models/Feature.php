<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'title',
        'subtitle',
        'logo',
    ];

    protected static function booted()
    {
        static::creating(function (Feature $model) {
            $model->uid = (string) str()->uuid();
        });

        static::saving(function (Feature $model) {
            $model->uid = (string) str()->uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
