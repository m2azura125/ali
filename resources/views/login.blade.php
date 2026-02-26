<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Eco-Community Water Monitor - Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec8a",
                        "primary-dark": "#0ea660",
                        "background-light": "#f6f8f7",
                        "background-dark": "#10221a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1c2e26",
                        "text-main": "#0d1b15",
                        "text-muted": "#5c7066",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
                    animation: {
                        'shake': 'shake 0.82s cubic-bezier(.36,.07,.19,.97) both',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        shake: {
                            '10%, 90%': { transform: 'translate3d(-1px, 0, 0)' },
                            '20%, 80%': { transform: 'translate3d(2px, 0, 0)' },
                            '30%, 50%, 70%': { transform: 'translate3d(-4px, 0, 0)' },
                            '40%, 60%': { transform: 'translate3d(4px, 0, 0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                },
            },
        }
    </script>
<script defer="" src="//unpkg.com/alpinejs"></script>
</head>
<body class="bg-background-light text-text-main font-display antialiased h-screen overflow-hidden selection:bg-primary selection:text-text-main">
<div class="flex h-full w-full" x-data="{ role: '{{ old('role', 'warga') }}', id: '{{ old('identity') }}', pin: '', error: {{ $errors->any() ? 'true' : 'false' }}, errorMsg: '{{ $errors->first('loginError') ?: 'Mohon isi ID dan PIN dengan benar.' }}', submit(e) { if(!this.id || !this.pin) { e.preventDefault(); this.error = true; this.errorMsg = 'Mohon isi ID dan PIN dengan benar.'; setTimeout(() => this.error = false, 5000); } } }">
<!-- Left Section: Abstract Zen Illustration -->
<div class="hidden lg:flex w-1/2 bg-background-dark relative overflow-hidden flex-col justify-between p-12 text-white">
<!-- Ambient Background Gradient -->
<div class="absolute inset-0 bg-gradient-to-br from-[#10221a] via-[#153326] to-[#0d1b15] z-0"></div>
<!-- Abstract Shapes (Simulated SVG Waves) -->
<div class="absolute inset-0 opacity-40 z-0">
<svg class="absolute top-0 left-0 w-full h-full text-primary/20" preserveAspectRatio="none" viewBox="0 0 100 100">
<path class="animate-float" d="M0 0 C 50 100 80 100 100 0 Z" fill="currentColor" style="animation-duration: 10s;"></path>
</svg>
<div class="absolute -bottom-1/4 -right-1/4 w-[800px] h-[800px] bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
<div class="absolute top-1/4 -left-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl"></div>
</div>
<!-- Content Overlay -->
<div class="relative z-10">
<div class="flex items-center gap-2 mb-8">
<span class="material-symbols-outlined text-primary text-4xl">water_drop</span>
<span class="text-xl font-bold tracking-tight text-primary">EcoWater</span>
</div>
</div>
<div class="relative z-10 max-w-lg">
<h2 class="text-5xl font-bold leading-tight mb-6 tracking-tight">
                    Harmoni Air, <br/>
<span class="text-primary">Ketenangan Warga.</span>
</h2>
<p class="text-lg text-gray-300 font-light leading-relaxed">
                    Pantau kualitas air lingkungan Anda secara real-time. Teknologi sederhana untuk ketenangan pikiran bersama.
                </p>
</div>
<div class="relative z-10 text-sm text-gray-400">
                &copy; {{ date('Y') }} Eco-Community Monitor
            </div>
</div>
<!-- Right Section: Login Form -->
<div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-24 bg-background-light relative">
<!-- Mobile Header (Visible only on small screens) -->
<div class="lg:hidden absolute top-6 left-6 flex items-center gap-2">
<span class="material-symbols-outlined text-primary-dark text-3xl">water_drop</span>
<span class="text-lg font-bold text-text-main">EcoWater</span>
</div>
<div class="w-full max-w-md">
<!-- Header Text -->
<div class="mb-10 text-center lg:text-left">
<h1 class="text-4xl font-bold text-text-main mb-3 tracking-tight">Selamat Datang</h1>
<p class="text-text-muted text-lg">Masuk untuk memantau lingkungan.</p>
</div>
<!-- Role Selector (Pill Toggle) -->
<div class="bg-gray-200 p-1.5 rounded-full flex relative mb-12 shadow-inner">
<!-- Sliding Background -->
<div :class="role === 'warga' ? 'left-1.5' : 'left-[calc(50%+3px)]'" class="absolute top-1.5 bottom-1.5 w-[calc(50%-6px)] bg-white rounded-full shadow-sm transition-all duration-300 ease-out"></div>
<button :class="role === 'warga' ? 'text-primary-dark' : 'text-text-muted hover:text-text-main'" @click="role = 'warga'" class="flex-1 relative z-10 py-3 text-center text-sm font-semibold transition-colors duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary/50">
                        Warga
                    </button>
<button :class="role === 'rt' ? 'text-primary-dark' : 'text-text-muted hover:text-text-main'" @click="role = 'rt'" class="flex-1 relative z-10 py-3 text-center text-sm font-semibold transition-colors duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary/50">
                        Ketua RT
                    </button>
</div>
<!-- Form Inputs -->
<form :class="{ 'animate-shake': error }" @submit="submit" action="/login" method="POST" class="space-y-8">
@csrf
<input type="hidden" name="role" :value="role" />
<!-- ID Input -->
<div class="group relative">
<label class="block text-sm font-medium text-text-muted mb-1 transition-all group-focus-within:text-primary-dark" for="identity" x-text="role === 'warga' ? 'Nomor Rumah' : 'ID Admin'"></label>
<input :placeholder="role === 'warga' ? 'Misal: krisna' : 'Misal: admin'" name="identity" class="block w-full px-0 py-3 text-xl text-text-main bg-transparent border-0 border-b-2 border-gray-200 focus:border-primary focus:ring-0 transition-colors placeholder:text-gray-300 outline-none" id="identity" type="text" x-model="id"/>
<span class="material-symbols-outlined absolute right-0 bottom-3 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors">
                            home_pin
                        </span>
</div>
<!-- PIN Input -->
<div class="group relative">
<label class="block text-sm font-medium text-text-muted mb-1 transition-all group-focus-within:text-primary-dark" for="pin">PIN Keamanan</label>
<input class="block w-full px-0 py-3 text-xl text-text-main bg-transparent border-0 border-b-2 border-gray-200 focus:border-primary focus:ring-0 transition-colors placeholder:text-gray-300 tracking-widest outline-none" name="pin" id="pin" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" type="password" x-model="pin"/>
<span class="material-symbols-outlined absolute right-0 bottom-3 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors">
                            lock
                        </span>
</div>
<!-- Submit Button -->
<div class="pt-4">
<button class="w-full py-4 px-6 bg-primary hover:bg-primary-dark text-text-main hover:text-white font-bold text-lg rounded-full shadow-lg shadow-primary/20 hover:shadow-primary/40 transform active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 group/btn" type="submit">
<span x-text="role === 'warga' ? 'Masuk Lingkungan' : 'Masuk Dashboard'"></span>
<span class="material-symbols-outlined group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
</button>
</div>
</form>
<!-- Footer Links -->
<div class="mt-8 text-center">
<a class="text-sm text-text-muted hover:text-primary-dark underline decoration-transparent hover:decoration-current transition-all" href="#">
                        Lupa PIN atau ID?
                    </a>
</div>
<!-- Error Toast (Alpine Controlled) -->
<div class="absolute bottom-6 left-1/2 -translate-x-1/2 lg:left-auto lg:right-auto w-full max-w-sm" style="display: none;" x-show="error" x-transition:enter="transition ease-out duration-300" x-transition:enter-end="opacity-100 translate-y-0" x-transition:enter-start="opacity-0 translate-y-4" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 translate-y-4" x-transition:leave-start="opacity-100 translate-y-0">
<div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg flex items-center gap-3 mx-4 lg:mx-0">
<span class="material-symbols-outlined">error</span>
<p class="text-sm font-medium" x-text="errorMsg"></p>
</div>
</div>
</div>
</div>
</div>
</body></html>
