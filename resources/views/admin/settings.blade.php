<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Smart Water Filtration System - Settings</title>
<link rel="icon" type="image/png" href="/logo.png">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#d97706",
                        "primary-content": "#0d1b15",
                        "background-light": "#fffbeb",
                        "background-dark": "#1c1000",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d1500",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.375rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light text-primary-dark font-display antialiased overflow-hidden">
<div class="flex h-screen w-full bg-background-light overflow-hidden">
<main class="flex flex-1 flex-col overflow-hidden bg-background-light relative">
<header class="flex items-center justify-between border-b border-primary/10 bg-white/50 px-6 py-4 backdrop-blur-md z-10 sticky top-0 md:px-10">
<div class="flex items-center gap-4">
<a href="/admin" aria-label="Go back" class="flex items-center justify-center w-10 h-10 rounded-lg bg-white hover:bg-surface-muted text-primary-dark transition-colors shadow-soft group">
<span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
</a>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">water_drop</span>
<span class="font-serif font-bold text-primary-dark">Smart Water Filtration System</span>
</div>
</div>
<nav class="hidden md:flex items-center gap-8 mx-auto absolute left-1/2 -translate-x-1/2">
<a class="text-primary/60 hover:text-primary text-sm font-medium transition-colors" href="/admin">Dashboard</a>
<a class="text-primary-dark text-sm font-bold border-b-2 border-primary pb-1" href="/admin/settings">Settings</a>
</nav>
<div class="flex items-center gap-3 rounded-lg bg-white px-3 py-1.5 shadow-soft border border-primary/10">
<div class="flex flex-col text-right">
<p class="text-sm font-bold text-primary-dark">{{ Auth::user()->name ?? 'Pak Budi' }}</p>
<p class="text-xs text-primary/60">Admin</p>
</div>
<div class="w-8 h-8 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center border-2 border-white shadow-sm shrink-0">
<img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name ?? 'Pak Budi' }}&backgroundColor=ffdfbf" alt="avatar" class="w-full h-full object-cover">
</div>
<a href="{{ route('logout') }}" aria-label="Keluar" class="ml-2 flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
<span class="material-symbols-outlined text-[16px]">logout</span>
</a>
</div>
</header>
<div class="flex-1 overflow-y-auto w-full px-4 py-8 md:py-12 pb-24">
<div class="max-w-[600px] mx-auto flex flex-col gap-8">
<div class="flex flex-col gap-2 text-center pb-4">
<h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-primary-dark font-serif">Calibration &amp; Settings</h1>
<p class="text-primary/60 font-medium">Configure safety thresholds for sensor alerts.</p>
</div>
<section class="bg-surface rounded-xl p-6 md:p-8 shadow-soft border border-transparent transition-all hover:shadow-lg relative overflow-hidden">
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-3">
<div class="p-2 bg-blue-50 rounded-lg text-blue-600">
<span class="material-symbols-outlined">science</span>
</div>
<div>
<h3 class="font-bold text-lg leading-tight text-primary-dark">pH Levels</h3>
<p class="text-xs text-primary/60 font-medium mt-0.5">Acidic vs Alkaline balance</p>
</div>
</div>
<span class="bg-primary/10 text-primary-dark px-3 py-1 rounded-lg text-sm font-bold border border-primary/20">6.5 - 8.5 pH</span>
</div>
<div class="pt-6 pb-2">
<div class="relative h-12 w-full flex items-center">
<div class="absolute w-full h-3 rounded-lg bg-gradient-to-r from-[#E76F51] via-[#d97706] to-[#E76F51] opacity-20"></div>
<div class="absolute h-3 rounded-lg bg-gradient-to-r from-[#E76F51] via-[#d97706] to-[#E76F51] left-0 right-0"></div>
<div class="absolute w-full h-3 rounded-lg bg-surface-muted -z-10"></div>
<div class="absolute left-[30%] -ml-4 top-1/2 -translate-y-1/2 group cursor-ew-resize z-20">
<div class="relative">
<div class="w-8 h-8 bg-white rounded-lg shadow-lg border-2 border-[#d97706] flex items-center justify-center transition-transform hover:scale-110">
<div class="w-2 h-2 bg-[#d97706] rounded-full"></div>
</div>
<div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-primary-dark text-white text-xs font-bold py-1 px-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                    Min: 6.5
                                </div>
</div>
</div>
<div class="absolute left-[70%] -ml-4 top-1/2 -translate-y-1/2 group cursor-ew-resize z-20">
<div class="relative">
<div class="w-8 h-8 bg-white rounded-lg shadow-lg border-2 border-[#d97706] flex items-center justify-center transition-transform hover:scale-110">
<div class="w-2 h-2 bg-[#d97706] rounded-full"></div>
</div>
<div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-primary-dark text-white text-xs font-bold py-1 px-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                    Max: 8.5
                                </div>
</div>
</div>
<div class="absolute top-1/2 -translate-y-1/2 h-3 bg-[#d97706]/20 backdrop-blur-sm left-[30%] right-[30%] pointer-events-none rounded-r-none rounded-l-none z-10 border-x border-[#d97706]/50"></div>
</div>
<div class="flex justify-between text-xs font-mono text-primary/40 mt-2">
<span>0 pH</span>
<span>7 pH</span>
<span>14 pH</span>
</div>
</div>
<p class="text-sm text-primary/60 mt-4 leading-relaxed">
                    Alerts trigger if water acidity falls below <strong class="text-primary-dark">6.5</strong> or rises above <strong class="text-primary-dark">8.5</strong>.
                </p>
</section>
<section class="bg-surface rounded-xl p-6 md:p-8 shadow-soft border border-transparent transition-all hover:shadow-lg">
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-3">
<div class="p-2 bg-amber-50 rounded-lg text-accent-sand">
<span class="material-symbols-outlined">grain</span>
</div>
<div>
<h3 class="font-bold text-lg leading-tight text-primary-dark">Turbidity Limit</h3>
<p class="text-xs text-primary/60 font-medium mt-0.5">Maximum particles allowed</p>
</div>
</div>
<div class="flex items-baseline gap-1">
<span class="text-2xl font-bold text-primary-dark">50</span>
<span class="text-sm font-medium text-primary/60">NTU</span>
</div>
</div>
<div class="py-4">
<div class="relative h-2 bg-surface-muted rounded-lg">
<div class="absolute h-full bg-accent-sand rounded-lg w-[40%]"></div>
<div class="absolute top-1/2 -translate-y-1/2 left-[40%] -ml-3 w-6 h-6 bg-white border-2 border-accent-sand rounded-lg shadow hover:scale-110 transition-transform cursor-pointer"></div>
</div>
</div>
<p class="text-sm text-primary/60 mt-2">
                    Standard clear water is below 5 NTU. Community alert triggers at <strong class="text-primary-dark">50 NTU</strong>.
                </p>
</section>
<section class="bg-surface rounded-xl p-6 md:p-8 shadow-soft border border-transparent transition-all hover:shadow-lg">
<div class="flex items-center gap-3 mb-6">
<div class="p-2 bg-rose-50 rounded-lg text-accent-terra">
<span class="material-symbols-outlined">notifications_active</span>
</div>
<h3 class="font-bold text-lg text-primary-dark">Alert Preferences</h3>
</div>
<div class="space-y-4">
<label class="flex items-start gap-4 p-4 border border-primary/10 rounded-xl cursor-pointer hover:border-primary/30 transition-colors bg-background-light/50">
<div class="relative flex items-center mt-1">
<input checked="" class="peer sr-only" type="checkbox"/>
<div class="w-11 h-6 bg-surface-muted peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#d97706]/20 rounded-md peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-sm after:h-5 after:w-5 after:transition-all peer-checked:bg-[#d97706]"></div>
</div>
<div class="flex-1">
<span class="block text-sm font-bold text-primary-dark mb-1">Email Notifications</span>
<span class="block text-xs text-primary/60 mb-3">Receive weekly reports and critical alerts.</span>
<input class="w-full text-sm bg-white border border-primary/10 rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-shadow text-primary-dark" placeholder="Enter email address" type="email" value="admin@rw04-cilandak.id"/>
</div>
</label>
<label class="flex items-start gap-4 p-4 border border-primary/10 rounded-xl cursor-pointer hover:border-primary/30 transition-colors bg-background-light/50">
<div class="relative flex items-center mt-1">
<input class="peer sr-only" type="checkbox"/>
<div class="w-11 h-6 bg-surface-muted peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#d97706]/20 rounded-md peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-sm after:h-5 after:w-5 after:transition-all peer-checked:bg-[#d97706]"></div>
</div>
<div class="flex-1">
<span class="block text-sm font-bold text-primary-dark mb-1">SMS Alerts</span>
<span class="block text-xs text-primary/60">Immediate text for critical danger levels only.</span>
</div>
</label>
</div>
</section>
</div>
</div>
<div class="sticky bottom-6 z-30 px-4 mt-auto mb-4 w-full">
<div class="max-w-[600px] mx-auto bg-white/90 backdrop-blur-xl p-3 rounded-xl flex items-center justify-between border border-primary/10 shadow-soft">
<button class="px-6 py-3 rounded-lg text-primary/60 hover:text-accent-terra hover:bg-rose-50 text-sm font-bold transition-colors flex items-center gap-2">
<span class="material-symbols-outlined text-lg">restart_alt</span>
                Reset Defaults
            </button>
<button class="px-8 py-3 bg-primary hover:bg-[#d97706] text-white rounded-lg text-sm font-bold shadow-lg shadow-primary/20 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
<span class="material-symbols-outlined text-lg">save</span>
                Save Configuration
            </button>
</div>
</div>
</main>
</div>
</body></html>


