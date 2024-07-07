<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        $title = "Reset Password";
        return view('auth.forgot-password', compact('title'));
    }

    public function sendOTP(Request $request)
    {
        // dd($request);
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(30); // Generate a random 6 character token
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        session()->put('email', $request->email);
        // Send OTP email
        Mail::send('auth.otp', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset OTP');
        });

        return redirect()->route('password.forgot')->with('success', 'Cek Emailmu!!, Kami sudah mengirim link untuk reset password .');
    }


    public function showResetForm($token)
    {
        // Validasi token di sini
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addMinutes(10)->isPast()) {
            abort(403, 'Invalid or expired token.');
        }

        // Kirim ke view reset-password dengan email
        $title = "Buat Password Baru";
        return view('auth.reset-password', ['email' => $passwordReset->email, 'title' => $title]);
    }


    public function resetPassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password Kamu berhasil direset.');
    }
}
