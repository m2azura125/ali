<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>House Detail View - Eco-Community Water Monitor</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,300;400;600;700&amp;family=Manrope:wght@300;400;500;600;700&amp;family=Space+Mono:wght@400;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Theme Configuration -->
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "forest": "#2D6A4F",
                        "forest-dark": "#1B4332",
                        "forest-light": "#40916C",
                        "mint": "#52B788",
                        "mint-light": "#D8F3DC",
                        "sand": "#E9C46A",
                        "terra": "#E76F51",
                        "mist": "#F4F7F5",
                        "surface": "#FFFFFF",
                    },
                    fontFamily: {
                        "serif": ["Fraunces", "serif"],
                        "sans": ["Manrope", "sans-serif"],
                        "mono": ["Space Mono", "monospace"],
                    },
                    borderRadius: {
                        "lg": "1.5rem", // 24px
                        "xl": "2rem", // 32px
                        "2xl": "2.5rem",
                    },
                    boxShadow: {
                        "soft": "0 20px 25px -5px rgb(45 106 79 / 0.05), 0 8px 10px -6px rgb(45 106 79 / 0.05)",
                    }
                },
            },
        }
    </script>
<style>
        /* Custom Scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent; 
        }
        ::-webkit-scrollbar-thumb {
            background: #D8F3DC; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #95D5B2; 
        }

        /* Toggle Switch Animation */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #2D6A4F;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #2D6A4F;
        }
        
        /* Subtle noise texture */
        .bg-noise {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-mist text-forest-dark font-sans min-h-screen relative overflow-x-hidden selection:bg-mint selection:text-forest-dark">
<div class="fixed inset-0 bg-noise pointer-events-none z-0"></div>
<div class="relative z-10 flex flex-col min-h-screen max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
<header class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
<div class="flex items-center gap-4">
<a href="/admin" aria-label="Go back" class="flex items-center justify-center w-12 h-12 rounded-full bg-white hover:bg-mint-light text-forest transition-colors shadow-soft group">
<span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
</a>
<div>
<div class="flex items-center gap-3">
<span class="px-3 py-1 rounded-full bg-forest text-white text-xs font-bold tracking-wider uppercase">Admin View</span>
<span class="flex h-2 w-2 rounded-full bg-mint animate-pulse"></span>
</div>
<h1 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark mt-1">Detail Warga: {{ $selectedResident->name ?? $id }}</h1>
</div>
</div>
<div class="flex items-center gap-3">
<button class="flex items-center gap-2 px-6 py-3 rounded-full bg-mint-light hover:bg-mint/30 text-forest-dark font-semibold transition-colors">
<span class="material-symbols-outlined text-[20px]">history</span>
<span>Logs</span>
</button>
<button class="flex items-center gap-2 px-6 py-3 rounded-full bg-forest hover:bg-forest-light text-white font-bold shadow-lg shadow-forest/20 transition-all hover:scale-105">
<span class="material-symbols-outlined text-[20px]">call</span>
<span>Call Resident</span>
</button>
</div>
</header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
<div class="lg:col-span-2 flex flex-col gap-6">
<div class="bg-surface rounded-xl p-6 md:p-8 shadow-soft border border-mint/20 h-full flex flex-col">
<div class="flex flex-wrap items-center justify-between gap-4 mb-8">
<div>
<h2 class="font-serif text-2xl font-semibold text-forest-dark">Kualitas Air</h2>
<p class="text-forest/60 text-sm mt-1">Grafik pH berdasarkan data sensor yang tersimpan</p>
</div>
<div class="bg-mist p-1 rounded-full flex items-center">
@foreach ($rangeOptions as $rangeKey => $option)
<a href="{{ url()->current() }}?range={{ $rangeKey }}" class="px-4 py-2 rounded-full text-sm transition-all {{ $range === $rangeKey ? 'bg-white text-forest-dark shadow-sm font-semibold' : 'hover:bg-white/50 text-forest/70 font-medium' }}">
{{ $option['label'] }}
</a>
@endforeach
</div>
</div>
<div class="relative w-full flex-grow min-h-[300px] flex items-end justify-between gap-2 pt-10 pb-2 px-2">
<div class="absolute left-0 top-0 bottom-8 w-8 flex flex-col justify-between text-xs font-mono text-forest/40">
@foreach ($yLabels as $label)
<span>{{ $label }}</span>
@endforeach
</div>
<div class="ml-8 w-full h-full relative">
<div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
</div>
@if ($hasChartData)
<svg class="w-full h-full overflow-visible drop-shadow-xl" preserveaspectratio="none" viewbox="0 0 800 300">
<defs>
<lineargradient id="gradientFlow" x1="0" x2="0" y1="0" y2="1">
<stop offset="0%" stop-color="#52B788" stop-opacity="0.4"></stop>
<stop offset="100%" stop-color="#52B788" stop-opacity="0"></stop>
</lineargradient>
</defs>
<path d="{{ $areaPath }}" fill="url(#gradientFlow)"></path>
<path d="{{ $linePath }}" fill="none" stroke="#2D6A4F" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" vector-effect="non-scaling-stroke"></path>
<circle cx="{{ $latestPoint['x'] }}" cy="{{ $latestPoint['y'] }}" fill="#FFFFFF" r="6" stroke="#2D6A4F" stroke-width="3"></circle>
</svg>
<div class="absolute bg-forest-dark text-white px-3 py-1.5 rounded-lg shadow-lg transform -translate-x-1/2 -translate-y-full" style="left: calc({{ ($latestPoint['x'] / 800) * 100 }}% + 2rem); top: calc({{ ($latestPoint['y'] / 300) * 100 }}% - 0.5rem);">
<div class="font-mono text-sm font-bold">pH {{ number_format($latestPoint['ph'], 1) }}</div>
<div class="text-[10px] text-mint/80">{{ $latestPoint['time'] }}</div>
<div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1 w-2 h-2 bg-forest-dark rotate-45"></div>
</div>
@else
<div class="h-full flex items-center justify-center rounded-2xl border border-dashed border-mint/30 bg-mist/40 text-center px-6">
<div>
<p class="text-forest-dark font-semibold">Belum ada data pH untuk ditampilkan.</p>
<p class="text-sm text-forest/60 mt-1">Grafik akan otomatis mengikuti data sensor asli setelah data masuk ke tabel.</p>
</div>
</div>
@endif
</div>
<div class="absolute bottom-0 left-8 right-0 flex justify-between text-xs font-mono text-forest/40 pt-2">
@foreach ($xLabels as $label)
<span>{{ $label }}</span>
@endforeach
</div>
</div>
</div>
</div>
<div class="flex flex-col gap-6">
<div class="bg-surface rounded-xl p-6 shadow-soft border border-mint/20">
<h3 class="font-serif text-lg font-semibold text-forest-dark mb-4">Sensor Terkini</h3>
<div class="grid grid-cols-2 gap-4">
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-mint text-2xl">water_drop</span>
<span class="text-xs font-bold {{ isset($latestData) && $latestData->ph !== null && $latestData->ph >= 6.5 && $latestData->ph <= 8.5 ? 'text-mint bg-mint/10' : (isset($latestData) && $latestData->ph !== null ? 'text-terra bg-terra/10' : 'text-forest/60 bg-white') }} px-2 py-0.5 rounded-full">
{{ isset($latestData) && $latestData->ph !== null ? ($latestData->ph >= 6.5 && $latestData->ph <= 8.5 ? 'Normal' : 'Periksa') : 'Belum Ada' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Current pH</span>
<div class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->ph !== null ? number_format($latestData->ph, 1) : '-' }}</div>
</div>
</div>
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-sand text-2xl">grain</span>
<span class="text-xs font-bold {{ isset($latestData) && $latestData->ntu !== null && $latestData->ntu <= 25 ? 'text-mint bg-mint/10' : (isset($latestData) && $latestData->ntu !== null ? 'text-sand bg-sand/10' : 'text-forest/60 bg-white') }} px-2 py-0.5 rounded-full">
{{ isset($latestData) && $latestData->ntu !== null ? ($latestData->ntu <= 25 ? 'Jernih' : 'Alert') : 'Belum Ada' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Turbidity</span>
<div class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->ntu !== null ? number_format($latestData->ntu, 0) : '-' }}<span class="text-sm ml-1">NTU</span></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body></html>
