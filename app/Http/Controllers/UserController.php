<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data User";
        $dataUser = User::all();
        // dd($dataKategori);

        return view('admin.user.index', compact(
            'title',
            'dataUser'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah User";


        return view('admin.user.create', compact(
            'title'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'level' => 'required',
            'foto' => 'required|image|file',
        ]);

        // Menyimpan file foto
        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-users', 'public');
        }

        $validatedData['password'] = bcrypt($request->password);
        
        User::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.user.index')->with('success', 'Data User Berhasil Ditambah!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = "Edit Data User";
        return  view('admin.user.edit', compact(
            'title',
            'user'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            // 'email' => 'required|unique:users',
            'level' => 'required',
            'foto' => 'image'
        ];

        

        if($request->email != $user->email) {
            $rules['email'] = 'required|unique:users';
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

        return redirect()->route('admin.user.index')->with('success', 'Data User Berhasil Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
         // Hapus foto lama 
         if($user->foto) {
            Storage::delete('public/' . $user->foto);
        }
        User::destroy($user->id);

        return redirect()->route('admin.user.index')->with('success', 'User Berhasil Dihapus!!');
    }
}
