
import React from 'react';
import { AppRoute } from '../types';

const Home: React.FC = () => {
  return (
    <div className="flex flex-col">
      {/* Hero Section */}
      <section className="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div className="absolute inset-0 z-0">
          <img 
            src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&q=80&w=2000" 
            alt="Jakarta Night" 
            className="w-full h-full object-cover opacity-40"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-luxury-dark via-transparent to-luxury-dark/50"></div>
        </div>

        <div className="relative z-10 text-center px-4 max-w-4xl">
          <h1 className="text-5xl md:text-8xl font-serif mb-6 leading-tight">
            Eksplorasi <span className="text-luxury-gold">Kemewahan</span> Jakarta
          </h1>
          <p className="text-lg md:text-xl text-gray-400 mb-10 font-light max-w-2xl mx-auto leading-relaxed">
            Perjalanan eksklusif dan desain kuliner mutakhir. Rasakan pengalaman Jakarta yang belum pernah Anda bayangkan sebelumnya.
          </p>
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href={`#${AppRoute.TRAVEL}`} className="w-full sm:w-auto px-10 py-4 bg-luxury-gold text-black font-bold tracking-widest hover:bg-yellow-600 transition-all">
              JELAJAHI TRAVEL
            </a>
            <a href={`#${AppRoute.RESERVATION}`} className="w-full sm:w-auto px-10 py-4 border border-white/20 hover:border-luxury-gold transition-all tracking-widest uppercase text-sm">
              BUAT RESERVASI
            </a>
          </div>
        </div>
      </section>

      {/* Culinary Design Preview */}
      <section className="py-24 bg-luxury-card px-6">
        <div className="max-w-7xl mx-auto">
          <div className="flex flex-col md:flex-row items-center gap-16">
            <div className="flex-1 space-y-8">
              <h2 className="text-4xl md:text-5xl font-serif">Desain Kuliner & <span className="text-luxury-gold italic">Interior</span></h2>
              <p className="text-gray-400 leading-relaxed text-lg">
                Kami tidak hanya menyajikan makanan; kami menciptakan atmosfer. Dari interior bergaya Parisian hingga modernism minimalis di jantung Jakarta, setiap hidangan adalah karya seni.
              </p>
              <div className="grid grid-cols-2 gap-4">
                <div className="p-4 border border-luxury-gold/20 rounded-lg">
                  <h3 className="text-luxury-gold text-2xl font-serif mb-2">50+</h3>
                  <p className="text-xs uppercase tracking-widest">Restoran Mewah</p>
                </div>
                <div className="p-4 border border-luxury-gold/20 rounded-lg">
                  <h3 className="text-luxury-gold text-2xl font-serif mb-2">Exclusive</h3>
                  <p className="text-xs uppercase tracking-widest">Chef Internasional</p>
                </div>
              </div>
            </div>
            <div className="flex-1 grid grid-cols-2 gap-4">
              <img src="https://picsum.photos/seed/cul1/600/800" className="rounded-xl object-cover h-96 w-full" alt="Luxury Interior" />
              <img src="https://picsum.photos/seed/food1/600/800" className="rounded-xl object-cover h-96 mt-12 w-full" alt="Fine Dining" />
            </div>
          </div>
        </div>
      </section>

      {/* AI Travel Guide Section */}
      <section className="py-24 px-6 relative overflow-hidden">
        <div className="max-w-7xl mx-auto text-center">
          <span className="text-luxury-gold uppercase tracking-[0.5em] text-xs font-bold mb-4 block">Powered by Gemini AI</span>
          <h2 className="text-4xl md:text-6xl font-serif mb-12">Travel Guide yang <span className="underline decoration-luxury-gold underline-offset-8">Cerdas</span></h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {[
              { title: 'Personalized Trips', desc: 'Rencana perjalanan yang disesuaikan dengan gaya hidup Anda menggunakan AI.', icon: '✨' },
              { title: 'Real-time Updates', desc: 'Dapatkan informasi terkini tentang destinasi terpopuler di Jakarta.', icon: '📍' },
              { title: 'Smart Concierge', desc: 'Layanan suara 24/7 untuk segala kebutuhan reservasi Anda.', icon: '🎧' },
            ].map((feature, idx) => (
              <div key={idx} className="p-10 bg-white/5 border border-white/10 hover:border-luxury-gold/50 transition-all rounded-2xl group text-center">
                <div className="text-4xl mb-6 group-hover:scale-110 transition-transform">{feature.icon}</div>
                <h3 className="text-xl font-bold mb-4">{feature.title}</h3>
                <p className="text-gray-400 text-sm leading-relaxed">{feature.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;
