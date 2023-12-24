<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addproduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_desc' => 'required',
            'seller' => 'required',
            'price' => 'required',
            'image_filepath' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'an error occured',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $newProduct = ProductModel::create($input);

        return response()->json([
            'success' => true,
            'message' => ' Success',
            'image_path' => $newProduct
        ]);

    }

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
                'message' => 'data masih kosong',
                'data' => $product
            ]);
        }
    }
}
