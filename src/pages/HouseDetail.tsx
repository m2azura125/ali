import { useState } from 'react';
import { Link } from 'react-router-dom';
import { 
  ArrowLeft, 
  History, 
  Phone, 
  Droplet, 
  Waves, 
  AlertTriangle, 
  Power,
  ZapOff
} from 'lucide-react';
import { 
  AreaChart, 
  Area, 
  XAxis, 
  YAxis, 
  CartesianGrid, 
  Tooltip, 
  ResponsiveContainer 
} from 'recharts';
import clsx from 'clsx';

const data = [
  { time: '00:00', value: 7.2 },
  { time: '03:00', value: 7.1 },
  { time: '06:00', value: 7.3 },
  { time: '09:00', value: 7.4 },
  { time: '12:00', value: 7.2 },
  { time: '14:20', value: 7.4 },
  { time: '15:00', value: 7.3 },
  { time: '18:00', value: 7.2 },
  { time: '21:00', value: 7.3 },
  { time: '24:00', value: 7.4 },
];

export default function HouseDetail() {
  const [pumpActive, setPumpActive] = useState(true);
  const [timeRange, setTimeRange] = useState('24h');

  return (
    <div className="bg-background-light text-primary-dark font-sans min-h-screen relative overflow-x-hidden selection:bg-primary-light selection:text-primary-dark">
      {/* Background Texture */}
      <div className="fixed inset-0 bg-noise pointer-events-none z-0" />

      {/* Main Container */}
      <div className="relative z-10 flex flex-col min-h-screen max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {/* Header */}
        <header className="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
          <div className="flex items-center gap-4">
            <Link to="/admin" aria-label="Go back" className="flex items-center justify-center w-12 h-12 rounded-full bg-white hover:bg-primary-light/20 text-primary transition-colors shadow-soft group">
              <ArrowLeft className="h-6 w-6 group-hover:-translate-x-1 transition-transform" />
            </Link>
            <div>
              <div className="flex items-center gap-3">
                <span className="px-3 py-1 rounded-full bg-primary text-white text-xs font-bold tracking-wider uppercase">Admin View</span>
                <span className="flex h-2 w-2 rounded-full bg-primary-light animate-pulse" />
              </div>
              <h1 className="font-serif text-3xl md:text-4xl font-bold text-primary-dark mt-1">Rumah C-12: Keluarga Santoso</h1>
            </div>
          </div>
          <div className="flex items-center gap-3">
            <button className="flex items-center gap-2 px-6 py-3 rounded-full bg-primary-light/20 hover:bg-primary-light/30 text-primary-dark font-semibold transition-colors">
              <History className="h-5 w-5" />
              <span>Logs</span>
            </button>
            <button className="flex items-center gap-2 px-6 py-3 rounded-full bg-primary hover:bg-primary-light text-white font-bold shadow-lg shadow-primary/20 transition-all hover:scale-105">
              <Phone className="h-5 w-5" />
              <span>Call Resident</span>
            </button>
          </div>
        </header>

        {/* Dashboard Content Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
          {/* Main Chart Section (2/3 width) */}
          <div className="lg:col-span-2 flex flex-col gap-6">
            {/* Chart Card */}
            <div className="bg-surface rounded-xl p-6 md:p-8 shadow-soft border border-primary/10 h-full flex flex-col">
              <div className="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div>
                  <h2 className="font-serif text-2xl font-semibold text-primary-dark">Kualitas Air</h2>
                  <p className="text-primary/60 text-sm mt-1">Visualisasi data sensor pH dan kekeruhan</p>
                </div>
                {/* Time Range Toggles */}
                <div className="bg-background-light p-1 rounded-full flex items-center">
                  <button 
                    onClick={() => setTimeRange('24h')}
                    className={clsx("px-4 py-2 rounded-full text-sm font-semibold transition-all", timeRange === '24h' ? "bg-white text-primary-dark shadow-sm" : "text-primary/70 hover:bg-white/50")}
                  >
                    24 Jam
                  </button>
                  <button 
                    onClick={() => setTimeRange('7d')}
                    className={clsx("px-4 py-2 rounded-full text-sm font-semibold transition-all", timeRange === '7d' ? "bg-white text-primary-dark shadow-sm" : "text-primary/70 hover:bg-white/50")}
                  >
                    7 Hari
                  </button>
                  <button 
                    onClick={() => setTimeRange('30d')}
                    className={clsx("px-4 py-2 rounded-full text-sm font-semibold transition-all", timeRange === '30d' ? "bg-white text-primary-dark shadow-sm" : "text-primary/70 hover:bg-white/50")}
                  >
                    30 Hari
                  </button>
                </div>
              </div>
              
              {/* Chart Visualization Area */}
              <div className="relative w-full flex-grow min-h-[300px]">
                <ResponsiveContainer width="100%" height="100%">
                  <AreaChart data={data} margin={{ top: 10, right: 0, left: 0, bottom: 0 }}>
                    <defs>
                      <linearGradient id="colorValue" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="5%" stopColor="#52B788" stopOpacity={0.4}/>
                        <stop offset="95%" stopColor="#52B788" stopOpacity={0}/>
                      </linearGradient>
                    </defs>
                    <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#E5E7EB" />
                    <XAxis 
                      dataKey="time" 
                      axisLine={false} 
                      tickLine={false} 
                      tick={{ fill: '#9CA3AF', fontSize: 12 }} 
                      dy={10}
                    />
                    <YAxis 
                      domain={[5, 9]} 
                      axisLine={false} 
                      tickLine={false} 
                      tick={{ fill: '#9CA3AF', fontSize: 12 }} 
                    />
                    <Tooltip 
                      contentStyle={{ backgroundColor: '#1B4332', color: '#fff', borderRadius: '8px', border: 'none' }}
                      itemStyle={{ color: '#fff' }}
                      cursor={{ stroke: '#2D6A4F', strokeWidth: 2 }}
                    />
                    <Area 
                      type="monotone" 
                      dataKey="value" 
                      stroke="#2D6A4F" 
                      strokeWidth={3} 
                      fillOpacity={1} 
                      fill="url(#colorValue)" 
                    />
                  </AreaChart>
                </ResponsiveContainer>
              </div>
            </div>
          </div>

          {/* Sidebar Controls (1/3 width) */}
          <div className="flex flex-col gap-6">
            {/* Live Stats Card */}
            <div className="bg-surface rounded-xl p-6 shadow-soft border border-primary/10">
              <h3 className="font-serif text-lg font-semibold text-primary-dark mb-4">Sensor Terkini</h3>
              <div className="grid grid-cols-2 gap-4">
                <div className="bg-background-light rounded-2xl p-4 flex flex-col justify-between">
                  <div className="flex items-start justify-between mb-2">
                    <Droplet className="text-primary-light h-6 w-6" />
                    <span className="text-xs font-bold text-primary-light bg-primary-light/10 px-2 py-0.5 rounded-full">Normal</span>
                  </div>
                  <div>
                    <span className="text-sm text-primary/60 font-medium">Current pH</span>
                    <div className="text-3xl font-mono font-bold text-primary-dark mt-1">7.2</div>
                  </div>
                </div>
                <div className="bg-background-light rounded-2xl p-4 flex flex-col justify-between">
                  <div className="flex items-start justify-between mb-2">
                    <Waves className="text-accent-sand h-6 w-6" />
                    <span className="text-xs font-bold text-accent-sand bg-accent-sand/10 px-2 py-0.5 rounded-full">Alert</span>
                  </div>
                  <div>
                    <span className="text-sm text-primary/60 font-medium">Turbidity</span>
                    <div className="text-3xl font-mono font-bold text-primary-dark mt-1">12<span className="text-sm ml-1">NTU</span></div>
                  </div>
                </div>
              </div>
            </div>

            {/* Relay Control Card */}
            <div className="bg-surface rounded-xl p-6 shadow-soft border border-primary/10 flex-grow flex flex-col">
              <div className="flex items-center justify-between mb-4">
                <h3 className="font-serif text-lg font-semibold text-primary-dark">Kontrol Pompa</h3>
                <div className="flex items-center gap-2">
                  <div className="h-2 w-2 rounded-full bg-primary animate-pulse" />
                  <span className="text-xs font-mono text-primary/60">CONNECTED</span>
                </div>
              </div>
              
              <div className="flex-grow flex flex-col items-center justify-center py-6">
                {/* Big Toggle Switch */}
                <label className="flex items-center cursor-pointer relative mb-4">
                  <input 
                    type="checkbox" 
                    className="sr-only peer" 
                    checked={pumpActive}
                    onChange={() => setPumpActive(!pumpActive)}
                  />
                  <div className="w-20 h-10 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-9 after:w-9 after:transition-all peer-checked:bg-primary transition-colors duration-300"></div>
                  <span className={clsx("ml-3 text-lg font-bold transition-colors", pumpActive ? "text-primary" : "text-primary-dark")}>
                    {pumpActive ? 'ON' : 'OFF'}
                  </span>
                </label>
                <p className="text-center text-primary-dark font-medium">Status: <span className="font-bold">{pumpActive ? 'Active' : 'Inactive'}</span></p>
              </div>

              {/* Warning Box */}
              <div className="mt-auto bg-accent-terra/10 border border-accent-terra/20 rounded-xl p-4 flex gap-3 items-start">
                <AlertTriangle className="text-accent-terra shrink-0 h-5 w-5" />
                <div>
                  <p className="text-accent-terra font-bold text-sm mb-1">Peringatan Admin</p>
                  <p className="text-accent-terra/80 text-xs leading-relaxed">
                    Mematikan pompa secara paksa akan menghentikan aliran air ke rumah warga. Gunakan hanya saat darurat.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Alert History Table */}
        <div className="bg-surface rounded-xl shadow-soft border border-primary/10 overflow-hidden">
          <div className="px-6 py-5 border-b border-background-light flex items-center justify-between">
            <h3 className="font-serif text-xl font-semibold text-primary-dark">Riwayat Peringatan (Alert Log)</h3>
            <button className="text-sm text-primary font-bold hover:underline">View All History</button>
          </div>
          <div className="overflow-x-auto">
            <table className="w-full text-left border-collapse">
              <thead>
                <tr className="bg-background-light/50 text-primary/60 text-xs uppercase tracking-wider font-semibold">
                  <th className="px-6 py-4 font-medium">Waktu (Time)</th>
                  <th className="px-6 py-4 font-medium">Sensor Issue</th>
                  <th className="px-6 py-4 font-medium">Value Recorded</th>
                  <th className="px-6 py-4 font-medium">Duration</th>
                  <th className="px-6 py-4 font-medium text-right">Status</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-background-light">
                <tr className="hover:bg-background-light/30 transition-colors">
                  <td className="px-6 py-4">
                    <div className="font-mono text-sm text-primary-dark font-medium">Today, 14:20</div>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-2">
                      <Droplet className="text-accent-terra h-4 w-4" />
                      <span className="text-sm font-medium text-primary-dark">pH Spike (High)</span>
                    </div>
                  </td>
                  <td className="px-6 py-4 font-mono text-sm text-primary-dark">8.9 pH</td>
                  <td className="px-6 py-4 text-sm text-primary/70">15 mins</td>
                  <td className="px-6 py-4 text-right">
                    <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-accent-terra/10 text-accent-terra">
                      Unresolved
                    </span>
                  </td>
                </tr>
                <tr className="hover:bg-background-light/30 transition-colors">
                  <td className="px-6 py-4">
                    <div className="font-mono text-sm text-primary-dark font-medium">Yesterday, 09:12</div>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-2">
                      <Waves className="text-accent-sand h-4 w-4" />
                      <span className="text-sm font-medium text-primary-dark">Turbidity Warning</span>
                    </div>
                  </td>
                  <td className="px-6 py-4 font-mono text-sm text-primary-dark">45 NTU</td>
                  <td className="px-6 py-4 text-sm text-primary/70">2 hours</td>
                  <td className="px-6 py-4 text-right">
                    <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-light/10 text-primary">
                      Resolved
                    </span>
                  </td>
                </tr>
                <tr className="hover:bg-background-light/30 transition-colors">
                  <td className="px-6 py-4">
                    <div className="font-mono text-sm text-primary-dark font-medium">Oct 24, 18:30</div>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-2">
                      <ZapOff className="text-accent-terra h-4 w-4" />
                      <span className="text-sm font-medium text-primary-dark">Pump Failure</span>
                    </div>
                  </td>
                  <td className="px-6 py-4 font-mono text-sm text-primary-dark">No Response</td>
                  <td className="px-6 py-4 text-sm text-primary/70">45 mins</td>
                  <td className="px-6 py-4 text-right">
                    <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-light/10 text-primary">
                      Resolved
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
}
