<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_harga',
        'status',
        'payment_status',
        'name',
        'email',
        'phone',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(TrainingOrderDetail::class);
    }

    public function getRouteKeyName()
    {
        return 'order_number';
    }
}
