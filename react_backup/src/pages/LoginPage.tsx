import { useState } from 'react';
import type { FormEvent } from 'react';
import { useNavigate } from 'react-router-dom';
import { motion, AnimatePresence } from 'motion/react';
import { Droplet, Home, Lock, ArrowRight, AlertCircle } from 'lucide-react';
import clsx from 'clsx';

export default function LoginPage() {
  const [role, setRole] = useState<'warga' | 'rt'>('warga');
  const [id, setId] = useState('');
  const [pin, setPin] = useState('');
  const [error, setError] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = (e: FormEvent) => {
    e.preventDefault();
    if (!id || !pin) {
      setError(true);
      setTimeout(() => setError(false), 820);
      return;
    }
    
    // Simple mock authentication
    if (role === 'warga') {
      navigate('/resident');
    } else {
      navigate('/admin');
    }
  };

  return (
    <div className="flex h-screen w-full overflow-hidden bg-background-light text-primary-dark font-sans">
      {/* Left Section: Abstract Zen Illustration */}
      <div className="hidden lg:flex w-1/2 bg-background-dark relative overflow-hidden flex-col justify-between p-12 text-white">
        {/* Ambient Background Gradient */}
        <div className="absolute inset-0 bg-gradient-to-br from-[#10221a] via-[#153326] to-[#0d1b15] z-0" />
        
        {/* Abstract Shapes */}
        <div className="absolute inset-0 opacity-40 z-0 pointer-events-none">
          <svg className="absolute top-0 left-0 w-full h-full text-primary/20" preserveAspectRatio="none" viewBox="0 0 100 100">
            <motion.path 
              d="M0 0 C 50 100 80 100 100 0 Z" 
              fill="currentColor"
              animate={{ 
                d: ["M0 0 C 50 100 80 100 100 0 Z", "M0 0 C 20 80 50 120 100 0 Z", "M0 0 C 50 100 80 100 100 0 Z"] 
              }}
              transition={{ duration: 10, repeat: Infinity, ease: "easeInOut" }}
            />
          </svg>
          <div className="absolute -bottom-1/4 -right-1/4 w-[800px] h-[800px] bg-primary/10 rounded-full blur-3xl animate-pulse" />
          <div className="absolute top-1/4 -left-1/4 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl" />
        </div>

        {/* Content Overlay */}
        <div className="relative z-10">
          <div className="flex items-center gap-2 mb-8">
            <Droplet className="text-primary h-10 w-10 fill-current" />
            <span className="text-xl font-bold tracking-tight text-primary">EcoWater</span>
          </div>
        </div>

        <div className="relative z-10 max-w-lg">
          <h2 className="text-5xl font-bold leading-tight mb-6 tracking-tight font-serif">
            Harmoni Air, <br />
            <span className="text-primary">Ketenangan Warga.</span>
          </h2>
          <p className="text-lg text-gray-300 font-light leading-relaxed">
            Pantau kualitas air lingkungan Anda secara real-time. Teknologi sederhana untuk ketenangan pikiran bersama.
          </p>
        </div>

        <div className="relative z-10 text-sm text-gray-400">
          © 2024 Eco-Community Monitor
        </div>
      </div>

      {/* Right Section: Login Form */}
      <div className="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-24 bg-background-light relative">
        {/* Mobile Header */}
        <div className="lg:hidden absolute top-6 left-6 flex items-center gap-2">
          <Droplet className="text-primary-dark h-8 w-8 fill-current" />
          <span className="text-lg font-bold text-primary-dark">EcoWater</span>
        </div>

        <div className="w-full max-w-md">
          {/* Header Text */}
          <div className="mb-10 text-center lg:text-left">
            <h1 className="text-4xl font-bold text-primary-dark mb-3 tracking-tight font-serif">Selamat Datang</h1>
            <p className="text-primary-dark/60 text-lg">Masuk untuk memantau lingkungan.</p>
          </div>

          {/* Role Selector */}
          <div className="bg-gray-200 p-1.5 rounded-full flex relative mb-12 shadow-inner">
            <motion.div 
              className="absolute top-1.5 bottom-1.5 w-[calc(50%-6px)] bg-white rounded-full shadow-sm"
              initial={false}
              animate={{ left: role === 'warga' ? '6px' : 'calc(50% + 3px)' }}
              transition={{ type: "spring", stiffness: 300, damping: 30 }}
            />
            <button 
              onClick={() => setRole('warga')}
              className={clsx(
                "flex-1 relative z-10 py-3 text-center text-sm font-semibold transition-colors duration-300 rounded-full focus:outline-none",
                role === 'warga' ? "text-primary-dark" : "text-primary-dark/60 hover:text-primary-dark"
              )}
            >
              Warga
            </button>
            <button 
              onClick={() => setRole('rt')}
              className={clsx(
                "flex-1 relative z-10 py-3 text-center text-sm font-semibold transition-colors duration-300 rounded-full focus:outline-none",
                role === 'rt' ? "text-primary-dark" : "text-primary-dark/60 hover:text-primary-dark"
              )}
            >
              Ketua RT
            </button>
          </div>

          {/* Form Inputs */}
          <form 
            onSubmit={handleSubmit} 
            className={clsx("space-y-8", error && "animate-[shake_0.82s_cubic-bezier(.36,.07,.19,.97)_both]")}
          >
            {/* ID Input */}
            <div className="group relative">
              <label 
                htmlFor="identity" 
                className="block text-sm font-medium text-primary-dark/60 mb-1 transition-all group-focus-within:text-primary-dark"
              >
                {role === 'warga' ? 'Nomor Rumah' : 'ID Admin'}
              </label>
              <input 
                id="identity" 
                type="text" 
                value={id}
                onChange={(e) => setId(e.target.value)}
                placeholder={role === 'warga' ? 'Misal: A-12' : 'Misal: admin_rt_01'}
                className="block w-full px-0 py-3 text-xl text-primary-dark bg-transparent border-0 border-b-2 border-gray-200 focus:border-primary focus:ring-0 transition-colors placeholder:text-gray-300 outline-none"
              />
              <Home className="absolute right-0 bottom-3 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors h-6 w-6" />
            </div>

            {/* PIN Input */}
            <div className="group relative">
              <label 
                htmlFor="pin" 
                className="block text-sm font-medium text-primary-dark/60 mb-1 transition-all group-focus-within:text-primary-dark"
              >
                PIN Keamanan
              </label>
              <input 
                id="pin" 
                type="password" 
                value={pin}
                onChange={(e) => setPin(e.target.value)}
                placeholder="••••••"
                className="block w-full px-0 py-3 text-xl text-primary-dark bg-transparent border-0 border-b-2 border-gray-200 focus:border-primary focus:ring-0 transition-colors placeholder:text-gray-300 tracking-widest outline-none"
              />
              <Lock className="absolute right-0 bottom-3 text-gray-300 pointer-events-none group-focus-within:text-primary transition-colors h-6 w-6" />
            </div>

            {/* Submit Button */}
            <div className="pt-4">
              <button 
                type="submit"
                className="w-full py-4 px-6 bg-primary hover:bg-primary-dark text-white font-bold text-lg rounded-full shadow-lg shadow-primary/20 hover:shadow-primary/40 transform active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 group"
              >
                <span>{role === 'warga' ? 'Masuk Lingkungan' : 'Masuk Dashboard'}</span>
                <ArrowRight className="h-5 w-5 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </form>

          {/* Footer Links */}
          <div className="mt-8 text-center">
            <a href="#" className="text-sm text-primary-dark/60 hover:text-primary-dark underline decoration-transparent hover:decoration-current transition-all">
              Lupa PIN atau ID?
            </a>
          </div>

          {/* Error Toast */}
          <AnimatePresence>
            {error && (
              <motion.div 
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: 20 }}
                className="absolute bottom-6 left-1/2 -translate-x-1/2 lg:left-auto lg:right-auto w-full max-w-sm px-4 lg:px-0"
              >
                <div className="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg flex items-center gap-3">
                  <AlertCircle className="h-5 w-5" />
                  <p className="text-sm font-medium">Mohon isi ID dan PIN dengan benar.</p>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </div>
      </div>
    </div>
  );
}
