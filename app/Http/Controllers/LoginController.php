<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        return back()->with('loginError', 'Login Gagal');
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

    public function userProfile($id)
    {
        $title = "Profile User";
        $user = User::select('name','email','foto')->where('id', decrypt($id))->firstOrFail();
        // dd($user);
        return  view('user.myProfile', compact(
            'title',
            'user'
        ));
    }


    public function updateProfile(Request $request, $id)
    {
        $user = User::Where('id', decrypt($id))->firstOrFail();

        $rules = [
            'name' => 'required|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email|unique:users,email';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-users', 'public');
        }

        $user->update($validatedData);

        return redirect()->route('user.profile', $id)->with('success', 'Profile Berhasil Diubah!!');
    }


    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail(decrypt($id));

        $validatedData = $request->validate([
            // 'password' => 'required',
            'newpassword' => 'required',
            'renewpassword' => 'required',
        ]);

        if ($request->newpassword !== $request->renewpassword) {
            return back()->with('error', 'New password dan Renewpassword harus Sama');
        }

        $user->password = bcrypt($validatedData['newpassword']);
        $user->save();

        return redirect()->route('user.profile', $id)->with('success', 'Password Berhasil Diubah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
