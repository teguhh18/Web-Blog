<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($path)
    {
        // Pastikan file ada di disk 'public' (storage/app/public)
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        // Dapatkan path lengkap ke file
        $fullPath = Storage::disk('public')->path($path);
        return response()->file($fullPath);
    }
}
