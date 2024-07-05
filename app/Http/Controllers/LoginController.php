<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login', [
            'title' => 'Login'
        ]);
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',   untuk email ketat
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Login berhasil, dan cek level
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->level === 'admin') {
                return redirect()->intended('/admin/home');
            } elseif (Auth::user()->level === 'user') {
                return redirect()->intended('/');
            }
        }

        // Gagal, kembali ke halaman login dan memberi pesan Login Failed.
        return back()->with('loginError', 'Login Failed');
    }


    public function register()
    {
        return view('user.register', [
            'title' => 'Register'
        ]);
    }

    public function registerStore(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        // enkripsi password
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['level'] = "user";

        // Kirim data ke database
        User::create($validatedData);

        // Kembalikan ke halaman login dan beri pesan, Pesan disimpan di session
        return redirect('/login')->with('success', 'Berhasil Buat Akun, Silahkan Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
