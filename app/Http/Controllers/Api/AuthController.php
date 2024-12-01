<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $dataUser = new User();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
            'status' => false,
            'message' => 'Proses Validasi Gagal',
            'data' => $validator->errors(),
            ],401);
        }

        $dataUser->name = $request->name;
        $dataUser->email = $request->email;
        $dataUser->password = Hash::make($request->password);
        $dataUser['level'] = "user";
        $dataUser->save();

        return response()->json([
            'status' => true,
            'message' => 'Proses Register Berhasil',
            // 'data' => $validator->errors(),
            ], 200);

    }

    public function loginUser(Request $request)
    {
        $rules = [
            // 'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
            'status' => false,
            'message' => 'Proses Login Gagal',
            'data' => $validator->errors(),
            ],401);
        }

        if(!Auth::attempt($request->only(['email','password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email Atau Password Salah',
                // 'data' => $validator->errors(),
                ],401);
        }

        $dataUser = User::where('email', $request->email)->firstOrFail();
        return response()->json([
            'status' => true,
            'message' => 'Login Berhasil',
            'token' => $dataUser->createToken('api-berita')->plainTextToken,
            ],200);
    }
}
