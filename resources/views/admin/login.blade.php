<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Web Blog</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS + DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .slide-in {
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl float-animation">
        </div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl float-animation"
            style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl float-animation"
            style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md slide-in">
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4 float-animation">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Web Blog</h1>
                <p class="text-white/80">Masuk ke akun Anda</p>
            </div>

            <!-- Login Card -->
            <div class="glass-card rounded-2xl p-8 shadow-2xl">
                <!-- Notifications -->
                @if (session()->has('msg'))
                    <div
                        class="alert alert-{{ session('class') === 'danger' ? 'error' : session('class') }} mb-6 slide-in">
                        <div class="flex items-center">
                            @if (session('class') === 'danger')
                                <i class="bi bi-exclamation-triangle text-lg mr-2"></i>
                            @else
                                <i class="bi bi-check-circle text-lg mr-2"></i>
                            @endif
                            <span>{{ session('msg') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Form Header -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white mb-1">Selamat Datang</h2>
                    <p class="text-white/70">Silakan masuk dengan akun Anda</p>
                </div>

                <!-- Login Form -->
                <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-white font-medium">
                                <i class="bi bi-envelope mr-2"></i>Email
                            </span>
                        </label>
                        <input type="email" name="email" placeholder="admin@example.com"
                            class="input input-bordered w-full bg-white/20 backdrop-blur-sm border-white/30 text-white placeholder-white/60 focus:border-white focus:bg-white/30 transition-all duration-300"
                            required value="{{ old('email') }}" />
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-red-300">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text text-white font-medium">
                                <i class="bi bi-lock mr-2"></i>Password
                            </span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Masukkan password Anda"
                                class="input input-bordered w-full bg-white/20 backdrop-blur-sm border-white/30 text-white placeholder-white/60 focus:border-white focus:bg-white/30 transition-all duration-300 pr-12"
                                required />
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/60 hover:text-white transition-colors">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <label class="label">
                                <span class="label-text-alt text-red-300">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex justify-between items-center">
                        <div class="form-control">
                            <label class="label cursor-pointer justify-start gap-2">
                                <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" />
                                <span class="label-text text-white/80">Ingat saya</span>
                            </label>
                        </div>
                        <a href="{{ route('password.forgot') }}"
                            class="text-sm text-white/80 hover:text-white underline transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="btn btn-primary w-full bg-white text-primary border-none hover:bg-white/90 hover:scale-105 transition-all duration-300 shadow-lg">
                        <i class="bi bi-box-arrow-in-right mr-2"></i>
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider text-white/60 my-6">atau</div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-white/80 mb-4">Belum memiliki akun?</p>
                    <a href="{{ route('register') }}"
                        class="btn btn-outline btn-primary w-full border-white/30 text-white hover:bg-white hover:text-primary hover:border-white transition-all duration-300">
                        <i class="bi bi-person-plus mr-2"></i>
                        Buat Akun Baru
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-white/60 text-sm">
                    © {{ date('Y') }} Web Blog. Dibuat dengan ❤️
                </p>
            </div>
        </div>
    </div>

    <!-- Theme Toggle (Optional) -->
    <div class="fixed top-4 right-4">
        <button onclick="toggleTheme()"
            class="btn btn-circle btn-ghost bg-white/20 backdrop-blur-sm border-white/30 text-white hover:bg-white/30 transition-all duration-300">
            <i class="bi bi-moon text-lg" id="themeIcon"></i>
        </button>
    </div>

    <!-- Scripts -->
    <script>
        // Password toggle functionality
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }

        // Theme toggle functionality
        function toggleTheme() {
            const html = document.documentElement;
            const themeIcon = document.getElementById('themeIcon');
            const currentTheme = html.getAttribute('data-theme');

            if (currentTheme === 'light') {
                html.setAttribute('data-theme', 'dark');
                themeIcon.className = 'bi bi-sun text-lg';
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                themeIcon.className = 'bi bi-moon text-lg';
                localStorage.setItem('theme', 'light');
            }
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const themeIcon = document.getElementById('themeIcon');

            document.documentElement.setAttribute('data-theme', savedTheme);

            if (savedTheme === 'dark') {
                themeIcon.className = 'bi bi-sun text-lg';
            } else {
                themeIcon.className = 'bi bi-moon text-lg';
            }
        });

        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Memproses...';
            submitBtn.disabled = true;

            // Re-enable after 3 seconds (fallback)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>
