<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAcp extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'orders';

    protected $fillable = [
        'status'
    ];
}
