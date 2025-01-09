<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Proses Validasi Gagal',
                'data' => $validator->errors(),
            ], 401);
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
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Proses Login Gagal',
                'data' => $validator->errors(),
            ], 401);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email Atau Password Salah',
            ], 401);
        }

        $user = Auth::user();

        // Delete old tokens
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Login Berhasil',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $user->createToken('api-berita')->plainTextToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout Berhasil',
        ], 200);
    }

    public function userProfile($id)
    {
        $user = User::select('name', 'email', 'foto')->where('id', $id)->firstOrFail();
        // dd($user);
        return response()->json([
            'status' => true,
            'message' => 'Data Profile User',
            'data' => $user
        ], 200);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Proses Validasi Gagal',
                'data' => $validator->errors(),
            ], 401);
        }
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }
            $user->foto = $request->file('foto')->store('foto-users', 'public');
        }
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Proses Update Profile Berhasil',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'foto' => $user->foto,
            ],
        ], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(8); // Generate a random 30 character token
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        session()->put('email', $request->email);
        // Send OTP email
        try {
            Mail::send('auth.otpForApi', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Password Reset Token');
            });

            return response()->json([
                'status' => true,
                'message' => 'Cek Emailmu!!, Kami sudah mengirim Token untuk reset password.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengirim email. Silakan coba lagi dan pastikan Email Benar Terdaftar.',
            ], 400);
        }
    }


    public function checkToken(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
        ]);

        // Cari token di tabel password_resets
        $resetToken = DB::table('password_reset_tokens')->where([
            ['email', '=', $request->email],
            ['token', '=', $request->token],
        ])->first();

        if (!$resetToken || Carbon::parse($resetToken->created_at)->addMinutes(10)->isPast()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired token.',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Token Valid',
            'email' => $resetToken->email,
            'token' => $resetToken->token,
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Proses Validasi Gagal',
                'data' => $validator->errors(),
            ], 401);
        }

        $tokenData = DB::table('password_reset_tokens')->where([
            ['email', $request->email],
            ['token', $request->token]
        ])->first();

        if (!$tokenData) {
            return response()->json(['message' => 'Invalid token.'], 403);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Update user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_reset_tokens')->where([
            ['email', $request->email],
            ['token', $request->token]
        ])->delete();

        return response()->json(['message' => 'Password Sudah Direset, Silahkan Login Lagi..'], 200);
    }
}
