<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama' => 'Web Development',
            'slug' => 'web-development',
        ]);
        Kategori::create([
            'nama' => 'Mobile Development',
            'slug' => 'mobile-development',
        ]);
        Kategori::create([
            'nama' => 'Politics',
            'slug' => 'politics',
        ]);
        Kategori::create([
            'nama' => 'Sports',
            'slug' => 'sports',
        ]);
        Kategori::create([
            'nama' => 'Programming',
            'slug' => 'programming',
        ]);
    }
}
