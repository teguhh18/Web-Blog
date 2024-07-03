<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
