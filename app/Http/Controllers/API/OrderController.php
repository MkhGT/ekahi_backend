<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller' => 'required',
            'payment' => 'required',
            'status' => 'required',
            'jumlah_pesanan' => 'required',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'an error occured',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $order = OrderModel::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Register Success',
            'data' => $order
        ]);
    }
}
