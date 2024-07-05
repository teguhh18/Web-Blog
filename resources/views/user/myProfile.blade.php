@extends('user.layouts.main')
@section('main')

<main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h2 class="page-title">Profile {{ auth()->user()->name }}</h2>
          </div>
        </div>

        <div class="row">
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-secondary bg-secondary alert-dismissible fade show text-white" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div>
                @if (session()->has('error'))
                    <div class="alert alert-warning bg-warning alert-dismissible fade show text-white" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        <div class="form mt-3 col-md-6">
            
          <form action="{{ route('user.profile.update', encrypt($user->id)) }}" method="post" class="php-email-form">
            @method('put')
            @csrf
            <div class="row">
              <div class
              ="form-group col-md-12 text-center">
                <img src="{{ asset('storage/' . $user->foto) }}" alt="" class="img-fluid img-thumbnail" style=" width:200px">
              </div>
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="{{ $user->name }}">
              </div>
              <div class="form-group col-md-6">
                <label for="name">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"  value="{{ $user->email }}">
              </div>
            </div>
            <div class="text-center"><button type="submit">Ubah Profile</button></div>
          </form>
        </div>
        
        <div class="form mt-3 col-md-6">
            <form action="{{ route('user.password.update', encrypt($user->id)) }}" method="post" class="php-email-form">
                @method('put')
                @csrf
              <div class="row">
                <h3 class="text-center">Ubah Password</h3>
                <div class="form-group col-md-6">
                  <label for="newpassword">Password Baru</label>
                  <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Masukkan password baru" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="renewpassword">Ulang Password Baru</label>
                  <input type="password" class="form-control" name="renewpassword" id="renewpassword" placeholder="Masukkan lagi password baru" required>
                </div>
              </div>
             
              <div class="text-center"><button type="submit">Ubah Password</button></div>
            </form>
          </div><!-- End Contact Form -->
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection