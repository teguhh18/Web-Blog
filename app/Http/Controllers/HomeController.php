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
        $dataBerita = Berita::with(['kategori'])->orderBy('created_at', 'desc')->paginate(9);
        $beritaPopuler = Berita::with(['kategori','user'])->orderBy('views', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama','slug','foto')->withCount('berita')->get();
        return view('user.home', compact(
            'title',
            'dataBerita',
            'dataKategori',
            'beritaPopuler'
        ));
    }

    public function beritaBaca($slug)
    {
        $berita = Berita::with(['kategori','user'])->where('slug', $slug)->firstOrFail();
        $relateds = Berita::with(['kategori','user'])->where('kategori_id', $berita->kategori_id)->where('id', '!=', $berita->id)->paginate(6);
        $title = $berita->title;
        $dataKategori = Kategori::select('nama','slug')->get();
        $dataComment = Comment::with(['user'])->where('berita_id', $berita->id)->get();
        $countComment = $dataComment->count();

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
            'relateds',
            'dataKategori',
            'countComment',
            'dataComment'
        ));
    }

    public function berita()
    {
        $title = "Berita";
        $dataBerita = Berita::with(['kategori'])->orderBy('created_at', 'desc')->paginate(6);
        $dataKategori = Kategori::select('nama','slug')->get();
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
        $dataBerita = Berita::with(['kategori','user'])->orderBy('created_at', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama','slug','foto')->paginate(6);

        return view('user.list_kategori', compact(
            'title',
            'dataKategori',
            'dataBerita'
        ));
    }

    public function beritaByKategori($slug)
    {
        $kategori = Kategori::select('id','nama')->where('slug', $slug)->firstOrFail();
        $title = $kategori->nama;
        $dataBerita = Berita::with(['kategori','user'])->where('kategori_id', $kategori->id)->orderBy('created_at', 'desc')->paginate(4);

        $Berita = Berita::with(['kategori','user'])->orderBy('created_at', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama','slug')->get();
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

    public function search(Request $request)
    {
        $title = "Search";
        $Berita = Berita::with(['kategori','user'])->orderBy('created_at', 'desc')->paginate(4);
        $query = $request->input('search');
        $dataBerita = Berita::with(['kategori','user'])
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('berita', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $dataKategori = Kategori::select('nama','slug')->get();

        return view('user.search', compact(
            'title',
            'Berita',
            'dataBerita',
            'dataKategori',
            'query'
        ));
    }
}
