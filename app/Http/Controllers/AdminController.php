<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $berita = Berita::count();
        $kategori = Kategori::count();
        $user = User::count();
        $dataBerita = Berita::with('kategori')->orderBy('created_at', 'desc')->paginate(5);
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
        $user = User::select('id','name','email','foto')->Where('id', decrypt($id))->firstOrFail();
        return view('admin.profile', compact(
            'title',
            'user',
        ));
    }

    public function updateProfile(Request $request, $id)
    {$user = User::Where('id', decrypt($id))->firstOrFail();
        $rules = [
            'name' => 'required|max:255',
        ];

       
        if($request->email != $user->email) {
            $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($user->id)];
        }

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-users', 'public');
            
        }

        User::where('id', $user->id)
                ->update($validatedData);
        return redirect()->route('admin.profile', $id)->with('success', 'Data Berhasil Diubah!!');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail(decrypt($id));

        $validatedData = $request->validate([
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
