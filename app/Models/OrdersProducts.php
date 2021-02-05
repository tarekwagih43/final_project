<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OrdersProducts extends Model
{
    use Notifiable, SoftDeletes;

    
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'user_id',
        'total_sup_price'
    ];

}
