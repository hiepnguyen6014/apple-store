<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountTime extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'discount';

    protected $fillable = [
        'year',
        'month',
        'day',
        'hours',
        'minutes'
    ];
}
