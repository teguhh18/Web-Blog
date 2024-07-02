<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Berita;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        // dd($request);
        $berita = Berita::where('slug', $slug)->firstOrFail(); 
        // Validasi input
        $validatedData = $request->validate([
            'comment' => 'required|max:255',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['berita_id'] = $berita->id;
        // Menyimpan data kategori
        Comment::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('user.berita.baca', $berita->slug)->with('success', 'Berhasil Mengirim Komentar!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
