<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cart';

    protected $fillable = [
        'userId',
        'productId',
        'qty',
        'price'
    ];
}