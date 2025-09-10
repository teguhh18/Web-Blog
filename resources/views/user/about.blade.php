@extends('user.new-layouts.main')

@section('main')
<main>

  <!-- Hero Section -->
  <div class="bg-base-200">
    <div class="container mx-auto px-4 py-16 text-center">
      <h1 class="text-5xl font-bold">About Us</h1>
      <p class="py-6 text-lg">Discover our story, our mission, and the vision that drives us forward.</p>
    </div>
  </div>

  <!-- Main Content Section -->
  <section class="py-16">
    <div class="container mx-auto px-4">

      <!-- Company History -->
      <div class="hero min-h-[50vh] bg-base-100 rounded-box overflow-hidden mb-12">
        <div class="hero-content flex-col lg:flex-row gap-8 w-full">
          <img src="{{ asset('user/img/post-landscape-2.jpg') }}" class="w-full lg:max-w-md rounded-lg shadow-2xl" alt="Company History" />
          <div class="lg:ms-8">
            <p class="text-sm font-semibold text-primary">OUR STORY</p>
            <h2 class="text-4xl font-bold mt-2 mb-4">Company History</h2>
            <p class="py-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime, adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam temporibus aut!</p>
            <p>Fugit eaque illum blanditiis, quo exercitationem maiores autem laudantium unde excepturi dolores quasi eos vero harum ipsa quam laborum illo aut facere voluptates aliquam adipisci sapiente beatae ullam.</p>
          </div>
        </div>
      </div>

      <!-- Mission & Vision -->
      <div class="hero min-h-[50vh] bg-base-100 rounded-box overflow-hidden">
        <div class="hero-content flex-col lg:flex-row-reverse gap-8 w-full">
          <img src="{{ asset('user/img/post-landscape-1.jpg') }}" class="w-full lg:max-w-md rounded-lg shadow-2xl" alt="Mission and Vision" />
          <div class="lg:me-8">
            <p class="text-sm font-semibold text-primary">OUR GOALS</p>
            <h2 class="text-4xl font-bold mt-2 mb-4">Mission &amp; Vision</h2>
            <p class="py-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime, adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam temporibus aut!</p>
            <p>Fugit eaque illum blanditiis, quo exercitationem maiores autem laudantium unde excepturi dolores quasi eos vero harum ipsa quam laborum illo aut facere voluptates aliquam adipisci sapiente beatae ullam.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Latest News Section -->
  <section class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap items-center justify-between gap-12">
        <!-- Text Content -->
        <div class="w-full lg:w-1/2 xl:w-5/12">
          <h2 class="text-4xl font-bold mb-4">Berita Terbaru</h2>
          <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, rem eaque vel est asperiores iste pariatur placeat molestias, rerum provident ea maiores debitis eum earum esse quas architecto! Minima, voluptatum!</p>
          <p class="mb-6">At magni dolore ullam odio sapiente ipsam, numquam eius minus animi inventore alias quam fugit corrupti error iste laboriosam dolorum culpa doloremque eligendi repellat iusto vel impedit odit cum.</p>
          <a href="{{ route('user.berita') }}" class="btn btn-primary">Lihat Semua Berita</a>
        </div>
        <!-- Image Gallery -->
        <div class="w-full lg:w-1/2 xl:w-6/12">
          <div class="flex gap-4 items-center">
            <div class="w-1/2">
              <img src="{{ asset('user/img/post-portrait-3.jpg') }}" alt="Latest news photo 1" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <div class="w-1/2 mt-16">
              <img src="{{ asset('user/img/post-portrait-4.jpg') }}" alt="Latest news photo 2" class="rounded-lg shadow-lg w-full h-auto">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection