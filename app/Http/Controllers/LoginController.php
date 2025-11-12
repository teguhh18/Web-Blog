<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tools;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        return back()->with(['msg' => 'Login Failed!! Silahkan Cek Kembali Email dan Password Anda', 'class' => 'danger']);
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

        DB::beginTransaction();
        try {
            // enkripsi password
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['level'] = "user";

            User::create($validatedData);
            DB::commit();
            return redirect()->route('login')->with(['msg' => 'Registrasi Berhasil!! Silahkan Login', 'class' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'Terjadi kesalahan, silahkan coba lagi', 'class' => 'danger']);
        }
    }

    public function userProfile($id)
    {
        $title = "Profile User";
        $dataKategori = Kategori::select('nama', 'slug')->get();
        $user = User::select('id', 'name', 'email', 'foto')->where('id', decrypt($id))->firstOrFail();
        $tools = Tools::where('status', 'active')->get();
        return  view('user.blog.myProfile', compact(
            'title',
            'user',
            'dataKategori',
            'tools'
        ));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::Where('id', decrypt($id))->firstOrFail();

        $rules = [
            'name' => 'required|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ];

        $validatedData = $request->validate($rules);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-users', 'public');
        }

        $user->update($validatedData);

        return back()->with('success', 'Profile Berhasil Diubah!!');
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
