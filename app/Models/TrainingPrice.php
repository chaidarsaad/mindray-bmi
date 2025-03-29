<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TrainingPrice extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'city_id', 'training_type_id', 'price'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class);
    }
}
