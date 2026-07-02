<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Water Filtration System - Admin Dashboard</title>
    <link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/1/1f/Logo_Politeknik_Negeri_Balikpapan.svg">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Fonts -->
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
        
        @keyframes fadeHighlight {
            0% { background-color: rgba(217, 119, 6, 0.15); }
            100% { background-color: transparent; }
        }
    </style>
</head>
<body class="bg-background-light text-primary-dark font-display antialiased overflow-hidden">
<div class="flex h-screen w-full bg-background-light overflow-hidden">
    <main class="flex flex-1 flex-col overflow-hidden bg-background-light relative">
        <!-- Header -->
        <header class="flex items-center justify-between border-b border-primary/10 bg-white/50 px-6 py-4 backdrop-blur-md z-10 sticky top-0 md:px-10">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 text-primary-dark">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1f/Logo_Politeknik_Negeri_Balikpapan.svg" alt="Logo Politeknik Negeri Balikpapan" class="h-10 w-10 object-contain animate-[pulse_3s_ease-in-out_infinite]">
                    <div class="flex flex-col">
                        <span class="font-serif font-bold text-lg leading-[1.1]">Smart Water Filtration</span>
                        <span class="text-[10px] font-bold text-primary/60 tracking-wider">System</span>
                    </div>
                </div>
            </div>
            <nav class="hidden md:flex items-center gap-8 mx-auto absolute left-1/2 -translate-x-1/2">
                <a class="text-primary-dark text-sm font-bold border-b-2 border-primary pb-1" href="/admin">{{ __('Dashboard') }}</a>
                <a class="text-primary/60 hover:text-primary text-sm font-medium transition-colors" href="/admin/settings">{{ __('Pengaturan') }}</a>
            </nav>
            <div class="flex items-center gap-3">
                <!-- Language Switcher -->
                <div class="flex items-center gap-1 bg-white border border-primary/10 p-1 rounded-xl shadow-soft">
                    <a href="/set-locale/id" class="px-2 py-1 rounded-lg text-[10px] font-bold transition-all {{ app()->getLocale() === 'id' ? 'bg-primary text-white shadow-sm' : 'text-primary/60 hover:bg-gray-100' }}">ID</a>
                    <a href="/set-locale/en" class="px-2 py-1 rounded-lg text-[10px] font-bold transition-all {{ app()->getLocale() === 'en' ? 'bg-primary text-white shadow-sm' : 'text-primary/60 hover:bg-gray-100' }}">EN</a>
                </div>
                <div class="flex items-center gap-3 rounded-lg bg-white px-3 py-1.5 shadow-soft border border-primary/10">
                    <div class="flex flex-col text-right">
                        <p class="text-sm font-bold text-primary-dark">{{ Auth::user()->name ?? 'Pak Budi' }}</p>
                        <p class="text-xs text-primary/60">Admin</p>
                    </div>
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-amber-100 flex items-center justify-center border-2 border-white shadow-sm shrink-0">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name ?? 'Pak Budi' }}&backgroundColor=ffdfbf" alt="avatar" class="w-full h-full object-cover">
                    </div>
                    <a href="{{ route('logout') }}" aria-label="{{ __('Log Out') }}" class="ml-2 flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[16px]">logout</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <div class="flex-1 overflow-y-auto p-6 md:p-10 pb-24">
            <div class="mx-auto max-w-7xl">
                
                <!-- Title & Selector -->
                <div class="mb-8 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-primary-dark md:text-4xl">{{ __('Dashboard') }}</h2>
                    </div>
                    <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-xl border border-primary/10 shadow-soft">
                        <span class="material-symbols-outlined text-primary text-xl">home_pin</span>
                        <label for="resident-select" class="text-sm font-bold text-primary-dark">{{ __('Pilih Rumah:') }}</label>
                        <select id="resident-select" class="rounded-lg border-0 bg-transparent py-1 pl-1 pr-8 text-sm font-bold text-primary focus:ring-0 cursor-pointer">
                            @foreach($residents as $res)
                                <option value="{{ $res->username }}" {{ $loop->first ? 'selected' : '' }}>
                                    {{ $res->name }} (Blok {{ match($res->username) { 'krisna' => 'K-01', 'siti' => 'A-05', 'rahman' => 'B-02', default => strtoupper($res->username) } }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 1: Metrics (pH, Suhu, Kekeruhan) -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mb-6">
                    <!-- Card 1: pH -->
                    <div class="bg-white p-6 rounded-xl shadow-soft border-l-4 border-blue-500 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-400">PH</span>
                            <span id="ph-val" class="text-4xl font-extrabold text-primary-dark mt-2">-</span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-500 shadow-sm">
                            <span class="material-symbols-outlined text-2xl">water_drop</span>
                        </div>
                    </div>

                    <!-- Card 2: Suhu Air -->
                    <div class="bg-white p-6 rounded-xl shadow-soft border-l-4 border-amber-500 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">{{ __('SUHU AIR') }}</span>
                            <span id="suhu-val" class="text-4xl font-extrabold text-primary-dark mt-2">-</span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-500 shadow-sm">
                            <span class="material-symbols-outlined text-2xl">thermostat</span>
                        </div>
                    </div>

                    <!-- Card 3: Kekeruhan -->
                    <div class="bg-white p-6 rounded-xl shadow-soft border-l-4 border-cyan-500 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">{{ __('KEKERUHAN') }}</span>
                            <span id="turbidity-val" class="text-4xl font-extrabold text-primary-dark mt-2">-</span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-500 shadow-sm">
                            <span class="material-symbols-outlined text-2xl">blur_on</span>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Chart & Quality -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-4 mb-6">
                    <!-- Chart -->
                    <div class="md:col-span-3 bg-white p-6 rounded-xl shadow-soft border border-primary/10 flex flex-col justify-between font-bold">
                        <div class="flex items-center justify-between mb-4 border-b border-primary/5 pb-3">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-primary-dark">{{ __('Smart Water Filtration System') }}</h3>
                                <p class="text-xs text-primary/60">{{ __('Grafik pH, Kekeruhan, dan Suhu berdasarkan data tersimpan') }}</p>
                            </div>
                            <div class="flex items-center gap-1 bg-amber-50 p-1 rounded-lg border border-primary/10" id="chart-filters">
                                <button onclick="setChartRange('24h')" id="btn-24h" class="px-3 py-1.5 rounded-md text-xs font-bold bg-white text-primary shadow-sm transition-all">{{ __('24 Jam') }}</button>
                                <button onclick="setChartRange('7d')" id="btn-7d" class="px-3 py-1.5 rounded-md text-xs font-medium text-primary/70 hover:text-primary transition-all">{{ __('7 Hari') }}</button>
                                <button onclick="setChartRange('30d')" id="btn-30d" class="px-3 py-1.5 rounded-md text-xs font-medium text-primary/70 hover:text-primary transition-all">{{ __('30 Hari') }}</button>
                            </div>
                        </div>
                        <div class="relative w-full h-[260px]">
                            <canvas id="waterQualityChart"></canvas>
                        </div>
                    </div>

                    <!-- Quality Card -->
                    <div id="quality-card" class="md:col-span-1 bg-white p-6 rounded-xl shadow-soft border-l-4 border-yellow-500 border border-primary/10 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">{{ __('KUALITAS') }}</span>
                            <div id="quality-val" class="text-3xl font-extrabold text-primary-dark mt-4">-</div>
                            <div class="mt-4 pt-3 border-t border-primary/5 flex flex-col gap-1 text-[11px] font-semibold text-primary/60">
                                <div class="flex justify-between">
                                    <span>{{ __('Aman') }}</span>
                                    <span class="font-mono text-green-600 bg-green-50 px-1.5 py-0.5 rounded" id="quality-safe-count">0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ __('Tidak Aman') }}</span>
                                    <span class="font-mono text-red-600 bg-red-50 px-1.5 py-0.5 rounded" id="quality-unsafe-count">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-8">
                            <span id="quality-desc" class="text-xs text-primary/60 font-medium">{{ __('Memuat...') }}</span>
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50 text-yellow-500 shadow-sm">
                                <span class="material-symbols-outlined text-2xl">desktop_windows</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Realtime Database Table -->
                <div class="bg-white rounded-xl p-6 shadow-soft border border-primary/10 relative overflow-hidden">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 border-b border-primary/5 pb-4">
                        <div>
                            <h3 class="font-serif text-xl font-bold text-primary-dark">{{ __('Smart Water Filtration System') }}</h3>
                            <p class="text-primary/60 text-sm mt-1">{{ __('Realtime Database') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2 px-3 py-1.5 bg-primary/5 rounded-lg border border-primary/10">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                <span class="text-xs font-bold text-primary-dark" id="countdown-text">{{ __('Update dalam') }} 60s</span>
                            </div>
                            <button onclick="loadSensorHistory()" class="flex items-center gap-2 px-3.5 py-1.5 bg-primary/10 hover:bg-primary/20 text-primary-dark rounded-lg text-xs font-bold transition-colors">
                                <span class="material-symbols-outlined text-sm">refresh</span>{{ __('Refresh') }}
                            </button>
                            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold shadow-md transition-all shadow-blue-500/20 hover:shadow-blue-500/40">
                                <span class="material-symbols-outlined text-sm">download</span>{{ __('Cetak Report') }}
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto rounded-xl border border-primary/5">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-amber-50/50 border-b border-primary/10">
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">No</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">{{ __('Waktu') }}</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">PH</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">{{ __('SUHU') }}</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">{{ __('KEKERUHAN') }}</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">{{ __('KUALITAS') }}</th>
                                </tr>
                            </thead>
                            <tbody id="sensor-history-body">
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center text-primary/40">
                                        <div class="flex flex-col items-center gap-3">
                                            <span class="material-symbols-outlined text-[40px] text-primary animate-pulse">sensors</span>
                                            <span class="text-sm font-medium">{{ __('Memuat data sensor...') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between mt-4 text-primary/50 text-xs">
                        <span id="total-records">{{ __('Menampilkan') }} 0 {{ __('data') }}</span>
                        <span id="last-updated">{{ __('Terakhir diperbarui') }}: -</span>
                    </div>
                </div>

                <!-- Row 4: Clear Data Section -->
                <div class="bg-white rounded-xl p-6 shadow-soft border border-red-100 relative overflow-hidden mt-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 border-b border-red-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-500">
                                <span class="material-symbols-outlined text-xl">delete_sweep</span>
                            </div>
                            <div>
                                <h3 class="font-serif text-lg font-bold text-primary-dark">{{ __('Kelola Data Sensor') }}</h3>
                                <p class="text-primary/60 text-xs mt-0.5">{{ __('Hapus data sensor berdasarkan periode atau hapus semua') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <!-- Pilih Warga -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-primary/70 uppercase tracking-wider">{{ __('Warga') }}</label>
                            <select id="clear-username" class="rounded-lg border border-primary/15 bg-amber-50/30 px-3 py-2.5 text-sm font-semibold text-primary-dark focus:ring-2 focus:ring-primary/20 focus:border-primary/30">
                                <option value="all">{{ __('Semua Warga') }}</option>
                                @foreach($residents as $res)
                                    <option value="{{ $res->username }}">{{ $res->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dari Tanggal -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-primary/70 uppercase tracking-wider">{{ __('Dari Tanggal') }}</label>
                            <input type="date" id="clear-date-from" class="rounded-lg border border-primary/15 bg-amber-50/30 px-3 py-2.5 text-sm font-semibold text-primary-dark focus:ring-2 focus:ring-primary/20 focus:border-primary/30">
                        </div>

                        <!-- Sampai Tanggal -->
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-bold text-primary/70 uppercase tracking-wider">{{ __('Sampai Tanggal') }}</label>
                            <input type="date" id="clear-date-to" class="rounded-lg border border-primary/15 bg-amber-50/30 px-3 py-2.5 text-sm font-semibold text-primary-dark focus:ring-2 focus:ring-primary/20 focus:border-primary/30">
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col gap-2">
                            <button onclick="showDeleteConfirm(false)" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-bold shadow-md transition-all shadow-red-500/20 hover:shadow-red-500/40 active:scale-[0.97]">
                                <span class="material-symbols-outlined text-sm">delete</span>{{ __('Hapus Periode') }}
                            </button>
                            <button onclick="showDeleteConfirm(true)" class="flex items-center justify-center gap-2 px-4 py-2.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-bold shadow-md transition-all shadow-red-700/20 hover:shadow-red-700/40 active:scale-[0.97]">
                                <span class="material-symbols-outlined text-sm">delete_forever</span>{{ __('Hapus Semua Data') }}
                            </button>
                        </div>
                    </div>

                    <!-- Feedback message -->
                    <div id="clear-feedback" class="hidden mt-4 px-4 py-3 rounded-lg text-sm font-bold flex items-center gap-2"></div>
                </div>

            </div>
        </div>
    </main>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
    <div class="bg-white rounded-2xl shadow-deep max-w-md w-full mx-4 overflow-hidden animate-[fadeIn_0.2s_ease-out]">
        <div class="p-6 border-b border-red-100 bg-red-50/50">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100 text-red-600">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-red-700">{{ __('Konfirmasi Hapus Data') }}</h3>
                    <p class="text-sm text-red-600/70">{{ __('Tindakan ini tidak bisa dibatalkan') }}</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <p id="delete-modal-message" class="text-sm text-primary-dark leading-relaxed mb-6"></p>
            <div class="flex gap-3 justify-end">
                <button onclick="hideDeleteConfirm()" class="px-5 py-2.5 rounded-lg border border-primary/15 text-primary-dark text-sm font-bold hover:bg-gray-50 transition-colors">
                    {{ __('Batal') }}
                </button>
                <button id="delete-confirm-btn" onclick="executeDelete()" class="px-5 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-bold shadow-md shadow-red-600/20 transition-all active:scale-[0.97]">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">delete_forever</span>
                        {{ __('Ya, Hapus') }}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const apiBase = "{{ url('/api') }}";
    let currentUsername = '{{ $residents->first()->username ?? "krisna" }}';
    let countdownValue = 60;
    let previousDataIds = [];
    let waterQualityChart = null;
    let currentRange = '24h';

    const translations = {
        noSensorData: "{{ __('Belum ada data') }}",
        descGood: "{{ __('Kualitas air optimal untuk kebutuhan sehari-hari. Semua indikator dalam batas wajar.') }}",
        descModerate: "{{ __('Kualitas air sedang. Disarankan untuk memantau filtrasi.') }}",
        descUnhealthy: "{{ __('Air kotor atau tidak layak pakai. Filtrasi aktif.') }}",
        good: "{{ __('Aman') }}",
        moderate: "{{ __('Status Normal') }}",
        unhealthy: "{{ __('Tidak Aman') }}",
        loading: "{{ __('Memuat...') }}",
        showing: "{{ __('Menampilkan') }}",
        data: "{{ __('data') }}",
        lastUpdated: "{{ __('Terakhir diperbarui') }}",
        updateIn: "{{ __('Update dalam') }}"
    };

    function getWaterQuality(ph, ntu) {
        if (ph === null || ntu === null || ph === undefined || ntu === undefined || isNaN(parseFloat(ph)) || isNaN(parseFloat(ntu))) {
            return { status: 'N/A', class: 'text-gray-500 bg-gray-50 border-gray-100', desc: translations.noSensorData };
        }
        
        const phVal = parseFloat(ph);
        const ntuVal = parseFloat(ntu);
        
        const isPhNormal = phVal >= 6.5 && phVal <= 8.5;
        const isNtuNormal = ntuVal <= 5;
        
        if (isPhNormal && isNtuNormal) {
            return { 
                status: translations.good, 
                class: 'text-green-600 bg-green-50 border-green-200',
                desc: translations.descGood 
            };
        } else if (phVal >= 5.0 && phVal <= 9.0 && ntuVal <= 25) {
            return { 
                status: translations.moderate, 
                class: 'text-yellow-600 bg-yellow-50 border-yellow-200', 
                desc: translations.descModerate 
            };
        } else {
            return { 
                status: translations.unhealthy, 
                class: 'text-red-600 bg-red-50 border-red-200', 
                desc: translations.descUnhealthy 
            };
        }
    }

    function formatTime(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        
        const hours = String(d.getHours()).padStart(2, '0');
        const minutes = String(d.getMinutes()).padStart(2, '0');
        const seconds = String(d.getSeconds()).padStart(2, '0');
        
        return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
    }

    function updateDashboardMetrics() {
        fetch(`${apiBase}/latest-sensor-data?username=${encodeURIComponent(currentUsername)}`)
            .then(r => r.json())
            .then(data => {
                let ph = '0.0';
                let suhu = '0';
                let ntu = '0';
                let amanCount = 0;
                let tidakAmanCount = 0;
                
                if (data) {
                    const parsedPh = parseFloat(data.ph);
                    if (!isNaN(parsedPh)) ph = parsedPh.toFixed(1);
                    
                    const parsedNtu = parseFloat(data.ntu);
                    if (!isNaN(parsedNtu)) ntu = parsedNtu.toFixed(0);
                    
                    const parsedTemp = parseFloat(data.temperature);
                    if (!isNaN(parsedTemp)) suhu = parsedTemp.toFixed(1) + ' °C';
                    
                    amanCount = data.aman_count || 0;
                    tidakAmanCount = data.tidak_aman_count || 0;
                }
                
                document.getElementById('ph-val').innerText = ph;
                document.getElementById('suhu-val').innerText = suhu;
                document.getElementById('turbidity-val').innerText = ntu;
                document.getElementById('quality-safe-count').innerText = amanCount;
                document.getElementById('quality-unsafe-count').innerText = tidakAmanCount;
                
                const rawPh = data && data.ph !== null && data.ph !== undefined ? parseFloat(data.ph) : null;
                const rawNtu = data && data.ntu !== null && data.ntu !== undefined ? parseFloat(data.ntu) : null;
                
                const q = getWaterQuality(rawPh, rawNtu);
                const qualityValEl = document.getElementById('quality-val');
                if (qualityValEl) qualityValEl.innerText = q.status;
                
                // Style Quality card border-l
                const qualityCard = document.getElementById('quality-card');
                if (qualityCard) {
                    qualityCard.className = `md:col-span-1 bg-white p-6 rounded-xl shadow-soft border-l-4 ${
                        q.status === translations.good ? 'border-green-500' : (q.status === translations.moderate ? 'border-yellow-500' : (q.status === 'N/A' ? 'border-gray-300' : 'border-red-500'))
                    } border border-primary/10 flex flex-col justify-between`;
                }
                
                const qualityDescEl = document.getElementById('quality-desc');
                if (qualityDescEl) qualityDescEl.innerText = q.desc;
            })
            .catch(e => {
                console.error('Error fetching latest sensor data:', e);
                document.getElementById('ph-val').innerText = '0.0';
                document.getElementById('suhu-val').innerText = '0';
                document.getElementById('turbidity-val').innerText = '0';
            });
    }

    function loadSensorHistory() {
        fetch(`${apiBase}/sensor-history?username=${encodeURIComponent(currentUsername)}&limit=20`)
            .then(r => r.json())
            .then(records => {
                const tbody = document.getElementById('sensor-history-body');
                if (!records || records.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="px-5 py-12 text-center text-primary/40"><div class="flex flex-col items-center gap-3"><span class="material-symbols-outlined text-[40px] text-primary/50">sensors_off</span><span class="text-sm font-medium">' + translations.noSensorData + '</span></div></td></tr>';
                    document.getElementById('total-records').innerText = translations.showing + ' 0 ' + translations.data;
                    return;
                }
                
                const newIds = records.map(r => r.id);
                let html = '';
                records.forEach((rec, i) => {
                    const isNew = previousDataIds.length > 0 && !previousDataIds.includes(rec.id);
                    const phVal = rec.ph !== null ? parseFloat(rec.ph).toFixed(1) : '-';
                    const ntuVal = rec.ntu !== null ? parseFloat(rec.ntu).toFixed(0) : '-';
                    const suhuVal = rec.temperature !== null ? parseFloat(rec.temperature).toFixed(1) + '°C' : '-';
                    
                    const q = getWaterQuality(rec.ph, rec.ntu);
                    
                    html += `<tr class="${isNew ? 'animate-[fadeHighlight_0.8s_ease-out]' : ''} border-b border-primary/10 hover:bg-amber-50/20 transition-colors">`;
                    html += `<td class="px-5 py-3.5"><span class="text-xs font-mono text-primary/40">${i + 1}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono text-xs text-primary-dark/85">${formatTime(rec.created_at)}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono font-bold text-primary-dark">${phVal}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono font-bold text-primary-dark">${suhuVal}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono font-bold text-primary-dark">${ntuVal}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="px-2.5 py-1 rounded-md text-xs font-bold ${q.class} border">${q.status}</span></td>`;
                    html += '</tr>';
                });
                
                tbody.innerHTML = html;
                previousDataIds = newIds;
                document.getElementById('total-records').innerText = `${translations.showing} ${records.length} ${translations.data} ${'{{ __('terbaru') }}'}`;
                
                const now = new Date();
                document.getElementById('last-updated').innerText = `${translations.lastUpdated}: ${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}:${String(now.getSeconds()).padStart(2, '0')}`;
            })
            .catch(e => console.error('Error fetching sensor history:', e));
    }

    function initChart() {
        const ctx = document.getElementById('waterQualityChart').getContext('2d');
        waterQualityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'PH',
                        data: [],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.08)',
                        borderWidth: 2,
                        pointRadius: 2,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#3b82f6',
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: '{{ __("Suhu Air") }}',
                        data: [],
                        borderColor: '#d97706',
                        backgroundColor: 'rgba(217, 119, 6, 0.08)',
                        borderWidth: 2,
                        pointRadius: 2,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#d97706',
                        fill: false,
                        tension: 0.3
                    },
                    {
                        label: '{{ __("Kekeruhan") }}',
                        data: [],
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.08)',
                        borderWidth: 2,
                        pointRadius: 2,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#06b6d4',
                        fill: false,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: '{{ __("Nilai") }}',
                            font: { weight: 'bold', size: 11 }
                        },
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(146, 64, 14, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 8,
                            font: { size: 10 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8,
                            font: { weight: 'bold', size: 11 }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#78350f',
                        titleFont: { size: 11 },
                        bodyFont: { size: 12, weight: 'bold' }
                    }
                }
            }
        });
    }

    function loadChartData(range = currentRange) {
        currentRange = range;
        
        const ranges = ['24h', '7d', '30d'];
        ranges.forEach(r => {
            const btn = document.getElementById('btn-' + r);
            if (btn) {
                if (r === range) {
                    btn.className = 'px-3 py-1.5 rounded-md text-xs font-bold bg-white text-primary shadow-sm transition-all';
                } else {
                    btn.className = 'px-3 py-1.5 rounded-md text-xs font-medium text-primary/70 hover:text-primary transition-all';
                }
            }
        });

        fetch(`${apiBase}/chart-data?username=${encodeURIComponent(currentUsername)}&range=${range}`)
            .then(res => res.json())
            .then(data => {
                if (data && waterQualityChart) {
                    waterQualityChart.data.labels = data.labels;
                    waterQualityChart.data.datasets[0].data = data.ph_data;
                    waterQualityChart.data.datasets[1].data = data.temp_data;
                    waterQualityChart.data.datasets[2].data = data.ntu_data;
                    waterQualityChart.update();
                }
            })
            .catch(err => console.error('Error fetching chart data:', err));
    }

    function setChartRange(range) {
        loadChartData(range);
    }

    document.addEventListener('DOMContentLoaded', () => {
        initChart();
        
        const selectEl = document.getElementById('resident-select');
        if (selectEl) {
            currentUsername = selectEl.value;
            selectEl.addEventListener('change', (e) => {
                currentUsername = e.target.value;
                previousDataIds = [];
                updateDashboardMetrics();
                loadSensorHistory();
                loadChartData();
            });
        }
        
        updateDashboardMetrics();
        loadSensorHistory();
        loadChartData();
        
        setInterval(updateDashboardMetrics, 3000);
        
        setInterval(() => {
            countdownValue--;
            const el = document.getElementById('countdown-text');
            if (el) {
                if (countdownValue <= 0) {
                    el.innerText = '{{ __('Memperbarui...') }}';
                    loadSensorHistory();
                    countdownValue = 60;
                } else {
                    el.innerText = translations.updateIn + ' ' + countdownValue + 's';
                }
            }
        }, 1000);
    });

    // ===== Clear Data Functions =====
    const clearDataUrl = "{{ url('/admin/clear-data') }}";
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let pendingDeleteAll = false;

    function showDeleteConfirm(deleteAll) {
        pendingDeleteAll = deleteAll;
        const modal = document.getElementById('delete-modal');
        const msgEl = document.getElementById('delete-modal-message');

        const username = document.getElementById('clear-username').value;
        const dateFrom = document.getElementById('clear-date-from').value;
        const dateTo = document.getElementById('clear-date-to').value;

        let msg = '';
        if (deleteAll) {
            const wargaText = username === 'all' ? '{{ __("semua warga") }}' : document.getElementById('clear-username').selectedOptions[0].text;
            msg = `{{ __("Anda akan menghapus SEMUA data sensor untuk") }} ${wargaText}. {{ __("Data yang dihapus tidak bisa dikembalikan.") }}`;
        } else {
            const wargaText = username === 'all' ? '{{ __("semua warga") }}' : document.getElementById('clear-username').selectedOptions[0].text;
            let periodeText = '';
            if (dateFrom && dateTo) {
                periodeText = `{{ __("dari") }} ${dateFrom} {{ __("sampai") }} ${dateTo}`;
            } else if (dateFrom) {
                periodeText = `{{ __("dari") }} ${dateFrom}`;
            } else if (dateTo) {
                periodeText = `{{ __("sampai") }} ${dateTo}`;
            } else {
                periodeText = '{{ __("semua periode") }}';
            }
            msg = `{{ __("Anda akan menghapus data sensor untuk") }} ${wargaText} ${periodeText}. {{ __("Data yang dihapus tidak bisa dikembalikan.") }}`;
        }

        msgEl.innerText = msg;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function hideDeleteConfirm() {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function showFeedback(message, isSuccess) {
        const fb = document.getElementById('clear-feedback');
        fb.classList.remove('hidden');
        fb.className = `mt-4 px-4 py-3 rounded-lg text-sm font-bold flex items-center gap-2 ${
            isSuccess ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200'
        }`;
        fb.innerHTML = `<span class="material-symbols-outlined text-lg">${isSuccess ? 'check_circle' : 'error'}</span>${message}`;
        setTimeout(() => { fb.classList.add('hidden'); }, 5000);
    }

    function executeDelete() {
        const btn = document.getElementById('delete-confirm-btn');
        btn.disabled = true;
        btn.innerHTML = '<span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm animate-spin">progress_activity</span>{{ __("Menghapus...") }}</span>';

        const body = {};

        if (pendingDeleteAll) {
            body.username = document.getElementById('clear-username').value;
        } else {
            body.username = document.getElementById('clear-username').value;
            const dateFrom = document.getElementById('clear-date-from').value;
            const dateTo = document.getElementById('clear-date-to').value;
            if (dateFrom) body.date_from = dateFrom;
            if (dateTo) body.date_to = dateTo;
        }

        fetch(clearDataUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(body)
        })
        .then(r => r.json())
        .then(data => {
            hideDeleteConfirm();
            if (data.success) {
                showFeedback(data.message, true);
                // Refresh all dashboard data
                previousDataIds = [];
                updateDashboardMetrics();
                loadSensorHistory();
                loadChartData();
            } else {
                showFeedback(data.message || '{{ __("Gagal menghapus data.") }}', false);
            }
        })
        .catch(err => {
            hideDeleteConfirm();
            showFeedback('{{ __("Terjadi kesalahan jaringan.") }}', false);
            console.error('Delete error:', err);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">delete_forever</span>{{ __("Ya, Hapus") }}</span>';
        });
    }
</script>
</body>
</html>
