<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'judul',
        'image',
        'description',
        'is_show',
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function trainingPrices()
    {
        return $this->hasMany(TrainingPrice::class, 'training_id');
    }
}
