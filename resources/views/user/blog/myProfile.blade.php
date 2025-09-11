@extends('user.new-layouts.main')
@section('main')
    <main id="main" class="p-4 sm:p-6 md:p-8">
        <section id="contact" class="contact mb-5">
            <div class="container mx-auto" data-aos="fade-up">

                <div class="text-center mb-5">
                    <h2 class="text-3xl font-bold">Profile {{ auth()->user()->name }}</h2>
                </div>

                <div class="grid grid-cols-1 gap-8">
                    <div class="space-y-4">
                        @if (session()->has('success'))
                            <div role="alert" class="alert alert-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div role="alert" class="alert alert-error">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                    <!-- Profile Update Form -->
                    <div class="card bg-base-100 shadow-xl">
                        <form action="{{ route('user.profile.update', encrypt($user->id)) }}" method="post" class="card-body" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <h3 class="card-title justify-center text-2xl">Ubah Profile</h3>
                            <div class="avatar justify-center my-4">
                                <div class="w-48 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                    @if ($user->foto)
                                        <img id="image-preview" src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}" />
                                    @else
                                        <img id="image-preview" src="https://placehold.co/200x200?text=No+Image" alt="No Image" />
                                    @endif
                                </div>
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="name">
                                    <span class="label-text">Nama</span>
                                </label>
                                <input type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full" />
                                @error('name')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="email">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" name="email" id="email" placeholder="Your Email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full" />
                                @error('email')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="foto">
                                    <span class="label-text">Foto</span>
                                </label>
                                <input type="file" name="foto" id="foto" class="file-input file-input-bordered w-full" onchange="previewImage()" />
                                @error('foto')
                                     <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="card-actions justify-center mt-4">
                                <button type="submit" class="btn btn-primary">Ubah Profile</button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Update Form -->
                    <div class="card bg-base-100 shadow-xl">
                        <form action="{{ route('user.password.update', encrypt($user->id)) }}" method="post" class="card-body">
                            @method('put')
                            @csrf
                            <h3 class="card-title justify-center text-2xl">Ubah Password</h3>

                            <div class="form-control w-full">
                                <label class="label" for="newpassword">
                                    <span class="label-text">Password Baru</span>
                                </label>
                                <input type="password" name="newpassword" id="newpassword" placeholder="Masukkan password baru" class="input input-bordered w-full" required />
                                @error('newpassword')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="renewpassword">
                                    <span class="label-text">Ulang Password Baru</span>
                                </label>
                                <input type="password" name="renewpassword" id="renewpassword" placeholder="Masukkan lagi password baru" class="input input-bordered w-full" required />
                                @error('renewpassword')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="card-actions justify-center mt-4">
                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>

    </main><!-- End #main -->

    <script>
      function previewImage() {
          const image = document.querySelector('#foto');
          const imgPreview = document.querySelector('#image-preview');

          if (image.files && image.files[0]) {
              const oFReader = new FileReader();
              oFReader.readAsDataURL(image.files[0]);

              oFReader.onload = function(oFREvent) {
                  imgPreview.src = oFREvent.target.result;
              }
          }
      }
  </script>
@endsection
