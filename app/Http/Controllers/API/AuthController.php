<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'an error occured',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Register Success',
            'data' => $success
        ]);

    }

    //Login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'cek email dan password',
                    'data' => null
                ]);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception('Invalid Credentials');
            }

            $tokenResult = [];
            $tokenResult['token'] = $user->createToken('authToken')->plainTextToken;
            $tokenResult['name'] = $user->name;
            $tokenResult['email'] = $user->email;

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => $tokenResult
            ]);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => 'ada yang salah',
                'data' => $error
            ]);
        }
    }

    // Fetch users
    public function users(Request $request)
    {
        return response()->json([
            'message' => 'Data berhasil diambil',
            'data' => $request->user()
        ]);
    }
}
