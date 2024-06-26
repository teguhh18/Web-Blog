<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $berita = Berita::count();
        $kategori = Kategori::count();
        $user = User::count();
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.home', compact(
            'title',
            'berita',
            'kategori',
            'user',
            'dataBerita'
        ));
    }

    public function adminProfile($id)
    {
        $title = "Profile";
        $user = User::Where('id', decrypt($id))->firstOrFail();
        // dd($user);
        return view('admin.profile', compact(
            'title',
            'user',
        ));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::Where('id', decrypt($id))->firstOrFail();
        // dd($user);
        $validatedData  = $request->validate([
            'name'     => 'required|max:255',
            "email" => 'required',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        $user->save();
        return redirect()->route('admin.profile', $id)->with('success', 'Data Berhasil Diubah!!');
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

        return redirect()->route('admin.profile', $id)->with('success', 'Password Berhasil Diubah');
    }
}
