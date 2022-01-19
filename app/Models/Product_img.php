<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_img extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_img';
    protected $primaryKey = 'productId';

    protected $fillable = [
        'productId',
        'img1',
        'img2',
        'img3',
        'img4'
        ];
    public function product(){
        return $this->belongsTo(Product::class,'productId','id');
    }
}
