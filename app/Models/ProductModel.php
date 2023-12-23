<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'tb_products';
    protected $fillable = [
        'product_name',
        'product_desc',
        'seller',
        'price',
        'image_filepath',
    ];
}
