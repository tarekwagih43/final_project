<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'email',
        'phone',
        'address'
    ];
}
