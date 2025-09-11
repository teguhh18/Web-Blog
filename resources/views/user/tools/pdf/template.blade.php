<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .image-container {
            width: 100%;
            height: 100vh; /* Satu gambar per halaman */
            page-break-after: always; /* Pindah ke halaman baru setelah setiap gambar */
        }
        .image-container:last-child {
            page-break-after: avoid; /* Hentikan page break di gambar terakhir */
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Pastikan gambar pas di dalam container tanpa terpotong */
        }
    </style>
</head>
<body>
    @foreach ($imagePaths as $path)
        <div class="image-container">
            <img src="{{ public_path(str_replace('/storage', 'storage', $path)) }}" alt="Converted Image">
        </div>
    @endforeach
</body>
</html>