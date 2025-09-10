<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // dd($request->all());
        $berita = Berita::where('slug', $slug)->firstOrFail();
        // Validasi input
        $validatedData = $request->validate([
            'comment' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['berita_id'] = $berita->id;
            Comment::create($validatedData);
            DB::commit();
            // Redirect dengan pesan sukses
            return redirect()->back()->with(['msg' => 'Berhasil Mengirim Komentar!!', 'icon' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['msg' => 'Gagal Mengirim Komentar: ' . $e->getMessage(), 'icon' => 'error']);
        }
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
