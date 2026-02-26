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
<h1 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark mt-1">Rumah {{ $id }}: Detail Warga</h1>
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
<p class="text-forest/60 text-sm mt-1">Visualisasi data sensor pH dan kekeruhan</p>
</div>
<div class="bg-mist p-1 rounded-full flex items-center">
<button class="px-4 py-2 rounded-full bg-white text-forest-dark shadow-sm text-sm font-semibold transition-all">24 Jam</button>
<button class="px-4 py-2 rounded-full hover:bg-white/50 text-forest/70 text-sm font-medium transition-all">7 Hari</button>
<button class="px-4 py-2 rounded-full hover:bg-white/50 text-forest/70 text-sm font-medium transition-all">30 Hari</button>
</div>
</div>
<div class="relative w-full flex-grow min-h-[300px] flex items-end justify-between gap-2 pt-10 pb-2 px-2">
<div class="absolute left-0 top-0 bottom-8 w-8 flex flex-col justify-between text-xs font-mono text-forest/40">
<span>9.0</span>
<span>8.0</span>
<span>7.0</span>
<span>6.0</span>
<span>5.0</span>
</div>
<div class="ml-8 w-full h-full relative">
<div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
<div class="w-full h-px bg-mint/10 border-t border-dashed border-mint/20"></div>
</div>
<svg class="w-full h-full overflow-visible drop-shadow-xl" preserveaspectratio="none" viewbox="0 0 800 300">
<defs>
<lineargradient id="gradientFlow" x1="0" x2="0" y1="0" y2="1">
<stop offset="0%" stop-color="#52B788" stop-opacity="0.4"></stop>
<stop offset="100%" stop-color="#52B788" stop-opacity="0"></stop>
</lineargradient>
</defs>
<path d="M0,150 C50,140 100,160 150,155 C200,150 250,130 300,140 C350,150 400,180 450,170 C500,160 550,120 600,125 C650,130 700,140 750,135 L800,130 L800,300 L0,300 Z" fill="url(#gradientFlow)"></path>
<path d="M0,150 C50,140 100,160 150,155 C200,150 250,130 300,140 C350,150 400,180 450,170 C500,160 550,120 600,125 C650,130 700,140 750,135 L800,130" fill="none" stroke="#2D6A4F" stroke-linecap="round" stroke-width="3" vector-effect="non-scaling-stroke"></path>
<circle cx="600" cy="125" fill="#FFFFFF" r="6" stroke="#2D6A4F" stroke-width="3"></circle>
</svg>
<div class="absolute top-[30%] left-[73%] bg-forest-dark text-white px-3 py-1.5 rounded-lg shadow-lg transform -translate-x-1/2 -translate-y-full">
<div class="font-mono text-sm font-bold">pH 7.4</div>
<div class="text-[10px] text-mint/80">14:20 PM</div>
<div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1 w-2 h-2 bg-forest-dark rotate-45"></div>
</div>
</div>
<div class="absolute bottom-0 left-8 right-0 flex justify-between text-xs font-mono text-forest/40 pt-2">
<span>00:00</span>
<span>06:00</span>
<span>12:00</span>
<span>18:00</span>
<span>24:00</span>
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
<span class="text-xs font-bold text-mint bg-mint/10 px-2 py-0.5 rounded-full">Normal</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Current pH</span>
<div class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ optional($latestData)->ph ?? '7.2' }}</div>
</div>
</div>
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-sand text-2xl">grain</span>
<span class="text-xs font-bold text-sand bg-sand/10 px-2 py-0.5 rounded-full">Alert</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Turbidity</span>
<div class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ optional($latestData)->ntu ?? '12' }}<span class="text-sm ml-1">NTU</span></div>
</div>
</div>
</div>
</div>
<div class="bg-surface rounded-xl p-6 shadow-soft border border-mint/20 flex-grow flex flex-col">
<div class="flex items-center justify-between mb-4">
<h3 class="font-serif text-lg font-semibold text-forest-dark">Kontrol Pompa</h3>
<div class="flex items-center gap-2">
<div class="h-2 w-2 rounded-full bg-forest animate-pulse"></div>
<span class="text-xs font-mono text-forest/60">CONNECTED</span>
</div>
</div>
<div class="flex-grow flex flex-col items-center justify-center py-6">
<label class="flex items-center cursor-pointer relative mb-4" for="pump-toggle">
<input checked="" class="sr-only peer" id="pump-toggle" type="checkbox"/>
<div class="w-20 h-10 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-mint/30 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-9 after:w-9 after:transition-all peer-checked:bg-forest"></div>
<span class="ml-3 text-lg font-bold text-forest-dark peer-checked:text-forest">ON</span>
</label>
<p class="text-center text-forest-dark font-medium">Status: <span class="font-bold">Active</span></p>
</div>
<div class="mt-auto bg-terra/10 border border-terra/20 rounded-xl p-4 flex gap-3 items-start">
<span class="material-symbols-outlined text-terra shrink-0">warning</span>
<div>
<p class="text-terra font-bold text-sm mb-1">Peringatan Admin</p>
<p class="text-terra/80 text-xs leading-relaxed">
                                Mematikan pompa secara paksa akan menghentikan aliran air ke rumah warga. Gunakan hanya saat darurat.
                            </p>
</div>
</div>
</div>
</div>
</div>
<div class="bg-surface rounded-xl shadow-soft border border-mint/20 overflow-hidden">
<div class="px-6 py-5 border-b border-mist flex items-center justify-between">
<h3 class="font-serif text-xl font-semibold text-forest-dark">Riwayat Peringatan (Alert Log)</h3>
<button class="text-sm text-forest font-bold hover:underline">View All History</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-mist/50 text-forest/60 text-xs uppercase tracking-wider font-semibold">
<th class="px-6 py-4 font-medium">Waktu (Time)</th>
<th class="px-6 py-4 font-medium">Sensor Issue</th>
<th class="px-6 py-4 font-medium">Value Recorded</th>
<th class="px-6 py-4 font-medium">Duration</th>
<th class="px-6 py-4 font-medium text-right">Status</th>
</tr>
</thead>
<tbody class="divide-y divide-mist">
<tr class="hover:bg-mist/30 transition-colors">
<td class="px-6 py-4">
<div class="font-mono text-sm text-forest-dark font-medium">Today, 14:20</div>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-terra text-sm">water_ph</span>
<span class="text-sm font-medium text-forest-dark">pH Spike (High)</span>
</div>
</td>
<td class="px-6 py-4 font-mono text-sm text-forest-dark">8.9 pH</td>
<td class="px-6 py-4 text-sm text-forest/70">15 mins</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-terra/10 text-terra">
                                    Unresolved
                                </span>
</td>
</tr>
<tr class="hover:bg-mist/30 transition-colors">
<td class="px-6 py-4">
<div class="font-mono text-sm text-forest-dark font-medium">Yesterday, 09:12</div>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-sand text-sm">grain</span>
<span class="text-sm font-medium text-forest-dark">Turbidity Warning</span>
</div>
</td>
<td class="px-6 py-4 font-mono text-sm text-forest-dark">45 NTU</td>
<td class="px-6 py-4 text-sm text-forest/70">2 hours</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-mint/10 text-forest">
                                    Resolved
                                </span>
</td>
</tr>
<tr class="hover:bg-mist/30 transition-colors">
<td class="px-6 py-4">
<div class="font-mono text-sm text-forest-dark font-medium">Oct 24, 18:30</div>
</td>
<td class="px-6 py-4">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-terra text-sm">power_off</span>
<span class="text-sm font-medium text-forest-dark">Pump Failure</span>
</div>
</td>
<td class="px-6 py-4 font-mono text-sm text-forest-dark">No Response</td>
<td class="px-6 py-4 text-sm text-forest/70">45 mins</td>
<td class="px-6 py-4 text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-mint/10 text-forest">
                                    Resolved
                                </span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</body></html>
