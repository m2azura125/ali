import { Link, useLocation } from 'react-router-dom';
import { 
  Droplet, 
  Home, 
  History, 
  Settings, 
  HelpCircle, 
  LayoutGrid, 
  Bell, 
  LogOut 
} from 'lucide-react';
import clsx from 'clsx';

interface SidebarProps {
  role: 'resident' | 'admin';
}

export default function Sidebar({ role }: SidebarProps) {
  const location = useLocation();

  const residentLinks = [
    { name: 'Beranda', icon: Home, path: '/resident' },
    { name: 'Riwayat', icon: History, path: '/resident/history' },
    { name: 'Pengaturan', icon: Settings, path: '/resident/settings' },
    { name: 'Bantuan', icon: HelpCircle, path: '/resident/help' },
  ];

  const adminLinks = [
    { name: 'Overview', icon: LayoutGrid, path: '/admin' },
    { name: 'Neighborhood Grid', icon: LayoutGrid, path: '/admin/grid' },
    { name: 'Alerts', icon: Bell, path: '/admin/alerts' },
    { name: 'Settings', icon: Settings, path: '/admin/settings' },
  ];

  const links = role === 'resident' ? residentLinks : adminLinks;

  return (
    <aside className="hidden w-72 flex-col justify-between border-r border-primary/10 bg-surface p-6 lg:flex z-20 shadow-soft h-screen sticky top-0">
      <div className="flex flex-col gap-8">
        {/* Branding */}
        <div className="flex items-center gap-3 px-2">
          <div className="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white shadow-lg shadow-primary/30">
            <Droplet className="h-6 w-6 fill-current" />
          </div>
          <div>
            <h1 className="font-serif text-xl font-bold text-primary-dark tracking-tight">
              {role === 'resident' ? 'EcoWater' : 'EcoMonitor'}
            </h1>
            {role === 'admin' && (
              <p className="text-xs text-primary/60 font-medium">Community Water</p>
            )}
          </div>
        </div>

        {/* Navigation */}
        <nav className="flex flex-col gap-2">
          {links.map((link) => {
            const isActive = location.pathname === link.path;
            const Icon = link.icon;
            
            return (
              <Link
                key={link.path}
                to={link.path}
                className={clsx(
                  "group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all",
                  isActive 
                    ? "bg-primary/10 text-primary font-bold" 
                    : "text-primary-dark hover:bg-surface-muted hover:text-primary"
                )}
              >
                <Icon className={clsx(
                  "h-5 w-5 transition-transform group-hover:scale-110",
                  isActive ? "text-primary" : "text-primary/70 group-hover:text-primary"
                )} />
                <span>{link.name}</span>
              </Link>
            );
          })}
        </nav>
      </div>

      {/* Profile */}
      <div className="flex items-center gap-3 rounded-2xl bg-surface-muted p-3 border-t border-primary/5">
        <div 
          className="h-10 w-10 rounded-full bg-cover bg-center ring-2 ring-white shadow-sm"
          style={{ backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuAIopxPNIMGbW9w7u6qVO8grahOTcLh40sp4X6Jzpq9KXHtGPd5n4ZjPZxdMwhcufEEo7qz10eDODSi_PMEexSjBtk3y9Tq5j1QddahjEIFdioxlXAVcqORJwwtVUjAdE1eUraqhRkJGoRklnvB8Hk9Vv9ZZ0w9bRMPQCGmTy4pIX6h1wxpjExL9Q1EtJCHtBG0n2y-mfw9ZzBgL7ZXb4xLjY43rsL82hZAkJqCccBHAi3pl-sjFRXurELagaOCqXBDgoDVmNVSIbE')" }}
        />
        <div className="flex flex-col">
          <p className="text-sm font-bold text-primary-dark">
            {role === 'resident' ? 'Bapak Budi' : 'Pak Budi (RT)'}
          </p>
          <p className="text-xs text-primary/60">
            {role === 'resident' ? 'Warga (A-12)' : 'Admin Access'}
          </p>
        </div>
        <Link to="/" className="ml-auto flex h-8 w-8 items-center justify-center rounded-full bg-white text-primary hover:bg-primary hover:text-white transition-colors shadow-sm">
          <LogOut className="h-4 w-4" />
        </Link>
      </div>
    </aside>
  );
}
