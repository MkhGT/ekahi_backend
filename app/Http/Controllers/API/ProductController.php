<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function products()
    {
        $product = ProductModel::orderBy('product_name', 'asc')->get();

        if ($product) {
            return response()->json([
                'message' => 'Data berhasil diambil',
                'data' => $product
            ]);
        } else {
            return response()->json([
                'message' => 'Data berhasil diambil',
                'data' => $product
            ]);
        }
    }
}
