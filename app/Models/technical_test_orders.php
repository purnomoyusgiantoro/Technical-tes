<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class technical_test_orders extends Model
{
    protected $table = 'technical_test_orders';
    protected $fillable = [
        'id',
        'order_number',
        'sku',
        'qty',
        'price',
        'created_at',
        'updated_at',
    ];
}
