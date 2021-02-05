<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'order_id',
        'user_id',
        'paied',
        'remain',
        'notes'
    ];
}
