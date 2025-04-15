<?php

namespace App\Models;

use App\Services\OrderStatusService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'order_number',
        'name',
        'email',
        'phone',
        'address',
        'notes',
        'status',
        'payment_status',
        'payment_proof',
        'total_harga',
    ];

    public function getStatusTitleAttribute()
    {
        return OrderStatusService::getStatusInfo($this->status)['title'];
    }

    public function getRouteKeyName()
    {
        return 'order_number';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
