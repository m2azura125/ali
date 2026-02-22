import { useState } from 'react';
import { Link } from 'react-router-dom';
import { 
  Droplet, 
  Bell, 
  FlaskConical, 
  Waves, 
  RotateCcw, 
  Save 
} from 'lucide-react';
import clsx from 'clsx';

export default function Settings() {
  const [phMin, setPhMin] = useState(6.5);
  const [phMax, setPhMax] = useState(8.5);
  const [turbidityLimit, setTurbidityLimit] = useState(50);
  const [emailNotif, setEmailNotif] = useState(true);
  const [smsNotif, setSmsNotif] = useState(false);

  return (
    <div className="bg-background-light font-sans text-slate-900 min-h-screen flex flex-col antialiased selection:bg-primary/30">
      {/* Navbar */}
      <header className="sticky top-0 z-40 w-full border-b border-primary/10 bg-background-light/80 backdrop-blur-md">
        <div className="px-6 md:px-10 h-16 flex items-center justify-between max-w-7xl mx-auto">
          <div className="flex items-center gap-3 text-primary-dark">
            <div className="h-8 w-8 text-primary">
              <Droplet className="h-8 w-8 fill-current" />
            </div>
            <h2 className="text-lg font-bold tracking-tight">Eco-Monitor</h2>
          </div>
          <nav className="hidden md:flex items-center gap-8">
            <Link to="/admin" className="text-slate-500 hover:text-primary text-sm font-medium transition-colors">Dashboard</Link>
            <Link to="/admin/grid" className="text-slate-500 hover:text-primary text-sm font-medium transition-colors">Grid</Link>
            <Link to="/admin/settings" className="text-primary-dark text-sm font-bold border-b-2 border-primary pb-1">Settings</Link>
          </nav>
          <div className="flex items-center gap-4">
            <div className="bg-white h-10 w-10 rounded-full flex items-center justify-center border border-slate-200 shadow-sm">
              <Bell className="h-5 w-5 text-slate-500" />
            </div>
            <div 
              className="bg-cover bg-center rounded-full h-10 w-10 ring-2 ring-white shadow-md"
              style={{ backgroundImage: "url('https://lh3.googleusercontent.com/aida-public/AB6AXuDgLJhV2NTRSG9tNUQnO1_wl4wbnT4xIT3ndnTjw7RuwkJKa3E-bpH6kFYC3LErUImkU3UBxRxvvNPt6NlFlkQZUnC2WBQjDHFTDj4AHuBQ1TTcp2r9EfOkxWSJ-4GCqeCwYMOlQJTezt4CwAFSHSq3hZ7V6fB5en9EVQ_b5Deu_3Y1IjaD85PtEXCUGA_F0OTkLq4azsW_69P1revf7pY0ws4oie6WH9T8pcc21TFnX5dOnOF-WijcNit3yHKFbcXWKhlhpP7VRFc')" }}
            />
          </div>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex-grow w-full px-4 py-8 md:py-12">
        <div className="max-w-[600px] mx-auto flex flex-col gap-8">
          {/* Page Header */}
          <div className="flex flex-col gap-2 text-center pb-4">
            <h1 className="text-3xl md:text-4xl font-extrabold tracking-tight text-primary-dark font-serif">Calibration & Settings</h1>
            <p className="text-slate-500 font-medium">Configure safety thresholds for sensor alerts.</p>
          </div>

          {/* pH Level Card */}
          <section className="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-primary/10 relative overflow-hidden">
            <div className="flex items-center justify-between mb-6">
              <div className="flex items-center gap-3">
                <div className="p-2 bg-blue-100 rounded-full text-blue-600">
                  <FlaskConical className="h-6 w-6" />
                </div>
                <div>
                  <h3 className="font-bold text-lg leading-tight text-primary-dark">pH Levels</h3>
                  <p className="text-xs text-slate-500 font-medium mt-0.5">Acidic vs Alkaline balance</p>
                </div>
              </div>
              <span className="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-bold border border-primary/20">
                {phMin} - {phMax} pH
              </span>
            </div>
            
            <div className="pt-6 pb-2">
              <div className="relative h-12 w-full flex items-center">
                {/* Track Background */}
                <div className="absolute w-full h-3 rounded-full bg-gradient-to-r from-red-400 via-primary to-red-400 opacity-20" />
                
                {/* Active Safe Zone Track (Simulated) */}
                <div 
                  className="absolute h-3 rounded-full bg-gradient-to-r from-red-400 via-primary to-red-400"
                  style={{ left: '0', right: '0' }}
                />
                
                {/* Handles (Visual Only for Prototype) */}
                <div className="absolute top-1/2 -translate-y-1/2 w-full h-full pointer-events-none">
                   {/* Min Handle */}
                   <div className="absolute top-1/2 -translate-y-1/2" style={{ left: '30%' }}>
                      <div className="w-8 h-8 bg-white rounded-full shadow-lg border-2 border-primary flex items-center justify-center transform -translate-x-1/2 cursor-ew-resize pointer-events-auto hover:scale-110 transition-transform">
                        <div className="w-2 h-2 bg-primary rounded-full" />
                      </div>
                   </div>
                   {/* Max Handle */}
                   <div className="absolute top-1/2 -translate-y-1/2" style={{ left: '70%' }}>
                      <div className="w-8 h-8 bg-white rounded-full shadow-lg border-2 border-primary flex items-center justify-center transform -translate-x-1/2 cursor-ew-resize pointer-events-auto hover:scale-110 transition-transform">
                        <div className="w-2 h-2 bg-primary rounded-full" />
                      </div>
                   </div>
                </div>

                {/* Connector */}
                <div className="absolute top-1/2 -translate-y-1/2 h-3 bg-primary/20 backdrop-blur-sm left-[30%] right-[30%] pointer-events-none z-10 border-x border-primary/50" />
              </div>
              
              <div className="flex justify-between text-xs font-mono text-slate-400 mt-2">
                <span>0 pH</span>
                <span>7 pH</span>
                <span>14 pH</span>
              </div>
            </div>
            
            <p className="text-sm text-slate-500 mt-4 leading-relaxed">
              Alerts trigger if water acidity falls below <strong className="text-slate-700">{phMin}</strong> or rises above <strong className="text-slate-700">{phMax}</strong>.
            </p>
          </section>

          {/* Turbidity Card */}
          <section className="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-primary/10">
            <div className="flex items-center justify-between mb-6">
              <div className="flex items-center gap-3">
                <div className="p-2 bg-amber-100 rounded-full text-amber-600">
                  <Waves className="h-6 w-6" />
                </div>
                <div>
                  <h3 className="font-bold text-lg leading-tight text-primary-dark">Turbidity Limit</h3>
                  <p className="text-xs text-slate-500 font-medium mt-0.5">Maximum particles allowed</p>
                </div>
              </div>
              <div className="flex items-baseline gap-1">
                <span className="text-2xl font-bold text-primary-dark">{turbidityLimit}</span>
                <span className="text-sm font-medium text-slate-500">NTU</span>
              </div>
            </div>
            
            <div className="py-4">
              <input 
                type="range" 
                min="0" 
                max="100" 
                value={turbidityLimit} 
                onChange={(e) => setTurbidityLimit(Number(e.target.value))}
                className="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-amber-400"
              />
            </div>
            
            <p className="text-sm text-slate-500 mt-2">
              Standard clear water is below 5 NTU. Community alert triggers at <strong className="text-slate-700">{turbidityLimit} NTU</strong>.
            </p>
          </section>

          {/* Notifications Card */}
          <section className="bg-white rounded-xl p-6 md:p-8 shadow-sm border border-primary/10">
            <div className="flex items-center gap-3 mb-6">
              <div className="p-2 bg-purple-100 rounded-full text-purple-600">
                <Bell className="h-6 w-6" />
              </div>
              <h3 className="font-bold text-lg text-primary-dark">Alert Preferences</h3>
            </div>
            
            <div className="space-y-4">
              {/* Email Toggle */}
              <label className="flex items-start gap-4 p-4 border border-slate-200 rounded-xl cursor-pointer hover:border-primary/50 transition-colors bg-background-light/50">
                <div className="relative flex items-center mt-1">
                  <input 
                    type="checkbox" 
                    className="sr-only peer" 
                    checked={emailNotif}
                    onChange={() => setEmailNotif(!emailNotif)}
                  />
                  <div className="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary transition-colors"></div>
                </div>
                <div className="flex-1">
                  <span className="block text-sm font-bold text-primary-dark mb-1">Email Notifications</span>
                  <span className="block text-xs text-slate-500 mb-3">Receive weekly reports and critical alerts.</span>
                  <input 
                    type="email" 
                    defaultValue="admin@rw04-cilandak.id"
                    className="w-full text-sm bg-white border border-slate-200 rounded-lg px-3 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-shadow" 
                    placeholder="Enter email address"
                  />
                </div>
              </label>
              
              {/* SMS Toggle */}
              <label className="flex items-start gap-4 p-4 border border-slate-200 rounded-xl cursor-pointer hover:border-primary/50 transition-colors bg-background-light/50">
                <div className="relative flex items-center mt-1">
                  <input 
                    type="checkbox" 
                    className="sr-only peer" 
                    checked={smsNotif}
                    onChange={() => setSmsNotif(!smsNotif)}
                  />
                  <div className="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary transition-colors"></div>
                </div>
                <div className="flex-1">
                  <span className="block text-sm font-bold text-primary-dark mb-1">SMS Alerts</span>
                  <span className="block text-xs text-slate-500">Immediate text for critical danger levels only.</span>
                </div>
              </label>
            </div>
          </section>
        </div>
      </main>

      {/* Sticky Bottom Bar */}
      <div className="sticky bottom-6 z-30 px-4 mt-auto">
        <div className="max-w-[600px] mx-auto bg-primary-dark/95 backdrop-blur-xl p-2 rounded-full shadow-2xl flex items-center justify-between border border-primary-dark">
          <button 
            onClick={() => {
              setPhMin(6.5);
              setPhMax(8.5);
              setTurbidityLimit(50);
            }}
            className="px-6 py-3 rounded-full text-slate-300 hover:text-white text-sm font-bold transition-colors flex items-center gap-2"
          >
            <RotateCcw className="h-5 w-5" />
            Reset Defaults
          </button>
          <button className="px-8 py-3 bg-primary hover:bg-primary-light text-primary-dark rounded-full text-sm font-bold shadow-lg shadow-primary/20 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
            <Save className="h-5 w-5" />
            Save Configuration
          </button>
        </div>
      </div>
    </div>
  );
}
