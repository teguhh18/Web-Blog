<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Comment;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(9);
        $beritaPopuler = Berita::orderBy('views', 'desc')->paginate(4);
        $dataKategori = Kategori::all();
        return view('user.home', compact(
            'title',
            'dataBerita',
            'dataKategori',
            'beritaPopuler'
        ));
    }

    public function beritaBaca($slug)
    {
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(6);
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $title = $berita->title;
        $dataKategori = Kategori::all();
        $countComment = Comment::where('berita_id', $berita->id)->count();
        $dataComment = Comment::where('berita_id', $berita->id)->get();

        $sessionKey = 'berita_' . $berita->id;

        // Check if the session does not have the key
        if (!session()->has($sessionKey)) {
            // Increment views count
            $berita->increment('views');
            // Add the key to session
            session()->put($sessionKey, 1);
        }
        // dd($dataComment); 
        return view('user.bacaBerita', compact(
            'title',
            'berita',
            'dataBerita',
            'dataKategori',
            'countComment',
            'dataComment'
        ));
    }

    public function berita()
    {
        $title = "Berita";
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(6);
        $dataKategori = Kategori::all();
        // dd($dataBerita);
        return view('user.berita', compact(
            'title',
            'dataBerita',
            'dataKategori'
        ));
    }

    public function listKategori()
    {
        $title = "Kategori";
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(4);
        $dataKategori = Kategori::paginate(6);

        return view('user.list_kategori', compact(
            'title',
            'dataKategori',
            'dataBerita'
        ));
    }

    public function beritaByKategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $title = $kategori->nama;
        $dataBerita = Berita::where('kategori_id', $kategori->id)->orderBy('created_at', 'desc')->paginate(4);
        $Berita = Berita::orderBy('created_at', 'desc')->paginate(4);
        $dataKategori = Kategori::all();
        return view('user.kategori', compact(
            'title',
            'dataBerita',
            'dataKategori',
            'Berita'

        ));
    }

    public function about()
    {
        $title = "About";
        return view('user.about', compact(
            'title'
        ));
    }

    public function contact()
    {
        $title = "Contact";
        return view('user.contact', compact(
            'title'

        ));
    }
}
