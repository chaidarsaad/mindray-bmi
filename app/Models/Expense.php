<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'uid',
        'name',
        'amount',
        'date_expense',
        'note',
        'payment_proofs',
    ];

    protected $casts = [
        'payment_proofs' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'uid';
    }

    protected static function booted()
    {
        static::creating(function (Expense $model) {
            $model->uid = (string) str()->uuid();
        });
    }
}
