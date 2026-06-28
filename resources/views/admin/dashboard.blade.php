<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Smart Water Filtration System - Admin Dashboard</title>
    <link rel="icon" type="image/png" href="/logo.png">
    
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

        <!-- Main Body -->
        <div class="flex-1 overflow-y-auto p-6 md:p-10 pb-24">
            <div class="mx-auto max-w-7xl">
                
                <!-- Title & Selector -->
                <div class="mb-8 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="font-serif text-3xl font-bold text-primary-dark md:text-4xl">Dashboard</h2>
                    </div>
                    <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-xl border border-primary/10 shadow-soft">
                        <span class="material-symbols-outlined text-primary text-xl">home_pin</span>
                        <label for="resident-select" class="text-sm font-bold text-primary-dark">Pilih Rumah:</label>
                        <select id="resident-select" class="rounded-lg border-0 bg-transparent py-1 pl-1 pr-8 text-sm font-bold text-primary focus:ring-0 cursor-pointer">
                            @foreach($residents as $res)
                                <option value="{{ $res->username }}" {{ $loop->first ? 'selected' : '' }}>
                                    {{ $res->name }} (Blok {{ match($res->username) { 'krisna' => 'K-01', 'siti' => 'A-05', 'rahman' => 'B-02', default => strtoupper($res->username) } }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 1: Metrics (pH, TDS, TURBIDITY) -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mb-6">
                    <!-- Card 1: pH -->
                    <div class="bg-white p-6 rounded-xl shadow-soft border-l-4 border-blue-500 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">PH</span>
                            <span id="ph-val" class="text-4xl font-extrabold text-primary-dark mt-2">-</span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-500 shadow-sm">
                            <span class="material-symbols-outlined text-2xl">water_drop</span>
                        </div>
                    </div>

                    <!-- Card 2: TDS -->
                    <div class="bg-white p-6 rounded-xl shadow-soft border-l-4 border-green-500 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">TDS</span>
                            <span id="tds-val" class="text-4xl font-extrabold text-primary-dark mt-2">-</span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-500 shadow-sm">
                            <span class="material-symbols-outlined text-2xl">waves</span>
                        </div>
                    </div>

                    <!-- Card 3: TURBIDITY -->
                    <div class="bg-white p-6 rounded-xl shadow-soft border-l-4 border-cyan-500 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">TURBIDITY</span>
                            <span id="turbidity-val" class="text-4xl font-extrabold text-primary-dark mt-2">-</span>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-500 shadow-sm">
                            <span class="material-symbols-outlined text-2xl">science</span>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Chart & Quality -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-4 mb-6">
                    <!-- Chart -->
                    <div class="md:col-span-3 bg-white p-6 rounded-xl shadow-soft border border-primary/10 flex flex-col justify-between font-bold">
                        <div class="flex items-center justify-between mb-4 border-b border-primary/5 pb-3">
                            <div>
                                <h3 class="font-serif text-lg font-bold text-primary-dark">Water Quality Monitoring</h3>
                                <p class="text-xs text-primary/60">Grafik historis parameter kualitas air</p>
                            </div>
                            <div class="flex items-center gap-1 bg-amber-50 p-1 rounded-lg border border-primary/10" id="chart-filters">
                                <button onclick="setChartRange('24h')" id="btn-24h" class="px-3 py-1.5 rounded-md text-xs font-bold bg-white text-primary shadow-sm transition-all">24 Jam</button>
                                <button onclick="setChartRange('7d')" id="btn-7d" class="px-3 py-1.5 rounded-md text-xs font-medium text-primary/70 hover:text-primary transition-all">7 Hari</button>
                                <button onclick="setChartRange('30d')" id="btn-30d" class="px-3 py-1.5 rounded-md text-xs font-medium text-primary/70 hover:text-primary transition-all">30 Hari</button>
                            </div>
                        </div>
                        <div class="relative w-full h-[260px]">
                            <canvas id="waterQualityChart"></canvas>
                        </div>
                    </div>

                    <!-- Quality Card -->
                    <div id="quality-card" class="md:col-span-1 bg-white p-6 rounded-xl shadow-soft border-l-4 border-yellow-500 border border-primary/10 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-400">QUALITY</span>
                            <div id="quality-val" class="text-3xl font-extrabold text-primary-dark mt-4">-</div>
                        </div>
                        <div class="flex items-end justify-between mt-8">
                            <span id="quality-desc" class="text-xs text-primary/60 font-medium">Memuat...</span>
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
                            <h3 class="font-serif text-xl font-bold text-primary-dark">Water Quality Monitoring</h3>
                            <p class="text-primary/60 text-sm mt-1">Realtime Database</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2 px-3 py-1.5 bg-primary/5 rounded-lg border border-primary/10">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                <span class="text-xs font-bold text-primary-dark" id="countdown-text">Update dalam 60s</span>
                            </div>
                            <button onclick="loadSensorHistory()" class="flex items-center gap-2 px-3.5 py-1.5 bg-primary/10 hover:bg-primary/20 text-primary-dark rounded-lg text-xs font-bold transition-colors">
                                <span class="material-symbols-outlined text-sm">refresh</span>Refresh
                            </button>
                            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold shadow-md transition-all shadow-blue-500/20 hover:shadow-blue-500/40">
                                <span class="material-symbols-outlined text-sm">download</span>Cetak Report
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto rounded-xl border border-primary/5">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-amber-50/50 border-b border-primary/10">
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">No</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">Waktu</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">PH</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">TDS</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">TURBIDITY</th>
                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-primary/60">Kualitas</th>
                                </tr>
                            </thead>
                            <tbody id="sensor-history-body">
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center text-primary/40">
                                        <div class="flex flex-col items-center gap-3">
                                            <span class="material-symbols-outlined text-[40px] text-primary animate-pulse">sensors</span>
                                            <span class="text-sm font-medium">Memuat data sensor...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between mt-4 text-primary/50 text-xs">
                        <span id="total-records">Menampilkan 0 data</span>
                        <span id="last-updated">Terakhir diperbarui: -</span>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    const apiBase = "{{ url('/api') }}";
    let currentUsername = '{{ $residents->first()->username ?? "krisna" }}';
    let countdownValue = 60;
    let previousDataIds = [];
    let waterQualityChart = null;
    let currentRange = '24h';

    function getWaterQuality(ph, ntu, tds) {
        if (ph === null || ntu === null) return { status: 'N/A', class: 'text-gray-500 bg-gray-50 border-gray-100', desc: 'No data' };
        
        const phVal = parseFloat(ph);
        const ntuVal = parseFloat(ntu);
        
        const isPhNormal = phVal >= 6.5 && phVal <= 8.5;
        const isNtuNormal = ntuVal <= 5;
        
        if (isPhNormal && isNtuNormal) {
            return { 
                status: 'GOOD', 
                class: 'text-green-600 bg-green-50 border-green-200',
                desc: 'Kualitas air optimal untuk kebutuhan sehari-hari.' 
            };
        } else if (phVal >= 5.0 && phVal <= 9.0 && ntuVal <= 25) {
            return { 
                status: 'Moderate', 
                class: 'text-yellow-600 bg-yellow-50 border-yellow-200', 
                desc: 'Kualitas air sedang. Disarankan untuk memantau filtrasi.' 
            };
        } else {
            return { 
                status: 'Unhealthy', 
                class: 'text-red-600 bg-red-50 border-red-200', 
                desc: 'Air kotor atau tidak layak pakai. Filtrasi aktif.' 
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
                if (data) {
                    const ph = data.ph !== null ? parseFloat(data.ph).toFixed(1) : '-';
                    const ntu = data.ntu !== null ? parseFloat(data.ntu).toFixed(0) : '-';
                    // TDS is temperature * 7
                    const tds = data.temperature !== null ? Math.round(parseFloat(data.temperature) * 7) : '-';
                    
                    document.getElementById('ph-val').innerText = ph;
                    document.getElementById('tds-val').innerText = tds;
                    document.getElementById('turbidity-val').innerText = ntu;
                    
                    const q = getWaterQuality(data.ph, data.ntu, tds);
                    const qualityValEl = document.getElementById('quality-val');
                    qualityValEl.innerText = q.status;
                    
                    // Style Quality card border-l
                    const qualityCard = document.getElementById('quality-card');
                    if (qualityCard) {
                        qualityCard.className = `md:col-span-1 bg-white p-6 rounded-xl shadow-soft border-l-4 ${
                            q.status === 'GOOD' ? 'border-green-500' : (q.status === 'Moderate' ? 'border-yellow-500' : 'border-red-500')
                        } border border-primary/10 flex flex-col justify-between`;
                    }
                    
                    document.getElementById('quality-desc').innerText = q.desc;
                }
            })
            .catch(e => console.error('Error fetching latest sensor data:', e));
    }

    function loadSensorHistory() {
        fetch(`${apiBase}/sensor-history?username=${encodeURIComponent(currentUsername)}&limit=20`)
            .then(r => r.json())
            .then(records => {
                const tbody = document.getElementById('sensor-history-body');
                if (!records || records.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="px-5 py-12 text-center text-primary/40"><div class="flex flex-col items-center gap-3"><span class="material-symbols-outlined text-[40px] text-primary/50">sensors_off</span><span class="text-sm font-medium">Belum ada data sensor</span></div></td></tr>';
                    document.getElementById('total-records').innerText = 'Menampilkan 0 data';
                    return;
                }
                
                const newIds = records.map(r => r.id);
                let html = '';
                records.forEach((rec, i) => {
                    const isNew = previousDataIds.length > 0 && !previousDataIds.includes(rec.id);
                    const phVal = rec.ph !== null ? parseFloat(rec.ph).toFixed(1) : '-';
                    const ntuVal = rec.ntu !== null ? parseFloat(rec.ntu).toFixed(0) : '-';
                    const tdsVal = rec.temperature !== null ? Math.round(parseFloat(rec.temperature) * 7) : '-';
                    
                    const q = getWaterQuality(rec.ph, rec.ntu, tdsVal);
                    
                    html += `<tr class="${isNew ? 'animate-[fadeHighlight_0.8s_ease-out]' : ''} border-b border-primary/10 hover:bg-amber-50/20 transition-colors">`;
                    html += `<td class="px-5 py-3.5"><span class="text-xs font-mono text-primary/40">${i + 1}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono text-xs text-primary-dark/85">${formatTime(rec.created_at)}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono font-bold text-primary-dark">${phVal}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono font-bold text-primary-dark">${tdsVal}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="font-mono font-bold text-primary-dark">${ntuVal}</span></td>`;
                    html += `<td class="px-5 py-3.5"><span class="px-2.5 py-1 rounded-md text-xs font-bold ${q.class} border">${q.status}</span></td>`;
                    html += '</tr>';
                });
                
                tbody.innerHTML = html;
                previousDataIds = newIds;
                document.getElementById('total-records').innerText = `Menampilkan ${records.length} data terbaru`;
                
                const now = new Date();
                document.getElementById('last-updated').innerText = `Terakhir diperbarui: ${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}:${String(now.getSeconds()).padStart(2, '0')}`;
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
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2,
                        pointRadius: 2,
                        fill: false,
                        tension: 0.3,
                        yAxisID: 'y1'
                    },
                    {
                        label: 'TDS',
                        data: [],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.05)',
                        borderWidth: 2.5,
                        pointRadius: 2,
                        fill: true,
                        tension: 0.3,
                        yAxisID: 'y'
                    },
                    {
                        label: 'TURBIDITY',
                        data: [],
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.05)',
                        borderWidth: 2,
                        pointRadius: 2,
                        fill: false,
                        tension: 0.3,
                        yAxisID: 'y1'
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
                            text: 'TDS (ppm)',
                            font: { weight: 'bold' }
                        },
                        min: 0,
                        max: 300,
                        grid: {
                            color: 'rgba(146, 64, 14, 0.05)'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'pH / Turbidity (NTU)',
                            font: { weight: 'bold' }
                        },
                        min: 0,
                        max: 20,
                        grid: {
                            drawOnChartArea: false,
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
                            boxWidth: 12,
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
                    const tdsData = data.temp_data.map(temp => Math.round(parseFloat(temp) * 7));
                    
                    waterQualityChart.data.labels = data.labels;
                    waterQualityChart.data.datasets[0].data = data.ph_data;
                    waterQualityChart.data.datasets[1].data = tdsData;
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
                    el.innerText = 'Memperbarui...';
                    loadSensorHistory();
                    countdownValue = 60;
                } else {
                    el.innerText = `Update dalam ${countdownValue}s`;
                }
            }
        }, 1000);
    });
</script>
</body>
</html>
