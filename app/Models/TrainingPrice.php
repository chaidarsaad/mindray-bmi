<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrainingPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'city_id',
        'training_type_id',
        'price',
        'place',
        'start_date',
        'end_date',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class);
    }
}
