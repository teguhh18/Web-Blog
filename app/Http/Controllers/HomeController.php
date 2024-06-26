<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(9);
        $dataKategori = Kategori::all();
        return view('user.home', compact(
            'title', 'dataBerita', 'dataKategori'
        
        ));
    }

    public function beritaBaca($slug)
    {
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(6);
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $title = $berita->title;
        $dataKategori = Kategori::all();
        return view('user.bacaBerita', compact(
            'title', 'berita', 'dataBerita','dataKategori'
        ));
    }

    public function berita(){
        $title = "Berita";
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(6);
        $dataKategori = Kategori::all();

        return view('user.berita', compact(
            'title', 'dataBerita','dataKategori'
        ));
    }

    public function listKategori()
    {
        $title = "Kategori";
        $dataBerita = Berita::orderBy('created_at', 'desc')->paginate(4);
        $dataKategori = Kategori::paginate(6);

        return view('user.list_kategori', compact(
            'title','dataKategori','dataBerita'
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
            'title', 'dataBerita','dataKategori','Berita'
        
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
