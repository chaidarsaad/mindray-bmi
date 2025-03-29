<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['training_order_id', 'training_price_id'];

    public function trainingOrder()
    {
        return $this->belongsTo(TrainingOrder::class);
    }

    public function trainingPrice()
    {
        return $this->belongsTo(TrainingPrice::class);
    }
}
