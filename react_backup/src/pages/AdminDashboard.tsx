import { Link } from 'react-router-dom';
import Sidebar from '../components/Sidebar';
import { 
  Home, 
  AlertTriangle, 
  Menu, 
  X, 
  AlertOctagon 
} from 'lucide-react';
import { AreaChart, Area, ResponsiveContainer } from 'recharts';
import clsx from 'clsx';

// Mock Data for Sparklines
const dataDanger = [
  { value: 20 }, { value: 18 }, { value: 22 }, { value: 20 }, { value: 35 }, { value: 38 }
];
const dataWarning = [
  { value: 20 }, { value: 15 }, { value: 25 }, { value: 18 }, { value: 28 }
];
const dataStable1 = [
  { value: 25 }, { value: 22 }, { value: 25 }, { value: 23 }, { value: 24 }
];
const dataStable2 = [
  { value: 30 }, { value: 28 }, { value: 30 }, { value: 29 }, { value: 30 }
];
const dataStable3 = [
  { value: 20 }, { value: 22 }, { value: 20 }, { value: 18 }, { value: 20 }
];
const dataStable4 = [
  { value: 25 }, { value: 25 }, { value: 28 }, { value: 26 }, { value: 25 }
];

export default function AdminDashboard() {
  return (
    <div className="flex h-screen w-full bg-background-light overflow-hidden font-sans">
      <Sidebar role="admin" />
      
      <main className="flex-1 flex flex-col overflow-hidden bg-background-light relative">
        {/* Mobile Header */}
        <header className="flex items-center justify-between border-b border-primary/10 bg-white/50 px-6 py-4 backdrop-blur-md lg:hidden z-10 sticky top-0">
          <div className="flex items-center gap-2">
            <div className="h-8 w-8 bg-primary rounded-full flex items-center justify-center text-white">
              <span className="font-bold text-lg">E</span>
            </div>
            <span className="font-serif font-bold text-primary-dark">EcoMonitor</span>
          </div>
          <button className="rounded-full p-2 text-primary-dark hover:bg-surface-muted">
            <Menu className="h-6 w-6" />
          </button>
        </header>

        <div className="flex-1 overflow-y-auto p-6 md:p-10 pb-24">
          <div className="mx-auto max-w-7xl">
            {/* Page Header & Stats */}
            <div className="mb-10 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
              <div>
                <p className="mb-1 text-sm font-bold uppercase tracking-wider text-primary/60">Dashboard Admin</p>
                <h2 className="font-serif text-3xl font-bold text-primary-dark md:text-4xl">Status Lingkungan</h2>
              </div>
              
              {/* Global Stats Cards */}
              <div className="flex flex-wrap gap-4">
                <div className="flex min-w-[160px] flex-col rounded-2xl bg-white p-5 shadow-soft ring-1 ring-black/5">
                  <div className="mb-2 flex items-center gap-2 text-primary/70">
                    <Home className="h-5 w-5" />
                    <span className="text-sm font-medium">Total Rumah</span>
                  </div>
                  <div className="flex items-baseline gap-2">
                    <span className="font-mono text-3xl font-bold text-primary-dark">42</span>
                    <span className="rounded-full bg-surface-muted px-2 py-0.5 text-xs font-bold text-primary">+1 New</span>
                  </div>
                </div>
                
                <div className="flex min-w-[160px] flex-col rounded-2xl bg-white p-5 shadow-soft ring-1 ring-black/5">
                  <div className="mb-2 flex items-center gap-2 text-accent-terra">
                    <AlertTriangle className="h-5 w-5" />
                    <span className="text-sm font-medium">Status Bahaya</span>
                  </div>
                  <div className="flex items-baseline gap-2">
                    <span className="font-mono text-3xl font-bold text-primary-dark">2</span>
                    <span className="text-xs font-medium text-accent-terra">Action needed</span>
                  </div>
                </div>
              </div>
            </div>

            {/* Neighborhood Grid */}
            <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
              {/* Danger Card (Pulsing) */}
              <Link to="/admin/house/C-12" className="group relative flex cursor-pointer flex-col justify-between overflow-hidden rounded-[2rem] border-2 border-accent-terra bg-white p-6 shadow-deep transition-all duration-300 hover:-translate-y-1 hover:shadow-xl pulse-danger">
                <div className="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-accent-terra/10 blur-2xl" />
                
                <div className="mb-6 flex items-start justify-between">
                  <div>
                    <span className="font-mono text-xs font-bold uppercase tracking-widest text-accent-terra">Blok C-12</span>
                    <h3 className="mt-1 font-serif text-lg font-bold text-primary-dark">Kel. Santoso</h3>
                  </div>
                  <div className="flex h-8 w-8 items-center justify-center rounded-full bg-accent-terra/10 text-accent-terra">
                    <AlertOctagon className="h-4 w-4" />
                  </div>
                </div>
                
                {/* Sparkline (Critical Drop) */}
                <div className="mb-4 h-16 w-full">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={dataDanger}>
                      <Area type="monotone" dataKey="value" stroke="#E76F51" strokeWidth={2.5} fill="none" />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
                
                <div className="flex items-center justify-between border-t border-dashed border-accent-terra/30 pt-4">
                  <div className="flex flex-col">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary/50">pH Level</span>
                    <span className="font-mono text-lg font-bold text-accent-terra">4.2</span>
                  </div>
                  <button className="rounded-full bg-accent-terra px-4 py-2 text-xs font-bold text-white transition-colors hover:bg-red-600">
                    Check
                  </button>
                </div>
              </Link>

              {/* Warning Card */}
              <div className="group relative flex cursor-pointer flex-col justify-between overflow-hidden rounded-[2rem] border border-transparent bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:border-accent-sand hover:shadow-lg">
                <div className="mb-6 flex items-start justify-between">
                  <div>
                    <span className="font-mono text-xs font-bold uppercase tracking-widest text-accent-sand">Blok A-05</span>
                    <h3 className="mt-1 font-serif text-lg font-bold text-primary-dark">Bu Siti</h3>
                  </div>
                  <div className="h-3 w-3 rounded-full bg-accent-sand shadow-[0_0_8px_rgba(233,196,106,0.6)]" />
                </div>
                
                {/* Sparkline (Slight Fluctuation) */}
                <div className="mb-4 h-16 w-full opacity-80">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={dataWarning}>
                      <Area type="monotone" dataKey="value" stroke="#E9C46A" strokeWidth={2.5} fill="none" />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
                
                <div className="flex items-center justify-between border-t border-dashed border-gray-100 pt-4">
                  <div className="flex flex-col">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary/50">Turbidity</span>
                    <span className="font-mono text-lg font-bold text-primary-dark">18 NTU</span>
                  </div>
                  <div className="rounded-full bg-surface-muted px-3 py-1.5 text-xs font-bold text-primary-dark group-hover:bg-accent-sand/20">
                    Detail
                  </div>
                </div>
              </div>

              {/* Normal Card 1 */}
              <div className="group relative flex cursor-pointer flex-col justify-between overflow-hidden rounded-[2rem] border border-transparent bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div className="mb-6 flex items-start justify-between">
                  <div>
                    <span className="font-mono text-xs font-bold uppercase tracking-widest text-primary/40">Blok B-02</span>
                    <h3 className="mt-1 font-serif text-lg font-bold text-primary-dark">Pak Rahman</h3>
                  </div>
                  <div className="h-3 w-3 rounded-full bg-primary-light shadow-[0_0_8px_rgba(82,183,136,0.6)]" />
                </div>
                
                {/* Sparkline (Stable) */}
                <div className="mb-4 h-16 w-full opacity-60 grayscale transition-all group-hover:grayscale-0">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={dataStable1}>
                      <Area type="monotone" dataKey="value" stroke="#2D6A4F" strokeWidth={2} fill="none" />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
                
                <div className="flex items-center justify-between border-t border-dashed border-gray-100 pt-4">
                  <div className="flex flex-col">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary/50">Status</span>
                    <span className="font-mono text-lg font-bold text-primary-light">Normal</span>
                  </div>
                  <div className="rounded-full bg-surface-muted px-3 py-1.5 text-xs font-bold text-primary-dark group-hover:bg-primary/10">
                    Detail
                  </div>
                </div>
              </div>

              {/* Normal Card 2 */}
              <div className="group relative flex cursor-pointer flex-col justify-between overflow-hidden rounded-[2rem] border border-transparent bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div className="mb-6 flex items-start justify-between">
                  <div>
                    <span className="font-mono text-xs font-bold uppercase tracking-widest text-primary/40">Blok A-09</span>
                    <h3 className="mt-1 font-serif text-lg font-bold text-primary-dark">Keluarga Wijaya</h3>
                  </div>
                  <div className="h-3 w-3 rounded-full bg-primary-light shadow-[0_0_8px_rgba(82,183,136,0.6)]" />
                </div>
                
                <div className="mb-4 h-16 w-full opacity-60 grayscale transition-all group-hover:grayscale-0">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={dataStable2}>
                      <Area type="monotone" dataKey="value" stroke="#2D6A4F" strokeWidth={2} fill="none" />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
                
                <div className="flex items-center justify-between border-t border-dashed border-gray-100 pt-4">
                  <div className="flex flex-col">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary/50">Status</span>
                    <span className="font-mono text-lg font-bold text-primary-light">Normal</span>
                  </div>
                  <div className="rounded-full bg-surface-muted px-3 py-1.5 text-xs font-bold text-primary-dark group-hover:bg-primary/10">
                    Detail
                  </div>
                </div>
              </div>

              {/* Normal Card 3 */}
              <div className="group relative flex cursor-pointer flex-col justify-between overflow-hidden rounded-[2rem] border border-transparent bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div className="mb-6 flex items-start justify-between">
                  <div>
                    <span className="font-mono text-xs font-bold uppercase tracking-widest text-primary/40">Blok D-11</span>
                    <h3 className="mt-1 font-serif text-lg font-bold text-primary-dark">Ibu Hani</h3>
                  </div>
                  <div className="h-3 w-3 rounded-full bg-primary-light shadow-[0_0_8px_rgba(82,183,136,0.6)]" />
                </div>
                
                <div className="mb-4 h-16 w-full opacity-60 grayscale transition-all group-hover:grayscale-0">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={dataStable3}>
                      <Area type="monotone" dataKey="value" stroke="#2D6A4F" strokeWidth={2} fill="none" />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
                
                <div className="flex items-center justify-between border-t border-dashed border-gray-100 pt-4">
                  <div className="flex flex-col">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary/50">Status</span>
                    <span className="font-mono text-lg font-bold text-primary-light">Normal</span>
                  </div>
                  <div className="rounded-full bg-surface-muted px-3 py-1.5 text-xs font-bold text-primary-dark group-hover:bg-primary/10">
                    Detail
                  </div>
                </div>
              </div>

              {/* Normal Card 4 */}
              <div className="group relative flex cursor-pointer flex-col justify-between overflow-hidden rounded-[2rem] border border-transparent bg-white p-6 shadow-soft transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div className="mb-6 flex items-start justify-between">
                  <div>
                    <span className="font-mono text-xs font-bold uppercase tracking-widest text-primary/40">Blok C-01</span>
                    <h3 className="mt-1 font-serif text-lg font-bold text-primary-dark">Pak Joko</h3>
                  </div>
                  <div className="h-3 w-3 rounded-full bg-primary-light shadow-[0_0_8px_rgba(82,183,136,0.6)]" />
                </div>
                
                <div className="mb-4 h-16 w-full opacity-60 grayscale transition-all group-hover:grayscale-0">
                  <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={dataStable4}>
                      <Area type="monotone" dataKey="value" stroke="#2D6A4F" strokeWidth={2} fill="none" />
                    </AreaChart>
                  </ResponsiveContainer>
                </div>
                
                <div className="flex items-center justify-between border-t border-dashed border-gray-100 pt-4">
                  <div className="flex flex-col">
                    <span className="text-[10px] font-bold uppercase tracking-wider text-primary/50">Status</span>
                    <span className="font-mono text-lg font-bold text-primary-light">Normal</span>
                  </div>
                  <div className="rounded-full bg-surface-muted px-3 py-1.5 text-xs font-bold text-primary-dark group-hover:bg-primary/10">
                    Detail
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Fixed Alert Toast */}
          <div className="fixed bottom-6 right-6 z-50 flex animate-bounce flex-col gap-2 md:bottom-10 md:right-10">
            <div className="flex w-full max-w-sm items-center gap-4 rounded-xl bg-background-dark p-4 text-white shadow-2xl ring-1 ring-white/10 backdrop-blur-md">
              <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-accent-terra text-white">
                <AlertTriangle className="h-5 w-5" />
              </div>
              <div className="flex flex-col">
                <h4 className="font-bold text-sm">Alert: Blok C-12</h4>
                <p className="text-xs text-gray-300">pH level reached critical low (4.2).</p>
              </div>
              <button className="ml-auto rounded-full p-1 text-gray-400 hover:bg-white/10 hover:text-white">
                <X className="h-4 w-4" />
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
}
