<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_detail';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'cpu',
        'screen',
        'resolution',
        'ram',
        'weight',
        'camera',
        'storage',
        'pin',
        'port',
        'feature',
        'bluetooth',
        'compatible'
        ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
