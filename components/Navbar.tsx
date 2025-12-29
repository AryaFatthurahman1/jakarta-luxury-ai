
import React from 'react';
import { User, AppRoute } from '../types';

interface NavbarProps {
  user: User | null;
  onLogout: () => void;
}

const Navbar: React.FC<NavbarProps> = ({ user, onLogout }) => {
  return (
    <nav className="sticky top-0 z-50 glass border-b border-luxury-gold/20 px-6 py-4 flex items-center justify-between">
      <div className="flex items-center space-x-2">
        <a href={`#${AppRoute.HOME}`} className="text-2xl font-serif font-bold tracking-tighter text-luxury-gold">
          JAKARTA <span className="text-white font-light">LUXURY</span>
        </a>
      </div>

      <div className="hidden md:flex items-center space-x-8 text-sm uppercase tracking-widest font-medium">
        <a href={`#${AppRoute.TRAVEL}`} className="hover:text-luxury-gold transition-colors">Travel</a>
        <a href={`#${AppRoute.CULINARY}`} className="hover:text-luxury-gold transition-colors">Culinary</a>
        <a href={`#${AppRoute.AI_DESIGNER}`} className="hover:text-luxury-gold transition-colors">AI Designer</a>
        <a href={`#${AppRoute.RESERVATION}`} className="hover:text-luxury-gold transition-colors">Reservasi</a>
        {user?.role === 'admin' && (
          <a href={`#${AppRoute.ADMIN}`} className="text-luxury-gold font-bold">Admin Panel</a>
        )}
      </div>

      <div className="flex items-center space-x-4">
        {user ? (
          <div className="flex items-center space-x-4">
            <span className="text-xs text-gray-400">Halo, {user.name}</span>
            <button 
              onClick={onLogout}
              className="px-4 py-2 text-xs border border-luxury-gold/50 text-luxury-gold hover:bg-luxury-gold hover:text-black transition-all"
            >
              LOGOUT
            </button>
          </div>
        ) : (
          <div className="flex items-center space-x-3">
            <a href={`#${AppRoute.LOGIN}`} className="text-sm hover:text-luxury-gold transition-colors">Login</a>
            <a 
              href={`#${AppRoute.REGISTER}`} 
              className="px-5 py-2 bg-luxury-gold text-black text-sm font-bold rounded-sm hover:bg-yellow-600 transition-all"
            >
              DAFTAR
            </a>
          </div>
        )}
      </div>
    </nav>
  );
};

export default Navbar;
