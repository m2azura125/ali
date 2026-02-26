<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EcoWater - Resident Dashboard</title>
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
                        primary: "#2D6A4F",
                        "primary-hover": "#1B4332",
                        background: "#F4F7F5",
                        surface: "#FFFFFF",
                        text: "#1B4332",
                        muted: "#95D5B2",
                        accent: {
                            safe: "#52B788",
                            warning: "#E9C46A",
                            danger: "#E76F51",
                        },
                    },
                    borderRadius: {
                        'xl': '1rem',
                        '2xl': '1.5rem',
                        '3xl': '2rem',
                        'pill': '9999px',
                    },
                    boxShadow: {
                        'soft': '0 20px 40px -10px rgba(45, 106, 79, 0.08)',
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
            background-color: #95D5B2;
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
<header class="flex flex-col md:flex-row justify-between items-start gap-4 animate-[fadeIn_0.6s_ease-out]">
<div class="flex flex-col gap-2">
<h1 class="text-4xl md:text-5xl font-bold text-primary tracking-tight leading-[1.1]">
                        Selamat Pagi,<br/>{{ Auth::user()->name ?? 'Bapak Budi' }}
                    </h1>
<div class="flex items-center gap-2 text-text/60 mt-1">
<span class="material-symbols-outlined text-[18px]">location_on</span>
<p class="font-medium">Jl. Merpati Blok A-12, Cluster Harmoni</p>
</div>
</div>
<div class="flex flex-col md:items-end gap-3 w-full md:w-auto mt-4 md:mt-0">
<div class="flex items-center gap-3 px-4 py-3 bg-white/60 backdrop-blur-md rounded-2xl shadow-sm border border-white/50">
<div class="w-10 h-10 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center border-2 border-white shadow-sm shrink-0">
<img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name ?? 'Bapak Budi' }}&backgroundColor=ffdfbf" alt="avatar" class="w-full h-full object-cover">
</div>
<div class="flex flex-col">
<span class="text-base font-bold text-[#1B4332]">{{ Auth::user()->name ?? 'Bapak Budi' }}</span>
<span class="text-xs font-medium text-[#52B788]">Warga (A-12)</span>
</div>
<a href="{{ route('logout') }}" aria-label="Keluar" class="ml-4 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
<span class="material-symbols-outlined text-[18px]">logout</span>
</a>
</div>

<div class="flex justify-end w-full md:w-auto">
<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-muted/20">
<span class="w-2 h-2 rounded-full bg-accent-safe animate-pulse"></span>
<span class="text-sm font-medium text-text/80">Sistem Online</span>
</div>
</div>
</div>
</header>
<section class="relative w-full overflow-hidden rounded-3xl bg-accent-safe/10 border border-accent-safe/20 shadow-soft transition-all duration-500 hover:shadow-lg group">
<div class="absolute top-0 right-0 w-64 h-64 bg-accent-safe/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
<div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
<div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between p-8 md:p-12 gap-8">
<div class="flex flex-col gap-4 max-w-xl">
<div class="flex items-center gap-3 mb-2">
<span class="flex items-center justify-center w-12 h-12 rounded-full bg-accent-safe text-white shadow-lg shadow-accent-safe/40">
<span class="material-symbols-outlined text-[28px]">verified_user</span>
</span>
<span class="px-4 py-1.5 rounded-full bg-accent-safe/20 text-primary text-sm font-bold tracking-wide uppercase">Status Normal</span>
</div>
<h2 class="text-3xl md:text-4xl font-bold text-text leading-tight">
                            Air Aman Digunakan
                        </h2>
<p class="text-text/70 text-lg leading-relaxed">
                            Kualitas air optimal untuk kebutuhan sehari-hari. Semua indikator dalam batas wajar.
                        </p>
</div>
<div class="flex flex-col items-center lg:items-end gap-3 w-full lg:w-auto mt-4 lg:mt-0">
<div class="glass-panel p-6 rounded-[2rem] border border-white/50 shadow-sm flex flex-col items-center gap-4 min-w-[200px]">
<span class="text-sm font-bold text-text/60 uppercase tracking-wider text-center">Filtrasi Berhasil</span>
<div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-100 shadow-inner border border-green-200">
<span class="material-symbols-outlined text-[36px] text-green-600">lightbulb</span>
</div>
<span id="relay-status" class="text-xs font-mono font-bold {{ isset($latestData) && $latestData->relay_status ? 'text-green-700 bg-green-100 border-green-200' : 'text-red-700 bg-red-100 border-red-200' }} px-3 py-1 rounded-full border">RELAY: {{ isset($latestData) && $latestData->relay_status ? 'MENYALA' : 'MATI' }}</span>
</div>
</div>
</div>
</section>
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<div class="bg-surface rounded-3xl p-8 shadow-soft border border-muted/20 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-blue-100 transition-colors"></div>
<div class="flex justify-between items-start relative z-10">
<div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
<span class="material-symbols-outlined">science</span>
</div>
<span class="text-sm font-medium text-text/40 bg-background px-3 py-1 rounded-full">Real-time</span>
</div>
<div class="relative z-10">
<span class="text-sm font-bold text-text/50 uppercase tracking-wider">Tingkat pH</span>
<div class="flex items-baseline gap-2 mt-1">
<span id="ph-value" class="text-5xl font-mono font-bold text-text">{{ isset($latestData) ? number_format($latestData->ph, 1) : '0.0' }}</span>
<span class="text-sm font-medium text-text/40">pH</span>
</div>
</div>
<div class="relative z-10 pt-4 border-t border-dashed border-gray-100">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-accent-safe"></span>
<span class="text-sm font-medium text-text/70">Normal (6.5 - 8.5)</span>
</div>
</div>
</div>
<div class="bg-surface rounded-3xl p-8 shadow-soft border border-muted/20 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-amber-100 transition-colors"></div>
<div class="flex justify-between items-start relative z-10">
<div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
<span class="material-symbols-outlined">grain</span>
</div>
<span class="text-sm font-medium text-text/40 bg-background px-3 py-1 rounded-full">Real-time</span>
</div>
<div class="relative z-10">
<span class="text-sm font-bold text-text/50 uppercase tracking-wider">Kekeruhan</span>
<div class="flex items-baseline gap-2 mt-1">
<span id="ntu-value" class="text-5xl font-mono font-bold text-text">{{ isset($latestData) ? number_format($latestData->ntu, 0) : '0' }}</span>
<span class="text-sm font-medium text-text/40">NTU</span>
</div>
</div>
<div class="relative z-10 pt-4 border-t border-dashed border-gray-100">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-accent-safe"></span>
<span class="text-sm font-medium text-text/70">Jernih (&lt; 25 NTU)</span>
</div>
</div>
</div>
<div class="bg-surface rounded-3xl p-8 shadow-soft border border-muted/20 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-rose-100 transition-colors"></div>
<div class="flex justify-between items-start relative z-10">
<div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center">
<span class="material-symbols-outlined">thermostat</span>
</div>
<span class="text-sm font-medium text-text/40 bg-background px-3 py-1 rounded-full">Real-time</span>
</div>
<div class="relative z-10">
<span class="text-sm font-bold text-text/50 uppercase tracking-wider">Suhu Air</span>
<div class="flex items-baseline gap-2 mt-1">
<span id="temp-value" class="text-5xl font-mono font-bold text-text">{{ isset($latestData) ? number_format($latestData->temperature, 0) : '0' }}&deg;</span>
<span class="text-sm font-medium text-text/40">Celsius</span>
</div>
</div>
<div class="relative z-10 pt-4 border-t border-dashed border-gray-100">
<div class="flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-accent-safe"></span>
<span class="text-sm font-medium text-text/70">Sejuk (Normal)</span>
</div>
</div>
</div>
</section>
<footer class="mt-auto pt-6 flex flex-col md:flex-row justify-between items-center text-text/40 text-sm gap-4">
<p id="refresh-timer" class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-accent-safe animate-pulse"></span> Sinkronisasi Real-time Aktif</p>
<div class="flex items-center gap-2 px-4 py-2 bg-white rounded-full border border-muted/20 shadow-sm">
<span class="material-symbols-outlined text-[16px]">info</span>
<span>Tips: Matikan pompa jika pH &gt; 8.5</span>
</div>
</footer>
</main>
</div>
<script>
    function updateData() {
        fetch('/api/latest-sensor-data')
            .then(response => response.json())
            .then(data => {
                if(data) {
                    // Update pH
                    const phValue = data.ph ? parseFloat(data.ph).toFixed(1) : '0.0';
                    document.getElementById('ph-value').innerText = phValue;
                    
                    // Update NTU
                    const ntuValue = data.ntu ? parseFloat(data.ntu).toFixed(0) : '0';
                    document.getElementById('ntu-value').innerText = ntuValue;
                    
                    // Update Suhu
                    const tempValue = data.temperature ? parseFloat(data.temperature).toFixed(0) : '0';
                    document.getElementById('temp-value').innerHTML = tempValue + '&deg;';
                    
                    // Update Relay Status
                    const relayEl = document.getElementById('relay-status');
                    if (data.relay_status) {
                        relayEl.innerText = 'RELAY: MENYALA';
                        relayEl.className = 'text-xs font-mono font-bold text-green-700 bg-green-100 border-green-200 px-3 py-1 rounded-full border';
                    } else {
                        relayEl.innerText = 'RELAY: MATI';
                        relayEl.className = 'text-xs font-mono font-bold text-red-700 bg-red-100 border-red-200 px-3 py-1 rounded-full border';
                    }
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Refresh secara background setiap 3 detik
    setInterval(updateData, 3000);
</script>
</body></html>
