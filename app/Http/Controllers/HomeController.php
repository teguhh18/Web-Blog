<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Comment;
use App\Models\Kategori;
use App\Models\Tools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $dataBerita = Berita::with(['kategori'])->orderBy('created_at', 'desc')->paginate(6);
        $beritaPopuler = Berita::with(['kategori', 'user'])->orderBy('views', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama', 'slug', 'foto')->withCount('berita')->get();
        $tools = Tools::where('status', 'active')->get();
        return view('user.blog.home', compact(
            'title',
            'dataBerita',
            'dataKategori',
            'beritaPopuler',
            'tools'
        ));
    }

    public function beritaBaca($slug)
    {
        $berita = Berita::with(['kategori', 'user'])->where('slug', $slug)->firstOrFail();
        $relateds = Berita::with(['kategori', 'user'])->where('kategori_id', $berita->kategori_id)->where('id', '!=', $berita->id)->paginate(6);
        $title = $berita->title;
        $dataKategori = Kategori::select('nama', 'slug')->get();
        $dataComment = Comment::with(['user'])->where('berita_id', $berita->id)->orderBy('created_at', 'desc')->get();
        $countComment = $dataComment->count();
        $tools = Tools::where('status', 'active')->get();
        $sessionKey = 'berita_' . $berita->id;

        // Check if the session does not have the key
        if (!session()->has($sessionKey)) {
            // Increment views count
            $berita->increment('views');
            // Add the key to session
            session()->put($sessionKey, 1);
        }
        // dd($dataComment);
        return view('user.blog.bacaBerita', compact(
            'title',
            'berita',
            'relateds',
            'dataKategori',
            'countComment',
            'dataComment',
            'tools'
        ));
    }

    public function berita()
    {
        $title = "Berita";
        $dataBerita = Berita::with(['kategori'])->orderBy('created_at', 'desc')->paginate(6);
        $dataKategori = Kategori::select('nama', 'slug', 'foto')->withCount('berita')->get();
        $beritaPopuler = Berita::with(['kategori', 'user'])->orderBy('views', 'desc')->paginate(4);
        $tools = Tools::where('status', 'active')->get();

        return view('user.blog.berita', compact(
            'title',
            'dataBerita',
            'dataKategori',
            'beritaPopuler',
            'tools'
        ));
    }

    public function listKategori()
    {
        $title = "Kategori";
        $dataBerita = Berita::with(['kategori', 'user'])->orderBy('created_at', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama', 'slug', 'foto')->paginate(6);
        $tools = Tools::where('status', 'active')->get();
        return view('user.list_kategori', compact(
            'title',
            'dataKategori',
            'dataBerita',
            'tools'
        ));
    }

    public function beritaByKategori($slug)
    {
        $kategori = Kategori::select('id', 'nama')->where('slug', $slug)->firstOrFail();
        $title = $kategori->nama;
        $dataBerita = Berita::with(['kategori', 'user'])->where('kategori_id', $kategori->id)->orderBy('created_at', 'desc')->paginate(6);
        $beritaPopuler = Berita::with(['kategori', 'user'])->orderBy('views', 'desc')->paginate(4);
        $dataKategori = Kategori::select('nama', 'slug', 'foto')->withCount('berita')->get();
        $tools = Tools::where('status', 'active')->get();

        return view('user.blog.kategori', compact(
            'title',
            'dataBerita',
            'dataKategori',
            'beritaPopuler',
            'tools'

        ));
    }

    public function about()
    {
        $title = "About";
        $dataKategori = Kategori::select('nama', 'slug')->get();
        $tools = Tools::where('status', 'active')->get();

        return view('user.blog.about', compact(
            'title',
            'dataKategori',
            'tools'
        ));
    }

    public function contact()
    {
        $title = "Contact";
        $tools = Tools::where('status', 'active')->get();

        return view('user.blog.contact', compact(
            'title',
            'tools'
        ));
    }

    public function search(Request $request)
    {
        $title = "Search";
        $Berita = Berita::with(['kategori', 'user'])->orderBy('created_at', 'desc')->paginate(4);
        $query = $request->input('search');
        $beritaPopuler = Berita::with(['kategori', 'user'])->orderBy('views', 'desc')->paginate(4);
        $dataBerita = Berita::with(['kategori', 'user'])
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('berita', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $dataKategori = Kategori::select('nama', 'slug', 'foto')->get();
        $tools = Tools::where('status', 'active')->get();

        return view('user.blog.search', compact(
            'title',
            'Berita',
            'beritaPopuler',
            'dataBerita',
            'dataKategori',
            'query',
            'tools'
        ));
    }
}
