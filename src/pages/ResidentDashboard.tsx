import { useState } from 'react';
import Sidebar from '../components/Sidebar';
import { 
  MapPin, 
  ShieldCheck, 
  Power, 
  FlaskConical, 
  Waves, 
  Thermometer, 
  Info 
} from 'lucide-react';
import clsx from 'clsx';

export default function ResidentDashboard() {
  const [pumpActive, setPumpActive] = useState(true);

  return (
    <div className="flex min-h-screen bg-background-light font-sans">
      <Sidebar role="resident" />
      
      <main className="flex-1 p-6 md:p-12 lg:p-16 flex flex-col gap-10 overflow-y-auto h-screen">
        {/* Header Section */}
        <header className="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 animate-[fadeIn_0.6s_ease-out]">
          <div className="flex flex-col gap-2">
            <h1 className="text-4xl md:text-5xl font-bold text-primary tracking-tight leading-[1.1] font-serif">
              Selamat Pagi,<br />Rumah A-12
            </h1>
            <div className="flex items-center gap-2 text-primary-dark/60 mt-1">
              <MapPin className="h-4 w-4" />
              <p className="font-medium">Jl. Merpati Blok A-12, Cluster Harmoni</p>
            </div>
          </div>
          <div className="flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-primary/10">
            <span className="w-2 h-2 rounded-full bg-primary-light animate-pulse" />
            <span className="text-sm font-medium text-primary-dark/80">Sistem Online</span>
          </div>
        </header>

        {/* Hero Status Card */}
        <section className="relative w-full overflow-hidden rounded-[2rem] bg-primary-light/10 border border-primary-light/20 shadow-soft transition-all duration-500 hover:shadow-lg group">
          {/* Abstract Background Shapes */}
          <div className="absolute top-0 right-0 w-64 h-64 bg-primary-light/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2" />
          <div className="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2" />
          
          <div className="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between p-8 md:p-12 gap-8">
            {/* Left: Status Text */}
            <div className="flex flex-col gap-4 max-w-xl">
              <div className="flex items-center gap-3 mb-2">
                <span className="flex items-center justify-center w-12 h-12 rounded-full bg-primary-light text-white shadow-lg shadow-primary-light/40">
                  <ShieldCheck className="h-7 w-7" />
                </span>
                <span className="px-4 py-1.5 rounded-full bg-primary-light/20 text-primary font-bold tracking-wide uppercase text-sm">
                  Status Normal
                </span>
              </div>
              <h2 className="text-3xl md:text-4xl font-bold text-primary-dark leading-tight font-serif">
                Air Aman Digunakan
              </h2>
              <p className="text-primary-dark/70 text-lg leading-relaxed">
                Kualitas air optimal untuk kebutuhan sehari-hari. Semua indikator dalam batas wajar.
              </p>
            </div>

            {/* Right: Master Pump Control */}
            <div className="flex flex-col items-center lg:items-end gap-3 w-full lg:w-auto mt-4 lg:mt-0">
              <div className="bg-white/70 backdrop-blur-md p-6 rounded-[2rem] border border-white/50 shadow-sm flex flex-col items-center gap-4 min-w-[200px]">
                <span className="text-sm font-bold text-primary-dark/60 uppercase tracking-wider">Pompa Air Utama</span>
                
                {/* Toggle Switch Component */}
                <label className="relative inline-flex items-center cursor-pointer group">
                  <input 
                    type="checkbox" 
                    className="sr-only peer" 
                    checked={pumpActive}
                    onChange={() => setPumpActive(!pumpActive)}
                  />
                  {/* Track */}
                  <div className="w-[88px] h-[48px] bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-primary shadow-inner transition-colors duration-300 ease-in-out" />
                  {/* Thumb */}
                  <div className={clsx(
                    "absolute left-[4px] top-[4px] bg-white border border-gray-100 rounded-full h-[40px] w-[40px] transition-all duration-300 ease-in-out shadow-md flex items-center justify-center text-gray-300 peer-checked:text-primary",
                    pumpActive ? "translate-x-[40px]" : "translate-x-0"
                  )}>
                    <Power className="h-5 w-5" />
                  </div>
                </label>
                
                <span className={clsx(
                  "text-xs font-mono font-bold px-3 py-1 rounded-full transition-colors",
                  pumpActive ? "text-primary bg-primary/10" : "text-gray-400 bg-gray-100"
                )}>
                  RELAY: {pumpActive ? 'ACTIVE' : 'OFF'}
                </span>
              </div>
            </div>
          </div>
        </section>

        {/* Metrics Grid */}
        <section className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {/* pH Card */}
          <div className="bg-surface rounded-[2rem] p-8 shadow-soft border border-primary/10 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
            <div className="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-blue-100 transition-colors" />
            
            <div className="flex justify-between items-start relative z-10">
              <div className="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <FlaskConical className="h-6 w-6" />
              </div>
              <span className="text-sm font-medium text-primary-dark/40 bg-background-light px-3 py-1 rounded-full">Real-time</span>
            </div>
            
            <div className="relative z-10">
              <span className="text-sm font-bold text-primary-dark/50 uppercase tracking-wider">Tingkat pH</span>
              <div className="flex items-baseline gap-2 mt-1">
                <span className="text-5xl font-mono font-bold text-primary-dark">7.2</span>
                <span className="text-sm font-medium text-primary-dark/40">pH</span>
              </div>
            </div>
            
            <div className="relative z-10 pt-4 border-t border-dashed border-gray-100">
              <div className="flex items-center gap-2">
                <span className="w-2 h-2 rounded-full bg-primary-light" />
                <span className="text-sm font-medium text-primary-dark/70">Normal (6.5 - 8.5)</span>
              </div>
            </div>
          </div>

          {/* Turbidity Card */}
          <div className="bg-surface rounded-[2rem] p-8 shadow-soft border border-primary/10 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
            <div className="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-amber-100 transition-colors" />
            
            <div className="flex justify-between items-start relative z-10">
              <div className="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <Waves className="h-6 w-6" />
              </div>
              <span className="text-sm font-medium text-primary-dark/40 bg-background-light px-3 py-1 rounded-full">Real-time</span>
            </div>
            
            <div className="relative z-10">
              <span className="text-sm font-bold text-primary-dark/50 uppercase tracking-wider">Kekeruhan</span>
              <div className="flex items-baseline gap-2 mt-1">
                <span className="text-5xl font-mono font-bold text-primary-dark">12</span>
                <span className="text-sm font-medium text-primary-dark/40">NTU</span>
              </div>
            </div>
            
            <div className="relative z-10 pt-4 border-t border-dashed border-gray-100">
              <div className="flex items-center gap-2">
                <span className="w-2 h-2 rounded-full bg-primary-light" />
                <span className="text-sm font-medium text-primary-dark/70">Jernih (&lt; 25 NTU)</span>
              </div>
            </div>
          </div>

          {/* Temperature Card */}
          <div className="bg-surface rounded-[2rem] p-8 shadow-soft border border-primary/10 hover:-translate-y-1 transition-transform duration-300 flex flex-col justify-between h-64 group relative overflow-hidden">
            <div className="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-full blur-[40px] -translate-y-1/2 translate-x-1/2 group-hover:bg-rose-100 transition-colors" />
            
            <div className="flex justify-between items-start relative z-10">
              <div className="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <Thermometer className="h-6 w-6" />
              </div>
              <span className="text-sm font-medium text-primary-dark/40 bg-background-light px-3 py-1 rounded-full">Real-time</span>
            </div>
            
            <div className="relative z-10">
              <span className="text-sm font-bold text-primary-dark/50 uppercase tracking-wider">Suhu Air</span>
              <div className="flex items-baseline gap-2 mt-1">
                <span className="text-5xl font-mono font-bold text-primary-dark">26°</span>
                <span className="text-sm font-medium text-primary-dark/40">Celsius</span>
              </div>
            </div>
            
            <div className="relative z-10 pt-4 border-t border-dashed border-gray-100">
              <div className="flex items-center gap-2">
                <span className="w-2 h-2 rounded-full bg-primary-light" />
                <span className="text-sm font-medium text-primary-dark/70">Sejuk (Normal)</span>
              </div>
            </div>
          </div>
        </section>

        {/* Footer */}
        <footer className="mt-auto pt-6 flex flex-col md:flex-row justify-between items-center text-primary-dark/40 text-sm gap-4">
          <p>Terakhir diperbarui: 2 menit yang lalu</p>
          <div className="flex items-center gap-2 px-4 py-2 bg-white rounded-full border border-primary/10 shadow-sm">
            <Info className="h-4 w-4" />
            <span>Tips: Matikan pompa jika pH &gt; 8.5</span>
          </div>
        </footer>
      </main>
    </div>
  );
}
