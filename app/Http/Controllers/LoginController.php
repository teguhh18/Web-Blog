<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login', [
            'title' => 'Login',
            'active' => 'login']);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',   untuk email ketat
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // dd('berhasl login');

        // login berhasil masuk dashboard
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/home');
        }
        // Gagal, kembali ke halaman login dan memberi pesan Login Failed.
        // Pesan disimpan di Sessiion
        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/home');
    }
}
