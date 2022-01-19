<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product';

     protected $fillable = [
        'name',
        'type',
        'oldPrice',
        'newPrice',
        'offer',
        'rate',
        'sellQty',
        'sale',
        'version',
        'img',
        'guarantee',
    ];

}
