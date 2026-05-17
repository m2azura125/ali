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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<h2 class="font-serif text-2xl font-semibold text-forest-dark">Grafik Sensor</h2>
<p class="text-forest/60 text-sm mt-1">Grafik pH, Kekeruhan, dan Suhu berdasarkan data tersimpan</p>
</div>
<div class="bg-mist p-1 rounded-full flex items-center" id="chart-filters">
<button onclick="setChartRange('24h')" id="btn-filter-24h" class="px-4 py-2 rounded-full text-sm transition-all bg-white text-forest-dark shadow-sm font-semibold">24 Jam</button>
<button onclick="setChartRange('7d')" id="btn-filter-7d" class="px-4 py-2 rounded-full text-sm transition-all hover:bg-white/50 text-forest/70 font-medium">7 Hari</button>
<button onclick="setChartRange('30d')" id="btn-filter-30d" class="px-4 py-2 rounded-full text-sm transition-all hover:bg-white/50 text-forest/70 font-medium">30 Hari</button>
</div>
</div>
<div class="w-full flex-grow flex flex-col gap-6 pt-4 pb-2 px-2">
<div class="w-full h-48 relative"><canvas id="phChart"></canvas></div>
<div class="w-full h-48 relative"><canvas id="ntuChart"></canvas></div>
<div class="w-full h-48 relative"><canvas id="tempChart"></canvas></div>
</div>
</div>
</div>
<div class="flex flex-col gap-6">
<div class="bg-surface rounded-xl p-6 shadow-soft border border-mint/20">
<h3 class="font-serif text-lg font-semibold text-forest-dark mb-4">Sensor Terkini</h3>
<div class="flex flex-col gap-4">
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
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-terra text-2xl">thermostat</span>
<span class="text-xs font-bold {{ isset($latestData) && $latestData->temperature !== null ? 'text-mint bg-mint/10' : 'text-forest/60 bg-white' }} px-2 py-0.5 rounded-full">
{{ isset($latestData) && $latestData->temperature !== null ? 'Normal' : 'Belum Ada' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Suhu Air</span>
<div class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->temperature !== null ? number_format($latestData->temperature, 1) : '-' }}<span class="text-sm ml-1">&deg;C</span></div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Data Sensor History Table -->
<section class="bg-surface rounded-xl p-6 shadow-soft border border-mint/20 relative overflow-hidden mb-8">
<div class="absolute top-0 right-0 w-64 h-64 bg-forest/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
<div class="relative z-10">
<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
<div>
<h3 class="font-serif text-xl font-bold text-forest-dark flex items-center gap-2"><span class="material-symbols-outlined text-forest text-[24px]">table_chart</span> Riwayat Data Sensor</h3>
<p class="text-forest/60 text-sm mt-1">Data sensor terbaru, auto-refresh setiap 1 menit</p>
</div>
<div class="flex items-center gap-3">
<div class="flex items-center gap-2 px-4 py-2 bg-mint/10 rounded-full border border-mint/20"><span class="w-2 h-2 rounded-full bg-mint animate-pulse"></span><span class="text-xs font-bold text-forest-dark" id="countdown-text">Update dalam 60s</span></div>
<button onclick="loadSensorHistory()" class="flex items-center gap-2 px-4 py-2 bg-forest/10 hover:bg-forest/20 text-forest-dark rounded-full text-sm font-bold transition-colors"><span class="material-symbols-outlined text-[16px]">refresh</span>Refresh</button>
</div>
</div>
<div class="overflow-x-auto rounded-xl border border-mint/20">
<table class="w-full text-left">
<thead><tr class="bg-mist border-b border-mint/20">
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">#</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">pH</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">NTU</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">Suhu</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">Fuzzy</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">Relay</th>
<th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-forest/60">Waktu</th>
</tr></thead>
<tbody id="sensor-history-body">
<tr><td colspan="7" class="px-5 py-12 text-center text-forest/40"><div class="flex flex-col items-center gap-3"><span class="material-symbols-outlined text-[40px] text-mint animate-pulse">sensors</span><span class="text-sm font-medium">Memuat data sensor...</span></div></td></tr>
</tbody>
</table>
</div>
<div class="flex items-center justify-between mt-4 text-forest/50 text-xs"><span id="total-records">Menampilkan 0 data</span><span id="last-updated">Terakhir diperbarui: -</span></div>
</div>
</section>

</div>

<script>
    let previousDataIds = [];
    let countdownValue = 60;

    function formatRelayStatus(status) {
        if (status) return '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-mint-light text-forest-dark text-xs font-bold border border-mint">ON</span>';
        return '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-terra/10 text-terra text-xs font-bold border border-terra/20">OFF</span>';
    }

    function formatTime(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        return String(d.getDate()).padStart(2,'0') + ' ' + months[d.getMonth()] + ' ' + String(d.getHours()).padStart(2,'0') + ':' + String(d.getMinutes()).padStart(2,'0') + ':' + String(d.getSeconds()).padStart(2,'0');
    }

    function loadSensorHistory() {
        fetch('/api/sensor-history?username={{ urlencode($id) }}&limit=20')
            .then(r => r.json())
            .then(records => {
                const tbody = document.getElementById('sensor-history-body');
                if (!records || records.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="7" class="px-5 py-12 text-center text-forest/40"><div class="flex flex-col items-center gap-3"><span class="material-symbols-outlined text-[40px] text-mint/50">sensors_off</span><span class="text-sm font-medium">Belum ada data sensor</span></div></td></tr>';
                    document.getElementById('total-records').innerText = 'Menampilkan 0 data';
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
                    const phColor = rec.ph !== null && (rec.ph < 6.5 || rec.ph > 8.5) ? 'text-terra font-bold' : 'text-forest-dark';
                    const ntuColor = rec.ntu !== null && rec.ntu > 25 ? 'text-sand font-bold' : 'text-forest-dark';
                    html += '<tr class="' + (isNew ? 'animate-[fadeHighlight_0.8s_ease-out]' : '') + ' border-b border-mint/10 hover:bg-mist/80 transition-colors">';
                    html += '<td class="px-5 py-3.5"><span class="text-xs font-mono text-forest/40">' + (i+1) + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono font-bold ' + phColor + '">' + phVal + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono font-bold ' + ntuColor + '">' + ntuVal + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono font-bold text-forest-dark">' + tempVal + '</span></td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono text-sm text-forest/70">' + fuzzyVal + '</span></td>';
                    html += '<td class="px-5 py-3.5">' + formatRelayStatus(rec.relay_status) + '</td>';
                    html += '<td class="px-5 py-3.5"><span class="font-mono text-xs text-forest/50">' + formatTime(rec.created_at) + '</span></td>';
                    html += '</tr>';
                });
                tbody.innerHTML = html;
                previousDataIds = newIds;
                document.getElementById('total-records').innerText = 'Menampilkan ' + records.length + ' data terbaru';
                const now = new Date();
                document.getElementById('last-updated').innerText = 'Terakhir diperbarui: ' + String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0') + ':' + String(now.getSeconds()).padStart(2,'0');
            })
            .catch(e => console.error('Error:', e));
    }

    // Initial load
    loadSensorHistory();

    // Refresh table every 10 seconds with countdown
    setInterval(() => {
        countdownValue--;
        const el = document.getElementById('countdown-text');
        if (countdownValue <= 0) {
            el.innerText = 'Memperbarui...';
            loadSensorHistory();
            countdownValue = 60;
        } else {
            el.innerText = 'Update dalam ' + countdownValue + 's';
        }
    }, 1000);

    // Chart.js Logic
    let phChart = null;
    let ntuChart = null;
    let tempChart = null;
    let currentRange = '24h';

    function createChartConfig(label, color, bgColor, tooltipSuffix, yMax = null) {
        return {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: label,
                    data: [],
                    borderColor: color,
                    backgroundColor: bgColor,
                    borderWidth: 2,
                    pointRadius: 2,
                    pointBackgroundColor: '#FFFFFF',
                    pointBorderColor: color,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: yMax,
                        grid: { color: bgColor, drawBorder: false }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { maxTicksLimit: 8 }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1B4332',
                        titleFont: { family: 'Space Mono', size: 11 },
                        bodyFont: { family: 'Space Mono', size: 13, weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(context) { return context.parsed.y + ' ' + tooltipSuffix; }
                        }
                    }
                }
            }
        };
    }

    function initChart() {
        phChart = new Chart(document.getElementById('phChart').getContext('2d'), createChartConfig('pH Level', '#2D6A4F', 'rgba(45, 106, 79, 0.1)', 'pH', 14));
        ntuChart = new Chart(document.getElementById('ntuChart').getContext('2d'), createChartConfig('Turbidity', '#E9C46A', 'rgba(233, 196, 106, 0.1)', 'NTU'));
        tempChart = new Chart(document.getElementById('tempChart').getContext('2d'), createChartConfig('Temperature', '#E76F51', 'rgba(231, 111, 81, 0.1)', '°C'));
    }

    function loadChartData(range = currentRange) {
        currentRange = range;
        
        // Update filter buttons styling
        const ranges = ['24h', '7d', '30d'];
        ranges.forEach(r => {
            const btn = document.getElementById('btn-filter-' + r);
            if (r === range) {
                btn.className = 'px-4 py-2 rounded-full text-sm transition-all bg-white text-forest-dark shadow-sm font-semibold';
            } else {
                btn.className = 'px-4 py-2 rounded-full text-sm transition-all hover:bg-white/50 text-forest/70 font-medium';
            }
        });

        fetch(`/api/chart-data?username={{ urlencode($id) }}&range=${range}`)
            .then(res => res.json())
            .then(data => {
                phChart.data.labels = data.labels;
                phChart.data.datasets[0].data = data.ph_data;
                phChart.update();
                
                ntuChart.data.labels = data.labels;
                ntuChart.data.datasets[0].data = data.ntu_data;
                ntuChart.update();
                
                tempChart.data.labels = data.labels;
                tempChart.data.datasets[0].data = data.temp_data;
                tempChart.update();
            })
            .catch(err => console.error('Error fetching chart data:', err));
    }

    function setChartRange(range) {
        loadChartData(range);
    }

    initChart();
    loadChartData();
</script>
</body></html>
