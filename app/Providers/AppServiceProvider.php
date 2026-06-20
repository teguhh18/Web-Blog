<?php

namespace App\Providers;

use App\Models\Kategori;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        // Share dataKategori & tools to all user-facing views (header needs them)
        View::composer([
            'user.new-layouts.header',
            'user.new-layouts.main',
            'user.blog.partials.kategori',
        ], function ($view) {
            if (!isset($view->dataKategori)) {
                $view->with('dataKategori', Kategori::select('nama', 'slug', 'foto')->withCount('berita')->get());
            }
            if (!isset($view->tools)) {
                $view->with('tools', collect());
            }
        });
    }
}
