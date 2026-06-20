<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Blog - {{ $title ?? '' }}</title>
    <meta name="description" content="Template blog modern dan responsif menggunakan DaisyUI dan Tailwind CSS">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: ['selector', '[data-theme="dark"]'],
            daisyui: {
                themes: [{
                    light: {
                        "primary": "#0f172a",
                        "primary-content": "#ffffff",
                        "secondary": "#475569",
                        "secondary-content": "#ffffff",
                        "accent": "#3b82f6",
                        "accent-content": "#ffffff",
                        "neutral": "#1e293b",
                        "neutral-content": "#f8fafc",
                        "base-100": "#ffffff",
                        "base-200": "#f8fafc",
                        "base-300": "#f1f5f9",
                        "base-content": "#0f172a",
                        "info": "#0ea5e9",
                        "success": "#10b981",
                        "warning": "#f59e0b",
                        "error": "#ef4444",
                    },
                    dark: {
                        "primary": "#60a5fa",
                        "primary-content": "#0f172a",
                        "secondary": "#94a3b8",
                        "secondary-content": "#0f172a",
                        "accent": "#3b82f6",
                        "accent-content": "#ffffff",
                        "neutral": "#0f172a",
                        "neutral-content": "#e2e8f0",
                        "base-100": "#0f172a",
                        "base-200": "#1e293b",
                        "base-300": "#334155",
                        "base-content": "#e2e8f0",
                        "info": "#38bdf8",
                        "success": "#34d399",
                        "warning": "#fbbf24",
                        "error": "#f87171",
                    },
                }],
            },
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: #0f172a;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid #e2e8f0;
        }

        [data-theme="dark"] .glass-card {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid #334155;
        }
    </style>
</head>

<body class="bg-base-100 text-base-content flex flex-col min-h-screen">

    @include('user.new-layouts.header')

    <main class="flex-grow">
        @yield('main')
    </main>

    @include('user.new-layouts.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Enhanced hover effects for cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.transition = 'all 0.3s ease';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation to buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.getAttribute('href') !== '#' && !this.getAttribute('onclick')) return;
                e.preventDefault();

                const originalText = this.innerHTML;
                this.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Loading...';
                this.disabled = true;

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 1500);
            });
        });

        // Theme switcher functionality
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            updateThemeToggle(theme);
        }

        function updateThemeToggle(theme) {
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.checked = theme === 'dark';
            }
        }

        // Theme toggle event listener
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('change', function() {
                    setTheme(this.checked ? 'dark' : 'light');
                });
            }
        });

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        updateThemeToggle(savedTheme);
    </script>
    @stack('js')
</body>

</html>
