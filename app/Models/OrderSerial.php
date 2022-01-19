<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSerial extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'order_detail';

    protected $fillable = [
        'serial'
    ];
}
