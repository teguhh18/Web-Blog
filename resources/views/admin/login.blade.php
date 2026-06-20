@extends('user.new-layouts.main')
@section('main')
    <!-- Auth Hero -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 bg-base-200">
        <div class="w-full max-w-md" data-aos="fade-up">
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <a href="{{ route('user.home') }}" class="inline-flex items-center justify-center w-16 h-16 bg-neutral rounded-full shadow-lg mb-4 hover:scale-110 transition-transform">
                    <svg class="w-9 h-9 text-neutral-content" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold mb-1">Selamat Datang</h1>
                <p class="text-base-content/60">Masuk ke akun Web Blog Anda</p>
            </div>

            <!-- Login Card -->
            <div class="card bg-base-100 shadow-lg border border-base-200">
                <div class="card-body p-8">
                    <!-- Flash Messages -->
                    @if (session()->has('msg'))
                        <div class="alert alert-{{ session('class') === 'danger' ? 'error' : 'success' }} mb-4">
                            <span>{{ session('msg') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('authenticate') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div class="form-control">
                            <label class="label" for="email">
                                <span class="label-text font-medium">Email</span>
                            </label>
                            <input type="email" name="email" id="email" placeholder="email@example.com"
                                class="input input-bordered w-full focus:input-primary transition-all @error('email') input-error @enderror"
                                required value="{{ old('email') }}" />
                            @error('email')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-control">
                            <label class="label" for="password">
                                <span class="label-text font-medium">Password</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Masukkan password"
                                    class="input input-bordered w-full focus:input-primary transition-all pr-12 @error('password') input-error @enderror"
                                    required />
                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-base-content/40 hover:text-base-content transition-colors">
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="label cursor-pointer justify-start gap-2">
                                <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" />
                                <span class="label-text text-base-content/70 text-sm">Ingat saya</span>
                            </label>
                            <a href="{{ route('password.forgot') }}" class="text-sm link link-primary">Lupa password?</a>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary w-full shadow-md hover:shadow-lg transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Masuk
                        </button>
                    </form>

                    <div class="divider text-base-content/40 my-4">atau</div>

                    <div class="text-center">
                        <p class="text-base-content/60 text-sm">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="link link-primary font-semibold">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-base-content/50 text-xs mt-6">
                &copy; {{ date('Y') }} Web Blog. Dibuat dengan ❤️
            </p>
        </div>
    </div>

    @push('js')
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }
    </script>
    @endpush
@endsection
