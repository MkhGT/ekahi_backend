<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'tb_order';
    protected $fillable = [
        'seller',
        'payment',
        'status',
        'jumlah_pesanan',
        'total',
    ];
}
