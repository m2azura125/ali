<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Smart Water Filtration System - Admin</title>
<link rel="icon" type="image/png" href="/logo.png">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Space+Mono:wght@400;700&amp;family=Fraunces:opsz,wght@9..144,300;400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#92400e", 
                        "primary-light": "#d97706", 
                        "primary-dark": "#78350f", 
                        "accent-sand": "#fbbf24",
                        "accent-terra": "#E76F51",
                        "background-light": "#fffbeb", 
                        "background-dark": "#10221a",
                        "surface": "#FFFFFF",
                        "surface-muted": "#fef3c7",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "serif": ["Fraunces", "serif"],
                        "mono": ["Space Mono", "monospace"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.375rem", 
                        "lg": "0.5rem", 
                        "xl": "0.75rem", 
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        'soft': '0 20px 25px -5px rgb(146 64 14 / 0.05), 0 8px 10px -6px rgb(146 64 14 / 0.05)',
                        'deep': '0 25px 50px -12px rgb(146 64 14 / 0.15)',
                    }
                },
            },
        }
    </script>
<style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        .pulse-danger {
            animation: pulse-border 2s infinite;
        }
        
        @keyframes pulse-border {
            0% { box-shadow: 0 0 0 0 rgba(231, 111, 81, 0.4); border-color: rgba(231, 111, 81, 0.8); }
            70% { box-shadow: 0 0 0 10px rgba(231, 111, 81, 0); border-color: rgba(231, 111, 81, 0.4); }
            100% { box-shadow: 0 0 0 0 rgba(231, 111, 81, 0); border-color: rgba(231, 111, 81, 0.8); }
        }
    </style>
</head>
<body class="bg-background-light text-primary-dark font-display antialiased overflow-hidden">
<div class="flex h-screen w-full bg-background-light overflow-hidden">
<main class="flex flex-1 flex-col overflow-hidden bg-background-light relative">
<header class="flex items-center justify-between border-b border-primary/10 bg-white/50 px-6 py-4 backdrop-blur-md z-10 sticky top-0 md:px-10">
<div class="flex items-center gap-4">
<div class="flex items-center gap-2 text-primary-dark">
<span class="material-symbols-outlined text-primary text-3xl">water_drop</span>
<div class="flex flex-col">
<span class="font-serif font-bold text-lg leading-[1.1]">Smart Water Filtration</span>
<span class="text-[10px] font-bold text-primary/60 tracking-wider">System</span>
</div>
</div>
</div>
<nav class="hidden md:flex items-center gap-8 mx-auto absolute left-1/2 -translate-x-1/2">
<a class="text-primary-dark text-sm font-bold border-b-2 border-primary pb-1" href="/admin">Dashboard</a>
<a class="text-primary/60 hover:text-primary text-sm font-medium transition-colors" href="/admin/settings">Settings</a>
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
<div class="flex-1 overflow-y-auto p-6 md:p-10 pb-24">
<div class="mx-auto max-w-7xl">
<div class="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
<div>
<p class="mb-1 text-sm font-bold uppercase tracking-wider text-primary/60">Dashboard Admin</p>
<h2 class="font-serif text-3xl font-bold text-primary-dark md:text-4xl">Status Lingkungan</h2>
</div>
<div class="flex flex-wrap gap-4">
<div class="flex min-w-[160px] flex-col rounded-lg bg-white p-5 shadow-soft ring-1 ring-black/5">
<div class="mb-2 flex items-center gap-2 text-primary/70">
<span class="material-symbols-outlined text-[20px]">home</span>
<span class="text-sm font-medium">Total Rumah</span>
</div>
<div class="flex items-baseline gap-2">
<span class="font-mono text-3xl font-bold text-primary-dark">42</span>
<span class="rounded-lg bg-surface-muted px-2 py-0.5 text-xs font-bold text-primary">+1 New</span>
</div>
</div>
<div class="flex min-w-[160px] flex-col rounded-lg bg-white p-5 shadow-soft ring-1 ring-black/5">
<div class="mb-2 flex items-center gap-2 text-accent-terra">
<span class="material-symbols-outlined text-[20px]">warning</span>
<span class="text-sm font-medium">Status Bahaya</span>
</div>
<div class="flex items-baseline gap-2">
<span class="font-mono text-3xl font-bold text-primary-dark">2</span>
<span class="text-xs font-medium text-accent-terra">Action needed</span>
</div>
</div>
</div>
</div>
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
@foreach($residents as $resident)
@php
    $block = match($resident->username) {
        'krisna' => 'Blok K-01',
        'siti' => 'Blok A-05',
        'rahman' => 'Blok B-02',
        default => 'Blok ' . strtoupper($resident->username)
    };
    $latest = $resident->latestData;
    $hasData = !is_null($latest);
    
    // Check if status is normal
    // Normal: pH between 6.5 and 8.5 AND NTU <= 25 AND Temperature between 10 and 37
    $isNormal = true;
    if ($hasData) {
        if ($latest->ph < 6.5 || $latest->ph > 8.5 || $latest->ntu > 25 || $latest->temperature > 37 || $latest->temperature < 10) {
            $isNormal = false;
        }
    }
@endphp
<a href="/admin/house/{{ $resident->username }}" class="group relative flex cursor-pointer flex-col overflow-hidden rounded-xl border border-transparent bg-white p-6 md:p-8 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:border-primary/20">
<div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-[#d97706]/10 blur-3xl"></div>
<div class="mb-4 flex items-start justify-between relative z-10">
<div class="flex flex-col">
<span class="font-mono text-xs font-bold uppercase tracking-widest text-[#d97706]">{{ $block }}</span>
<h3 class="mt-1 font-serif text-2xl font-bold text-primary-dark">{{ $resident->name }}</h3>
</div>
<div @class([
    'flex h-12 w-12 items-center justify-center rounded-xl ring-4 ring-white shadow-sm',
    'bg-green-50 text-green-500' => $isNormal,
    'bg-red-50 text-red-500 pulse-danger' => !$isNormal
])>
<span class="material-symbols-outlined">{{ $isNormal ? 'check_circle' : 'warning' }}</span>
</div>
</div>
<div class="flex flex-col gap-4 flex-1 mt-2 relative z-10">
<div class="flex justify-between items-center border-b border-primary/5 pb-3">
<div class="flex items-center gap-2 text-primary/60">
<span class="material-symbols-outlined text-[18px]">thermostat</span>
<span class="text-sm font-bold">Status Suhu Air</span>
</div>
<span @class([
    'px-3 py-1 rounded-lg text-xs font-bold bg-primary/10 text-primary-dark',
    'bg-red-50 text-red-600' => $hasData && ($latest->temperature > 37 || $latest->temperature < 10)
])>{{ $hasData ? $latest->temperature . ' °C' : 'Normal' }}</span>
</div>
<div class="flex justify-between items-center border-b border-primary/5 pb-3">
<div class="flex items-center gap-2 text-primary/60 border-b border-transparent">
<span class="material-symbols-outlined text-[18px]">science</span>
<span class="text-sm font-bold">Status PH Air</span>
</div>
<span @class([
    'px-3 py-1 rounded-lg text-xs font-bold bg-primary/10 text-primary-dark',
    'bg-red-50 text-red-600' => $hasData && ($latest->ph < 6.5 || $latest->ph > 8.5)
])>{{ $hasData ? $latest->ph . ' pH' : 'Normal' }}</span>
</div>
<div class="flex justify-between items-center">
<div class="flex items-center gap-2 text-primary/60 border-b border-transparent">
<span class="material-symbols-outlined text-[18px]">blur_on</span>
<span class="text-sm font-bold">Status Kekeruhan</span>
</div>
<span @class([
    'px-3 py-1 rounded-lg text-xs font-bold bg-primary/10 text-primary-dark',
    'bg-red-50 text-red-600' => $hasData && $latest->ntu > 25
])>{{ $hasData ? $latest->ntu . ' NTU' : 'Jernih' }}</span>
</div>
</div>
<div class="mt-6 pt-2 relative z-10">
<button class="w-full flex items-center justify-center gap-2 rounded-lg bg-surface-muted py-3.5 text-sm font-bold text-primary-dark transition-colors group-hover:bg-[#d97706]/20">
<span>Detail Warga</span>
<span class="material-symbols-outlined text-[18px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all">arrow_forward</span>
</button>
</div>
</a>
@endforeach
</div>
</div>
</div>
</main>
</div>
</body></html>

