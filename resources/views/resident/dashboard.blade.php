<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Smart Water Filtration System - Warga</title>
<link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/1/1f/Logo_Politeknik_Negeri_Balikpapan.svg">
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;family=Space+Mono:wght@400;700&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Config -->
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        mono: ['Space Mono', 'monospace'],
                    },
                    colors: {
                        primary: "#92400e",
                        "primary-hover": "#78350f",
                        background: "#fffbeb",
                        surface: "#FFFFFF",
                        text: "#78350f",
                        muted: "#fcd34d",
                        accent: {
                            safe: "#d97706",
                            warning: "#E9C46A",
                            danger: "#E76F51",
                        },
                    },
                    borderRadius: {
                        'sm': '0.25rem',
                        'md': '0.375rem',
                        'lg': '0.5rem',
                        'xl': '0.75rem',
                        '2xl': '1rem',
                        '3xl': '1.25rem',
                        'pill': '9999px',
                    },
                    boxShadow: {
                        'soft': '0 20px 40px -10px rgba(146, 64, 14, 0.08)',
                        'inner-soft': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
                    },
                    backgroundImage: {
                        'noise': "url(\"data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E\")",
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
            background-color: #fcd34d;
            border-radius: 20px;
            border: 3px solid transparent;
            background-clip: content-box;
        }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-background text-text antialiased min-h-screen relative overflow-x-hidden selection:bg-accent-safe selection:text-white font-sans">
<div class="fixed inset-0 pointer-events-none z-50 bg-noise mix-blend-overlay opacity-40"></div>
<div class="max-w-[1440px] mx-auto min-h-screen flex flex-col md:flex-row">

<main class="flex-1 p-6 md:p-12 lg:p-16 flex flex-col gap-10">
@php
    $hour = date('H');
    if ($hour >= 5 && $hour < 11) {
        $greeting = 'Selamat Pagi';
    } elseif ($hour >= 11 && $hour < 15) {
        $greeting = 'Selamat Siang';
    } elseif ($hour >= 15 && $hour < 18) {
        $greeting = 'Selamat Sore';
    } else {
        $greeting = 'Selamat Malam';
    }
@endphp
<header class="flex flex-col md:flex-row justify-between items-start gap-4 animate-[fadeIn_0.6s_ease-out]">
<div class="flex flex-col gap-2">
<h1 class="text-4xl md:text-5xl font-bold text-primary tracking-tight leading-[1.1]">
                        {{ __($greeting) }},<br/>{{ Auth::user()->name ?? 'Bapak Budi' }}
                    </h1>
<div class="flex items-center gap-2 text-text/60 mt-1">
<span class="material-symbols-outlined text-[18px]">location_on</span>
<p class="font-medium">Jl. Merpati Blok A-12, Cluster Harmoni</p>
</div>
</div>
<div class="flex flex-col md:items-end gap-3 w-full md:w-auto mt-4 md:mt-0">
<div class="flex items-center gap-3">
    <!-- Language Switcher -->
    <div class="flex items-center gap-1 bg-white/60 backdrop-blur border border-white/50 p-1.5 rounded-xl shadow-sm">
        <a href="/set-locale/id" class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition-all {{ app()->getLocale() === 'id' ? 'bg-primary text-white shadow-sm' : 'text-text-muted hover:bg-gray-100' }}">ID</a>
        <a href="/set-locale/en" class="px-2.5 py-1.5 rounded-lg text-xs font-bold transition-all {{ app()->getLocale() === 'en' ? 'bg-primary text-white shadow-sm' : 'text-text-muted hover:bg-gray-100' }}">EN</a>
    </div>
    <div class="flex items-center gap-3 px-4 py-3 bg-white/60 backdrop-blur-md rounded-xl shadow-sm border border-white/50">
        <div class="w-10 h-10 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center border-2 border-white shadow-sm shrink-0">
            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name ?? 'Bapak Budi' }}&backgroundColor=ffdfbf" alt="avatar" class="w-full h-full object-cover">
        </div>
        <div class="flex flex-col">
            <span class="text-base font-bold text-[#78350f]">{{ Auth::user()->name ?? 'Bapak Budi' }}</span>
            <span class="text-xs font-medium text-[#d97706]">{{ __('Warga') }} (A-12)</span>
        </div>
        <a href="{{ route('logout') }}" aria-label="{{ __('Log Out') }}" class="ml-4 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
            <span class="material-symbols-outlined text-[18px]">logout</span>
        </a>
    </div>
</div>

<div class="flex justify-end w-full md:w-auto">
<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg shadow-sm border border-muted/20">
<span class="w-2 h-2 rounded-full bg-accent-safe animate-pulse"></span>
<span class="text-sm font-medium text-text/80">{{ __('Sistem Online') }}</span>
</div>
</div>
</div>
</header>
@php
    $isKotor = true;
    if(isset($latestData) && $latestData->relay_status) {
        $isKotor = false;
    }
@endphp
<<section id="status-section" class="relative w-full overflow-hidden rounded-xl {{ $isKotor ? 'bg-red-50 border-red-200' : 'bg-accent-safe/10 border-accent-safe/20' }} shadow-soft transition-all duration-500 hover:shadow-lg group">
<div id="blur-bg-1" class="absolute top-0 right-0 w-64 h-64 {{ $isKotor ? 'bg-red-200' : 'bg-accent-safe/20' }} rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
<div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
<div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between p-8 md:p-12 gap-8">
<div class="flex flex-col gap-4 max-w-xl">
<div class="flex items-center gap-3 mb-2">
<span id="status-icon-container" class="flex items-center justify-center w-12 h-12 rounded-xl {{ $isKotor ? 'bg-red-500 shadow-red-500/40' : 'bg-accent-safe shadow-accent-safe/40' }} text-white shadow-lg">
<span id="status-icon" class="material-symbols-outlined text-[28px]">{{ $isKotor ? 'warning' : 'verified_user' }}</span>
</span>
<span id="status-badge" class="px-4 py-1.5 rounded-lg {{ $isKotor ? 'bg-red-100 text-red-700' : 'bg-accent-safe/20 text-primary' }} text-sm font-bold tracking-wide uppercase">{{ $isKotor ? __('Status Tidak Normal') : __('Status Normal') }}</span>
</div>
<h2 id="status-text" class="text-3xl md:text-4xl font-bold {{ $isKotor ? 'text-red-700' : 'text-text' }} leading-tight">
                            {{ $isKotor ? __('Air Tidak Aman Digunakan') : __('Air Aman Digunakan') }}
                        </h2>
<p id="status-desc" class="text-text/70 text-lg leading-relaxed">
                            {{ $isKotor ? __('Kualitas air tidak memenuhi standar (air kotor). Sedang dalam proses filtrasi atau pembuangan.') : __('Kualitas air optimal untuk kebutuhan sehari-hari. Semua indikator dalam batas wajar.') }}
                        </p>
</div>
<div class="flex flex-col items-center lg:items-end gap-3 w-full lg:w-auto mt-4 lg:mt-0">
<div class="glass-panel p-6 rounded-xl border border-white/50 shadow-sm flex flex-col items-center gap-2 min-w-[200px]">
<span class="text-sm font-bold text-text/60 uppercase tracking-wider text-center">{{ __('Filtrasi Berhasil') }}</span>
<div class="flex h-16 w-16 items-center justify-center rounded-xl bg-green-100 shadow-inner border border-green-200">
<span class="material-symbols-outlined text-[36px] text-green-600">lightbulb</span>
</div>
<span id="relay-status" class="text-xs font-mono font-bold {{ isset($latestData) && $latestData->relay_status ? 'text-green-700 bg-green-100 border-green-200' : 'text-red-700 bg-red-100 border-red-200' }} px-3 py-1 rounded-lg border">RELAY: {{ isset($latestData) && $latestData->relay_status ? __('MENYALA') : __('MATI') }}</span>
<span class="text-[11px] font-semibold text-text/50 uppercase mt-1">{{ __('Aktivasi') }}: <span id="relay-count" class="font-mono font-bold text-primary">{{ $relayCount ?? 0 }}</span> {{ __('Kali') }}</span>
<div class="w-full mt-3 pt-3 border-t border-dashed border-text/10 flex flex-col gap-1.5 text-[11px] font-semibold text-text/60">
    <div class="flex justify-between w-full">
        <span>{{ __('Aman') }}</span>
        <span class="font-mono text-green-600 bg-green-50 px-1.5 py-0.5 rounded" id="safe-count">{{ $safeCount ?? 0 }}</span>
    </div>
    <div class="flex justify-between w-full">
        <span>{{ __('Tidak Aman') }}</span>
        <span class="font-mono text-red-600 bg-red-50 px-1.5 py-0.5 rounded" id="unsafe-count">{{ $unsafeCount ?? 0 }}</span>
    </div>
</div>
</div>
</div>
</div>
</section>
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<div class="bg-surface rounded-xl p-8 shadow-soft border border-muted/20 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-blue-100 transition-colors"></div>
<div class="flex justify-between items-start relative z-10">
<div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
<span class="material-symbols-outlined">science</span>
</div>
<span class="text-sm font-medium text-text/40 bg-background px-3 py-1 rounded-lg">Real-time</span>
</div>
<div class="relative z-10">
<span class="text-sm font-bold text-text/50 uppercase tracking-wider">{{ __('TINGKAT PH') }}</span>
<div class="flex items-baseline gap-2 mt-1">
<span id="ph-value" class="text-5xl font-mono font-bold text-text">{{ isset($latestData) ? number_format($latestData->ph, 1) : '0.0' }}</span>
<span class="text-sm font-medium text-text/40">pH</span>
</div>
</div>
<div class="relative z-10 pt-4 border-t border-dashed border-gray-100">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-accent-safe"></span>
<span class="text-sm font-medium text-text/70">{{ __('Normal (6.5 - 8.5)') }}</span>
</div>
</div>
</div>
<div class="bg-surface rounded-xl p-8 shadow-soft border border-muted/20 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-amber-100 transition-colors"></div>
<div class="flex justify-between items-start relative z-10">
<div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
<span class="material-symbols-outlined">grain</span>
</div>
<span class="text-sm font-medium text-text/40 bg-background px-3 py-1 rounded-lg">Real-time</span>
</div>
<div class="relative z-10">
<span class="text-sm font-bold text-text/50 uppercase tracking-wider">{{ __('KEKERUHAN') }}</span>
<div class="flex items-baseline gap-2 mt-1">
<span id="ntu-value" class="text-5xl font-mono font-bold text-text">{{ isset($latestData) ? number_format($latestData->ntu, 0) : '0' }}</span>
<span class="text-sm font-medium text-text/40">NTU</span>
</div>
</div>
<div class="relative z-10 pt-4 border-t border-dashed border-gray-100">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-accent-safe"></span>
<span class="text-sm font-medium text-text/70">{{ __('Jernih (< 5 NTU)') }}</span>
</div>
</div>
</div>
<div class="bg-surface rounded-xl p-8 shadow-soft border border-muted/20 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-rose-100 transition-colors"></div>
<div class="flex justify-between items-start relative z-10">
<div class="w-12 h-12 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
<span class="material-symbols-outlined">thermostat</span>
</div>
<span class="text-sm font-medium text-text/40 bg-background px-3 py-1 rounded-lg">Real-time</span>
</div>
<div class="relative z-10">
<span class="text-sm font-bold text-text/50 uppercase tracking-wider">{{ __('SUHU AIR') }}</span>
<div class="flex items-baseline gap-2 mt-1">
<span id="temp-value" class="text-5xl font-mono font-bold text-text">{{ isset($latestData) ? number_format($latestData->temperature, 0) : '0' }}&deg;</span>
<span class="text-sm font-medium text-text/40">Celsius</span>
</div>
</div>
<div class="relative z-10 pt-4 border-t border-dashed border-gray-100">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-accent-safe"></span>
<span class="text-sm font-medium text-text/70">{{ __('Sejuk (Normal)') }}</span>
</div>
</div>
</div>
</section>

<!-- Data Sensor History Table -->
<section class="bg-surface rounded-xl p-8 shadow-soft border border-muted/20 relative overflow-hidden">
<div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
<div class="relative z-10">
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
<div>
<h3 class="text-xl font-bold text-text flex items-center gap-2"><span class="material-symbols-outlined text-primary text-[24px]">table_chart</span> {{ __('Riwayat Data Sensor') }}</h3>
<p class="text-text/50 text-sm mt-1">{{ __('Data sensor terbaru, auto-refresh setiap 1 menit') }}</p>
</div>
<div class="flex items-center gap-3">
<div class="flex items-center gap-2 px-4 py-2 bg-accent-safe/10 rounded-lg border border-accent-safe/20"><span class="w-2 h-2 rounded-full bg-accent-safe animate-pulse"></span><span class="text-xs font-bold text-primary" id="countdown-text">{{ __('Update dalam') }} 60s</span></div>
<button onclick="loadSensorHistory()" class="flex items-center gap-2 px-4 py-2 bg-primary/10 hover:bg-primary/20 text-primary rounded-lg text-sm font-bold transition-colors"><span class="material-symbols-outlined text-[16px]">refresh</span>{{ __('Refresh') }}</button>
</div>
</div>
<div class="overflow-x-auto rounded-lg border border-muted/20">
<table class="w-full text-left">
<thead><tr class="bg-background/80 border-b border-muted/20">
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">#</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">pH</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">NTU</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">{{ __('Suhu') }}</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">{{ __('Fuzzy') }}</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">{{ __('Relay') }}</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-text/50">{{ __('Waktu') }}</th>
</tr></thead>
<tbody id="sensor-history-body">
<tr><td colspan="7" class="px-5 py-12 text-center text-text/40"><div class="flex flex-col items-center gap-3"><span class="material-symbols-outlined text-[40px] text-muted animate-pulse">sensors</span><span class="text-sm font-medium">{{ __('Memuat data sensor...') }}</span></div></td></tr>
</tbody>
</table>
</div>
<div class="flex items-center justify-between mt-4 text-text/40 text-xs"><span id="total-records">{{ __('Menampilkan') }} 0 {{ __('data') }}</span><span id="last-updated">{{ __('Terakhir diperbarui') }}: -</span></div>
</div>
</section>
<footer class="mt-auto pt-6 flex flex-col md:flex-row justify-between items-center text-text/40 text-sm gap-4">
<p id="refresh-timer" class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-accent-safe animate-pulse"></span> {{ __('Sinkronisasi Real-time Aktif') }}</p>
<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-muted/20 shadow-sm">
<span class="material-symbols-outlined text-[16px]">info</span>
<span>{{ __('Tips: Matikan pompa jika pH > 8.5') }}</span>
</div>
</footer>
</main>
</div>
<script>
    const translations = {
        statusNormal: "{{ __('Status Normal') }}",
        statusAbnormal: "{{ __('Status Tidak Normal') }}",
        waterSafe: "{{ __('Air Aman Digunakan') }}",
        waterUnsafe: "{{ __('Air Tidak Aman Digunakan') }}",
        descNormal: "{{ __('Kualitas air optimal untuk kebutuhan sehari-hari. Semua indikator dalam batas wajar.') }}",
        descAbnormal: "{{ __('Kualitas air tidak memenuhi standar (air kotor). Sedang dalam proses filtrasi atau pembuangan.') }}",
        relayOn: "RELAY: {{ __('MENYALA') }}",
        relayOff: "RELAY: {{ __('MATI') }}",
        loadingData: "{{ __('Memuat data sensor...') }}",
        showing: "{{ __('Menampilkan') }}",
        data: "{{ __('data') }}",
        lastUpdated: "{{ __('Terakhir diperbarui') }}",
        noSensorData: "{{ __('Belum ada data sensor') }}",
        updateIn: "{{ __('Update dalam') }}"
    };

    function updateData() {
        fetch('/api/latest-sensor-data?username={{ urlencode($sensorUsername ?? Auth::user()->username ?? '') }}')
            .then(response => response.json())
            .then(data => {
                if (!data) return;

                const phValue = data.ph;
                const ntuValue = data.ntu;
                const tempValue = data.temperature;
                const relayStatus = data.relay_status;

                // Update pH Card
                document.getElementById('ph-value').innerText = phValue !== null ? parseFloat(phValue).toFixed(1) : '0.0';

                // Update Turbidity Card
                document.getElementById('ntu-value').innerText = ntuValue !== null ? parseFloat(ntuValue).toFixed(0) : '0';

                // Update Temperature Card
                document.getElementById('temp-value').innerHTML = tempValue !== null ? parseFloat(tempValue).toFixed(0) + '&deg;' : '0&deg;';

                // Relay ON = Air Aman, Relay OFF = Air Tidak Aman
                const isKotor = !relayStatus;
                
                // Update status elemen UI
                const statusSection = document.getElementById('status-section');
                const statusIconContainer = document.getElementById('status-icon-container');
                const statusIcon = document.getElementById('status-icon');
                const statusBadge = document.getElementById('status-badge');
                const statusText = document.getElementById('status-text');
                const statusDesc = document.getElementById('status-desc');
                const blurBg1 = document.getElementById('blur-bg-1');
                
                if (isKotor) {
                    if (statusSection) statusSection.className = 'relative w-full overflow-hidden rounded-xl bg-red-50 border border-red-200 shadow-soft transition-all duration-500 hover:shadow-lg group';
                    if (statusIconContainer) statusIconContainer.className = 'flex items-center justify-center w-12 h-12 rounded-xl bg-red-500 text-white shadow-lg shadow-red-500/40';
                    if (statusIcon) statusIcon.innerText = 'warning';
                    if (statusBadge) {
                        statusBadge.className = 'px-4 py-1.5 rounded-lg bg-red-100 text-red-700 text-sm font-bold tracking-wide uppercase';
                        statusBadge.innerText = translations.statusAbnormal;
                    }
                    if (statusText) {
                        statusText.innerText = translations.waterUnsafe;
                        statusText.className = 'text-3xl md:text-4xl font-bold text-red-700 leading-tight';
                    }
                    if (statusDesc) statusDesc.innerText = translations.descAbnormal;
                    if (blurBg1) blurBg1.className = 'absolute top-0 right-0 w-64 h-64 bg-red-200 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2';
                } else {
                    if (statusSection) statusSection.className = 'relative w-full overflow-hidden rounded-xl bg-accent-safe/10 border border-accent-safe/20 shadow-soft transition-all duration-500 hover:shadow-lg group';
                    if (statusIconContainer) statusIconContainer.className = 'flex items-center justify-center w-12 h-12 rounded-xl bg-accent-safe text-white shadow-lg shadow-accent-safe/40';
                    if (statusIcon) statusIcon.innerText = 'verified_user';
                    if (statusBadge) {
                        statusBadge.className = 'px-4 py-1.5 rounded-lg bg-accent-safe/20 text-primary text-sm font-bold tracking-wide uppercase';
                        statusBadge.innerText = translations.statusNormal;
                    }
                    if (statusText) {
                        statusText.innerText = translations.waterSafe;
                        statusText.className = 'text-3xl md:text-4xl font-bold text-text leading-tight';
                    }
                    if (statusDesc) statusDesc.innerText = translations.descNormal;
                    if (blurBg1) blurBg1.className = 'absolute top-0 right-0 w-64 h-64 bg-accent-safe/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2';
                }

                // Update Relay Status
                const relayEl = document.getElementById('relay-status');
                if (relayEl) {
                    if (relayStatus) {
                        relayEl.innerText = translations.relayOn;
                        relayEl.className = 'text-xs font-mono font-bold text-green-700 bg-green-100 border-green-200 px-3 py-1 rounded-lg border';
                    } else {
                        relayEl.innerText = translations.relayOff;
                        relayEl.className = 'text-xs font-mono font-bold text-red-700 bg-red-100 border-red-200 px-3 py-1 rounded-lg border';
                    }
                }

                const relayCountEl = document.getElementById('relay-count');
                if (relayCountEl && data && data.relay_count !== undefined) {
                    relayCountEl.innerText = data.relay_count;
                }
                const safeCountEl = document.getElementById('safe-count');
                if (safeCountEl && data && data.aman_count !== undefined) {
                    safeCountEl.innerText = data.aman_count;
                }
                const unsafeCountEl = document.getElementById('unsafe-count');
                if (unsafeCountEl && data && data.tidak_aman_count !== undefined) {
                    unsafeCountEl.innerText = data.tidak_aman_count;
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('ph-value').innerText = '0.0';
                document.getElementById('ntu-value').innerText = '0';
                document.getElementById('temp-value').innerHTML = '0&deg;';
            });
    }

    let previousDataIds = [];
    let countdownValue = 60;

    function formatRelayStatus(status) {
        if (status) return '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-green-50 text-green-700 text-xs font-bold border border-green-200">ON</span>';
        return '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-red-50 text-red-600 text-xs font-bold border border-red-200">OFF</span>';
    }

    function formatTime(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        const months = {{ app()->getLocale() === 'en' ? "['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']" : "['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']" }};
        return String(d.getDate()).padStart(2,'0') + ' ' + months[d.getMonth()] + ' ' + String(d.getHours()).padStart(2,'0') + ':' + String(d.getMinutes()).padStart(2,'0') + ':' + String(d.getSeconds()).padStart(2,'0');
    }

    function loadSensorHistory() {
        fetch('/api/sensor-history?username={{ urlencode($sensorUsername ?? Auth::user()->username ?? '') }}&limit=20')
            .then(r => r.json())
            .then(records => {
                const tbody = document.getElementById('sensor-history-body');
                if (!records || records.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="px-5 py-12 text-center text-text/40"><div class="flex flex-col items-center gap-3"><span class="material-symbols-outlined text-[40px] text-muted">sensors_off</span><span class="text-sm font-medium">' + translations.noSensorData + '</span></div></td></tr>';
                    document.getElementById('total-records').innerText = translations.showing + ' 0 ' + translations.data;
                    return;
                }
                const newIds = records.map(r => r.id);
                let html = '';
                records.forEach((rec, i) => {
                    const isNew = previousDataIds.length > 0 && !previousDataIds.includes(rec.id);
                    const phVal = rec.ph !== null ? parseFloat(rec.ph).toFixed(1) : '-';
                    const ntuVal = rec.ntu !== null ? parseFloat(rec.ntu).toFixed(0) : '-';
                    const tempVal = rec.temperature !== null ? parseFloat(rec.temperature).toFixed(1) + '\u00b0C' : '-';
                    const fuzzyVal = rec.fuzzy !== null ? parseFloat(rec.fuzzy).toFixed(2) : '-';
                    const phColor = rec.ph !== null && (rec.ph < 6.5 || rec.ph > 8.5) ? 'text-red-600 font-bold' : 'text-text';
                    const ntuColor = rec.ntu !== null && rec.ntu > 25 ? 'text-amber-600 font-bold' : 'text-text';
                    html += '<tr class="' + (isNew ? 'animate-[fadeHighlight_0.8s_ease-out]' : '') + ' border-b border-muted/10 hover:bg-background/50 transition-colors">';
                    html += '<td class="px-5 py-3.5"><span class="text-xs font-mono text-text/40">' + (i+1) + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono font-bold ' + phColor + '">' + phVal + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono font-bold ' + ntuColor + '">' + ntuVal + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono font-bold text-text">' + tempVal + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono text-sm text-text/70">' + fuzzyVal + '</span></td>';
                    html += '<td class="px-5 py-3.5">' + formatRelayStatus(rec.relay_status) + '</td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono text-xs text-text/50">' + formatTime(rec.created_at) + '</span></td>';
                    html += '</tr>';
                });
                tbody.innerHTML = html;
                previousDataIds = newIds;
                document.getElementById('total-records').innerText = translations.showing + ' ' + records.length + ' ' + translations.data + ' ' + '{{ __('terbaru') }}';
                const now = new Date();
                document.getElementById('last-updated').innerText = translations.lastUpdated + ': ' + String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0') + ':' + String(now.getSeconds()).padStart(2,'0');
            })
            .catch(e => console.error('Error:', e));
    }

    // Initial load
    loadSensorHistory();
    updateData();

    // Refresh sensor cards every 3 seconds
    setInterval(updateData, 3000);

    // Refresh table every 10 seconds with countdown
    setInterval(() => {
        countdownValue--;
        const el = document.getElementById('countdown-text');
        if (countdownValue <= 0) {
            el.innerText = '{{ __('Memperbarui...') }}';
            loadSensorHistory();
            countdownValue = 60;
        } else {
            el.innerText = translations.updateIn + ' ' + countdownValue + 's';
        }
    }, 1000);
</script>
</body></html>

