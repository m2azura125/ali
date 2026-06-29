<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Smart Water Filtration System - Detail</title>
<link rel="icon" type="image/svg+xml" href="https://upload.wikimedia.org/wikipedia/commons/1/1f/Logo_Politeknik_Negeri_Balikpapan.svg">
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
                        "forest": "#92400e",
                        "forest-dark": "#78350f",
                        "forest-light": "#b45309",
                        "mint": "#d97706",
                        "mint-light": "#fef3c7",
                        "sand": "#E9C46A",
                        "terra": "#E76F51",
                        "mist": "#fffbeb",
                        "surface": "#FFFFFF",
                    },
                    fontFamily: {
                        "serif": ["Fraunces", "serif"],
                        "sans": ["Manrope", "sans-serif"],
                        "mono": ["Space Mono", "monospace"],
                    },
                    borderRadius: {
                        "lg": "0.5rem", 
                        "xl": "0.75rem", 
                        "2xl": "1rem",
                    },
                    boxShadow: {
                        "soft": "0 20px 25px -5px rgb(146 64 14 / 0.05), 0 8px 10px -6px rgb(146 64 14 / 0.05)",
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
            background: #fcd34d; 
        }

        /* Toggle Switch Animation */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #92400e;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #92400e;
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
<a href="/admin" aria-label="Go back" class="flex items-center justify-center w-12 h-12 rounded-lg bg-white hover:bg-mint-light text-forest transition-colors shadow-soft group">
<span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
</a>
<div>
<div class="flex items-center gap-3">
<span class="px-3 py-1 rounded-lg bg-forest text-white text-xs font-bold tracking-wider uppercase">Admin View</span>
<span class="flex h-2 w-2 rounded-full bg-mint animate-pulse"></span>
</div>
<h1 class="font-serif text-3xl md:text-4xl font-bold text-forest-dark mt-1">Detail Warga: {{ $selectedResident->name ?? $id }}</h1>
</div>
</div>
<div class="flex items-center gap-3">
<button class="flex items-center gap-2 px-6 py-3 rounded-lg bg-mint-light hover:bg-mint/30 text-forest-dark font-semibold transition-colors">
<span class="material-symbols-outlined text-[20px]">history</span>
<span>Logs</span>
</button>
<button class="flex items-center gap-2 px-6 py-3 rounded-lg bg-forest hover:bg-forest-light text-white font-bold shadow-lg shadow-forest/20 transition-all hover:scale-105">
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
<div class="bg-mist p-1 rounded-lg flex items-center" id="chart-filters">
<button onclick="setChartRange('24h')" id="btn-filter-24h" class="px-4 py-2 rounded-lg text-sm transition-all bg-white text-forest-dark shadow-sm font-semibold">24 Jam</button>
<button onclick="setChartRange('7d')" id="btn-filter-7d" class="px-4 py-2 rounded-lg text-sm transition-all hover:bg-white/50 text-forest/70 font-medium">7 Hari</button>
<button onclick="setChartRange('30d')" id="btn-filter-30d" class="px-4 py-2 rounded-lg text-sm transition-all hover:bg-white/50 text-forest/70 font-medium">30 Hari</button>
</div>
</div>
<div class="w-full flex-grow flex flex-col gap-6 pt-4 pb-2 px-2">
<div class="w-full h-48 relative"><canvas id="phChart"></canvas></div>
<div class="w-full h-48 relative"><canvas id="ntuChart"></canvas></div>
<div class="w-full h-48 relative"><canvas id="tempChart"></canvas></div>
<div class="w-full h-48 relative">
<div class="flex items-center gap-2 mb-2">
<span class="material-symbols-outlined text-forest text-[20px]">electric_bolt</span>
<span class="text-sm font-semibold text-forest-dark">Siklus Relay (ON/OFF)</span>
<span id="relay-status-badge" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-bold">-</span>
</div>
<canvas id="relayChart"></canvas>
</div>
</div>
</div>
</div>
<div class="flex flex-col gap-6">
<div class="bg-surface rounded-xl p-6 shadow-soft border border-mint/20">
<h3 class="font-serif text-lg font-semibold text-forest-dark mb-4">Sensor Terkini</h3>
<div class="flex flex-col gap-4">
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-mint text-2xl">emoji_events</span>
<span id="card-ph-status" class="text-xs font-bold {{ isset($latestData) && $latestData->ph !== null && $latestData->ph >= 6.5 && $latestData->ph <= 8.5 ? 'text-mint bg-mint/10' : (isset($latestData) && $latestData->ph !== null ? 'text-terra bg-terra/10' : 'text-forest/60 bg-white') }} px-2 py-0.5 rounded-lg">
{{ isset($latestData) && $latestData->ph !== null ? ($latestData->ph >= 6.5 && $latestData->ph <= 8.5 ? 'Normal' : 'Periksa') : 'Belum Ada' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Current pH</span>
<div id="card-ph-val" class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->ph !== null ? number_format($latestData->ph, 1) : '-' }}</div>
</div>
</div>
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-sand text-2xl">grain</span>
<span id="card-ntu-status" class="text-xs font-bold {{ isset($latestData) && $latestData->ntu !== null && $latestData->ntu <= 25 ? 'text-mint bg-mint/10' : (isset($latestData) && $latestData->ntu !== null ? 'text-sand bg-sand/10' : 'text-forest/60 bg-white') }} px-2 py-0.5 rounded-lg">
{{ isset($latestData) && $latestData->ntu !== null ? ($latestData->ntu <= 25 ? 'Jernih' : 'Alert') : 'Belum Ada' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Turbidity</span>
<div id="card-ntu-val" class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->ntu !== null ? number_format($latestData->ntu, 0) : '-' }}<span class="text-sm ml-1">NTU</span></div>
</div>
</div>
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-terra text-2xl">thermostat</span>
<span id="card-temp-status" class="text-xs font-bold {{ isset($latestData) && $latestData->temperature !== null ? 'text-mint bg-mint/10' : 'text-forest/60 bg-white' }} px-2 py-0.5 rounded-lg">
{{ isset($latestData) && $latestData->temperature !== null ? 'Normal' : 'Belum Ada' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Suhu Air</span>
<div id="card-temp-val" class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->temperature !== null ? number_format($latestData->temperature, 1) : '-' }}<span class="text-sm ml-1">&deg;C</span></div>
</div>
</div>
<div class="bg-mist rounded-2xl p-4 flex flex-col justify-between">
<div class="flex items-start justify-between mb-2">
<span class="material-symbols-outlined text-forest text-2xl">electric_bolt</span>
<span id="card-relay-status" class="text-xs font-bold {{ isset($latestData) && $latestData->relay_status ? 'text-mint bg-mint/10' : 'text-terra bg-terra/10' }} px-2 py-0.5 rounded-lg">
{{ isset($latestData) && $latestData->relay_status ? 'Aktif' : 'Mati' }}
</span>
</div>
<div>
<span class="text-sm text-forest/60 font-medium">Keadaan Relay</span>
<div id="card-relay-val" class="text-3xl font-mono font-bold text-forest-dark mt-1">{{ isset($latestData) && $latestData->relay_status ? 'ON' : 'OFF' }}</div>
<div class="text-[11px] font-semibold text-forest/50 uppercase mt-1">Aktivasi: <span id="card-relay-count" class="font-mono font-bold text-forest-dark">{{ $relayCount ?? 0 }}</span> Kali</div>
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
<div class="flex items-center gap-2 px-4 py-2 bg-mint/10 rounded-lg border border-mint/20"><span class="w-2 h-2 rounded-full bg-mint animate-pulse"></span><span class="text-xs font-bold text-forest-dark" id="countdown-text">Update dalam 60s</span></div>
<button onclick="loadSensorHistory()" class="flex items-center gap-2 px-4 py-2 bg-forest/10 hover:bg-forest/20 text-forest-dark rounded-lg text-sm font-bold transition-colors"><span class="material-symbols-outlined text-[16px]">refresh</span>Refresh</button>
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
        if (status) return '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-mint-light text-forest-dark text-xs font-bold border border-mint">ON</span>';
        return '<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-terra/10 text-terra text-xs font-bold border border-terra/20">OFF</span>';
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
                    
                    const parsedPh = parseFloat(rec.ph);
                    const phVal = !isNaN(parsedPh) ? parsedPh.toFixed(1) : '0.0';
                    
                    const parsedNtu = parseFloat(rec.ntu);
                    const ntuVal = !isNaN(parsedNtu) ? parsedNtu.toFixed(0) : '0';
                    
                    const parsedTemp = parseFloat(rec.temperature);
                    const tempVal = !isNaN(parsedTemp) ? parsedTemp.toFixed(1) + '\u00b0C' : '0.0\u00b0C';
                    
                    const parsedFuzzy = parseFloat(rec.fuzzy);
                    const fuzzyVal = !isNaN(parsedFuzzy) ? parsedFuzzy.toFixed(2) : '0.00';
                    
                    const phColor = !isNaN(parsedPh) && (parsedPh < 6.5 || parsedPh > 8.5) ? 'text-terra font-bold' : 'text-forest-dark';
                    const ntuColor = !isNaN(parsedNtu) && parsedNtu > 25 ? 'text-sand font-bold' : 'text-forest-dark';
                    
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

                // Update "Sensor Terkini" cards dynamically from the latest record
                const latest = records[0];
                if (latest) {
                    // pH Card
                    const cardPhVal = document.getElementById('card-ph-val');
                    const cardPhStatus = document.getElementById('card-ph-status');
                    if (cardPhVal && cardPhStatus) {
                        const ph = parseFloat(latest.ph);
                        if (!isNaN(ph)) {
                            cardPhVal.innerHTML = ph.toFixed(1);
                            if (ph >= 6.5 && ph <= 8.5) {
                                cardPhStatus.className = 'text-xs font-bold text-mint bg-mint/10 px-2 py-0.5 rounded-lg';
                                cardPhStatus.innerText = 'Normal';
                            } else {
                                cardPhStatus.className = 'text-xs font-bold text-terra bg-terra/10 px-2 py-0.5 rounded-lg';
                                cardPhStatus.innerText = 'Periksa';
                            }
                        } else {
                            cardPhVal.innerHTML = '0.0';
                            cardPhStatus.className = 'text-xs font-bold text-forest/60 bg-white px-2 py-0.5 rounded-lg';
                            cardPhStatus.innerText = 'Belum Ada';
                        }
                    }

                    // Turbidity Card
                    const cardNtuVal = document.getElementById('card-ntu-val');
                    const cardNtuStatus = document.getElementById('card-ntu-status');
                    if (cardNtuVal && cardNtuStatus) {
                        const ntu = parseFloat(latest.ntu);
                        if (!isNaN(ntu)) {
                            cardNtuVal.innerHTML = ntu.toFixed(0) + '<span class="text-sm ml-1">NTU</span>';
                            if (ntu <= 25) {
                                cardNtuStatus.className = 'text-xs font-bold text-mint bg-mint/10 px-2 py-0.5 rounded-lg';
                                cardNtuStatus.innerText = 'Jernih';
                            } else {
                                cardNtuStatus.className = 'text-xs font-bold text-sand bg-sand/10 px-2 py-0.5 rounded-lg';
                                cardNtuStatus.innerText = 'Alert';
                            }
                        } else {
                            cardNtuVal.innerHTML = '0 <span class="text-sm ml-1">NTU</span>';
                            cardNtuStatus.className = 'text-xs font-bold text-forest/60 bg-white px-2 py-0.5 rounded-lg';
                            cardNtuStatus.innerText = 'Belum Ada';
                        }
                    }

                    // Temperature Card
                    const cardTempVal = document.getElementById('card-temp-val');
                    const cardTempStatus = document.getElementById('card-temp-status');
                    if (cardTempVal && cardTempStatus) {
                        const temp = parseFloat(latest.temperature);
                        if (!isNaN(temp)) {
                            cardTempVal.innerHTML = temp.toFixed(1) + '<span class="text-sm ml-1">&deg;C</span>';
                            cardTempStatus.className = 'text-xs font-bold text-mint bg-mint/10 px-2 py-0.5 rounded-lg';
                            cardTempStatus.innerText = 'Normal';
                        } else {
                            cardTempVal.innerHTML = '0.0<span class="text-sm ml-1">&deg;C</span>';
                            cardTempStatus.className = 'text-xs font-bold text-forest/60 bg-white px-2 py-0.5 rounded-lg';
                            cardTempStatus.innerText = 'Belum Ada';
                        }
                    }

                    // Relay Card
                    const cardRelayVal = document.getElementById('card-relay-val');
                    const cardRelayStatus = document.getElementById('card-relay-status');
                    if (cardRelayVal && cardRelayStatus) {
                        const status = latest.relay_status;
                        if (status) {
                            cardRelayVal.innerText = 'ON';
                            cardRelayStatus.className = 'text-xs font-bold text-mint bg-mint/10 px-2 py-0.5 rounded-lg';
                            cardRelayStatus.innerText = 'Aktif';
                        } else {
                            cardRelayVal.innerText = 'OFF';
                            cardRelayStatus.className = 'text-xs font-bold text-terra bg-terra/10 px-2 py-0.5 rounded-lg';
                            cardRelayStatus.innerText = 'Mati';
                        }
                    }

                    const cardRelayCount = document.getElementById('card-relay-count');
                    if (cardRelayCount && latest.relay_count !== undefined) {
                        cardRelayCount.innerText = latest.relay_count;
                    }
                }

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
    let relayChart = null;
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
                        backgroundColor: '#78350f',
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
        phChart = new Chart(document.getElementById('phChart').getContext('2d'), createChartConfig('pH Level', '#92400e', 'rgba(146, 64, 14, 0.1)', 'pH', 14));
        ntuChart = new Chart(document.getElementById('ntuChart').getContext('2d'), createChartConfig('Turbidity', '#E9C46A', 'rgba(233, 196, 106, 0.1)', 'NTU'));
        tempChart = new Chart(document.getElementById('tempChart').getContext('2d'), createChartConfig('Temperature', '#E76F51', 'rgba(231, 111, 81, 0.1)', '°C'));

        // Relay Cycle Chart (Step Chart ON/OFF)
        relayChart = new Chart(document.getElementById('relayChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Relay Status',
                    data: [],
                    borderColor: '#92400e',
                    backgroundColor: 'rgba(146, 64, 14, 0.08)',
                    borderWidth: 2.5,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#FFFFFF',
                    pointHoverBorderColor: '#92400e',
                    pointHoverBorderWidth: 3,
                    fill: true,
                    stepped: 'before',
                    segment: {
                        borderColor: function(ctx) {
                            return ctx.p1.parsed.y === 1 ? '#16a34a' : '#dc2626';
                        },
                        backgroundColor: function(ctx) {
                            return ctx.p1.parsed.y === 1 ? 'rgba(22, 163, 74, 0.08)' : 'rgba(220, 38, 38, 0.04)';
                        }
                    }
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: -0.1,
                        max: 1.1,
                        grid: { color: 'rgba(146, 64, 14, 0.06)', drawBorder: false },
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (value === 0) return 'OFF';
                                if (value === 1) return 'ON';
                                return '';
                            },
                            font: { family: 'Space Mono', size: 11, weight: 'bold' },
                            color: function(context) {
                                if (context.tick.value === 1) return '#16a34a';
                                if (context.tick.value === 0) return '#dc2626';
                                return 'transparent';
                            }
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { maxTicksLimit: 8 }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#78350f',
                        titleFont: { family: 'Space Mono', size: 11 },
                        bodyFont: { family: 'Space Mono', size: 13, weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y === 1 ? '🟢 ON (Aktif)' : '🔴 OFF (Mati)';
                            }
                        }
                    }
                }
            }
        });
    }

    function loadChartData(range = currentRange) {
        currentRange = range;
        
        // Update filter buttons styling
        const ranges = ['24h', '7d', '30d'];
        ranges.forEach(r => {
            const btn = document.getElementById('btn-filter-' + r);
            if (r === range) {
                btn.className = 'px-4 py-2 rounded-lg text-sm transition-all bg-white text-forest-dark shadow-sm font-semibold';
            } else {
                btn.className = 'px-4 py-2 rounded-lg text-sm transition-all hover:bg-white/50 text-forest/70 font-medium';
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

                // Update Relay Cycle Chart
                if (data.relay_data) {
                    relayChart.data.labels = data.labels;
                    relayChart.data.datasets[0].data = data.relay_data;
                    relayChart.update();

                    // Update relay status badge
                    const badge = document.getElementById('relay-status-badge');
                    if (data.relay_data.length > 0) {
                        const lastStatus = data.relay_data[data.relay_data.length - 1];
                        const onCount = data.relay_data.filter(v => v === 1).length;
                        const totalCount = data.relay_data.length;
                        const onPercent = Math.round((onCount / totalCount) * 100);
                        if (lastStatus === 1) {
                            badge.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-bold text-green-700 bg-green-100 border border-green-200';
                            badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> ON — Aktif ' + onPercent + '% waktu';
                        } else {
                            badge.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-bold text-red-600 bg-red-50 border border-red-200';
                            badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> OFF — Aktif ' + onPercent + '% waktu';
                        }
                    }
                }
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


