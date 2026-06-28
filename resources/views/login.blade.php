<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Smart Water Filtration System - Login</title>
<link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/1/1f/Logo_Politeknik_Negeri_Balikpapan.svg">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#d97706",
                        "primary-dark": "#92400e",
                        "background-light": "#fffbeb",
                        "background-dark": "#1c1000",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d1500",
                        "text-main": "#1c0f00",
                        "text-muted": "#92400e",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.375rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
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
<style>
    .preview-website-button {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: flex-start;
        gap: 0.65rem;
        padding: 0.22rem;
        border-radius: 8px;
        color: #07140f;
        text-decoration: none;
        perspective: 1200px;
        transform-style: preserve-3d;
        isolation: isolate;
        z-index: 0;
        transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1), filter 0.4s ease;
        will-change: transform;
    }

    .preview-website-button::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 8px;
        background: radial-gradient(circle at 50% 0%, rgba(217, 119, 6, 0.34), rgba(217, 119, 6, 0) 68%);
        filter: blur(14px);
        transform: translateY(10px) scale(0.9);
        opacity: 0.7;
        transition: transform 0.4s ease, opacity 0.4s ease;
        pointer-events: none;
    }

    .preview-website-button__platform {
        position: absolute;
        inset: 0;
        z-index: -1;
        border-radius: 8px;
        background: linear-gradient(160deg, rgba(45, 21, 0, 0.96) 0%, rgba(70, 35, 0, 0.96) 38%, rgba(28, 10, 0, 0.98) 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 16px 32px rgba(6, 20, 14, 0.45);
        transform: translateY(8px) translateZ(-18px);
        transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.4s ease;
        pointer-events: none;
    }

    .preview-website-button__face {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        min-height: 3.2rem;
        padding: 0.92rem 1.15rem;
        border-radius: 8px;
        background: linear-gradient(135deg, #fbbf24 0%, #d97706 45%, #b45309 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5), 0 10px 24px rgba(217, 119, 6, 0.24);
        transform: translateZ(24px) rotateX(14deg) rotateY(-16deg);
        transform-origin: left center;
        overflow: hidden;
        white-space: nowrap;
        transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.4s ease;
    }

    .preview-website-button__face::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.38), rgba(255, 255, 255, 0) 42%);
        opacity: 0.8;
        pointer-events: none;
    }

    .preview-website-button__face::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        border: 1px solid rgba(255, 255, 255, 0.18);
        pointer-events: none;
    }

    .preview-website-button__icon,
    .preview-website-button__chevron {
        position: relative;
        z-index: 1;
        font-size: 1.05rem;
        line-height: 1;
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .preview-website-button__label {
        position: relative;
        z-index: 1;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        transform: translateX(-10px);
        transition: max-width 0.4s ease, opacity 0.22s ease, transform 0.4s ease;
    }

    .preview-website-button:hover,
    .preview-website-button:focus-visible {
        transform: translateY(-3px) rotateX(10deg) rotateY(-14deg);
    }

    .preview-website-button:hover::before,
    .preview-website-button:focus-visible::before {
        transform: translateY(18px) scale(0.98);
        opacity: 1;
    }

    .preview-website-button:hover .preview-website-button__platform,
    .preview-website-button:focus-visible .preview-website-button__platform {
        transform: translateY(14px) translateZ(-18px);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 24px 40px rgba(6, 20, 14, 0.5);
    }

    .preview-website-button:hover .preview-website-button__face,
    .preview-website-button:focus-visible .preview-website-button__face {
        transform: translateZ(28px) rotateX(0deg) rotateY(0deg);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5), 0 18px 34px rgba(217, 119, 6, 0.28);
    }

    .preview-website-button:hover .preview-website-button__label,
    .preview-website-button:focus-visible .preview-website-button__label {
        max-width: 12rem;
        opacity: 1;
        transform: translateX(0);
    }

    .preview-website-button:hover .preview-website-button__chevron,
    .preview-website-button:focus-visible .preview-website-button__chevron {
        transform: translateX(2px) translateY(-1px) rotate(8deg);
        opacity: 1;
    }

    .preview-website-button:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.22);
    }

    .preview-website-button:active .preview-website-button__face {
        transform: translateZ(18px) scale(0.985);
    }

    @media (prefers-reduced-motion: reduce) {
        .preview-website-button,
        .preview-website-button::before,
        .preview-website-button__platform,
        .preview-website-button__face,
        .preview-website-button__icon,
        .preview-website-button__label,
        .preview-website-button__chevron {
            transition: none !important;
        }

        .preview-website-button:hover,
        .preview-website-button:focus-visible {
            transform: none;
        }
    }
</style>
</head>
<body class="bg-background-light text-text-main font-display antialiased min-h-screen flex items-center justify-center overflow-hidden relative selection:bg-primary selection:text-text-main">
<!-- Ambient Background Gradient & Blobs -->
<div class="absolute inset-0 bg-noise pointer-events-none z-0"></div>
<div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
<div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] bg-primary-dark/10 rounded-full blur-[100px] pointer-events-none z-0"></div>
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/20 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

<div class="w-full max-w-md mx-4 relative z-10" x-data="{ role: '{{ old('role', 'warga') }}', id: '{{ old('identity') }}', pin: '', error: {{ $errors->any() ? 'true' : 'false' }}, errorMsg: '{{ $errors->first('loginError') ?: 'Mohon isi ID dan PIN dengan benar.' }}', submit(e) { if(!this.id || !this.pin) { e.preventDefault(); this.error = true; this.errorMsg = 'Mohon isi ID dan PIN dengan benar.'; setTimeout(() => this.error = false, 5000); } } }">
    <!-- Login Card Container -->
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-deep rounded-2xl p-8 md:p-10">
        <!-- Logo and Header -->
        <div class="flex flex-col items-center mb-8">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/95 p-2 shadow-md border border-gray-100 mb-4 transition-all duration-300 hover:scale-105">
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/Logo_Politeknik_Negeri_Balikpapan.svg" alt="Logo Politeknik Negeri Balikpapan" class="h-full w-full object-contain">
            </div>
            <h1 class="text-2xl font-bold text-text-main tracking-tight">Smart Water Filtration System</h1>
            <p class="text-text-muted text-sm mt-1">Masuk untuk memantau lingkungan</p>
        </div>

        <!-- Role Selector (Pill Toggle) -->
        <div class="bg-gray-100 p-1 rounded-xl flex relative mb-8 shadow-inner border border-gray-200/50">
            <!-- Sliding Background -->
            <div :class="role === 'warga' ? 'left-1' : 'left-[calc(50%+4px)]'" class="absolute top-1 bottom-1 w-[calc(50%-5px)] bg-white rounded-lg shadow-sm transition-all duration-300 ease-out border border-gray-100"></div>
            <button type="button" :class="role === 'warga' ? 'text-primary-dark font-bold' : 'text-text-muted hover:text-text-main font-medium'" @click="role = 'warga'" class="flex-1 relative z-10 py-2.5 text-center text-sm transition-colors duration-300 rounded-lg focus:outline-none">
                Warga
            </button>
            <button type="button" :class="role === 'rt' ? 'text-primary-dark font-bold' : 'text-text-muted hover:text-text-main font-medium'" @click="role = 'rt'" class="flex-1 relative z-10 py-2.5 text-center text-sm transition-colors duration-300 rounded-lg focus:outline-none">
                Ketua RT
            </button>
        </div>

        <!-- Form Inputs -->
        <form :class="{ 'animate-shake': error }" @submit="submit" action="/login" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="role" :value="role" />
            <!-- ID Input -->
            <div class="group relative">
                <label class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2 transition-all group-focus-within:text-primary-dark" for="identity" x-text="role === 'warga' ? 'Nomor Rumah' : 'ID Admin'"></label>
                <div class="relative">
                    <input :placeholder="role === 'warga' ? 'Misal: krisna' : 'Misal: admin'" name="identity" class="block w-full px-4 py-3 text-base text-text-main bg-white/50 border border-gray-300/80 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 outline-none" id="identity" type="text" x-model="id"/>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none group-focus-within:text-primary transition-colors text-[20px]">
                        home_pin
                    </span>
                </div>
            </div>
            <!-- PIN Input -->
            <div class="group relative">
                <label class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2 transition-all group-focus-within:text-primary-dark" for="pin">PIN Keamanan</label>
                <div class="relative">
                    <input class="block w-full px-4 py-3 text-base text-text-main bg-white/50 border border-gray-300/80 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-gray-400 tracking-widest outline-none" name="pin" id="pin" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" type="password" x-model="pin"/>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none group-focus-within:text-primary transition-colors text-[20px]">
                        lock
                    </span>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="pt-2">
                <button class="w-full py-3.5 px-6 bg-primary hover:bg-primary-dark text-white hover:text-white font-bold text-base rounded-lg shadow-md shadow-primary/20 hover:shadow-primary/40 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 group/btn" type="submit">
                    <span x-text="role === 'warga' ? 'Masuk Lingkungan' : 'Masuk Dashboard'"></span>
                    <span class="material-symbols-outlined group-hover/btn:translate-x-1 transition-transform text-[20px]">arrow_forward</span>
                </button>
            </div>
        </form>

        <!-- Footer Links -->
        <div class="mt-8 text-center">
            <a class="text-xs font-semibold text-text-muted hover:text-primary-dark underline decoration-transparent hover:decoration-current transition-all" href="#">
                Lupa PIN atau ID?
            </a>
        </div>
    </div>

    <!-- Error Toast (Alpine Controlled) -->
    <div class="absolute -bottom-24 left-1/2 -translate-x-1/2 w-full max-w-sm" style="display: none;" x-show="error" x-transition:enter="transition ease-out duration-300" x-transition:enter-end="opacity-100 translate-y-0" x-transition:enter-start="opacity-0 translate-y-4" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 translate-y-4" x-transition:leave-start="opacity-100 translate-y-0">
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg flex items-center gap-3">
            <span class="material-symbols-outlined">error</span>
            <p class="text-sm font-medium" x-text="errorMsg"></p>
        </div>
    </div>
</div>
</body></html>

