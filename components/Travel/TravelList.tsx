
import React from 'react';

const TravelList: React.FC = () => {
  const travelPackages = [
    { id: 1, name: 'Kota Tua Heritage Night', price: 'Rp 2.500.000', img: 'https://images.unsplash.com/photo-1541628171120-d3e91141e6ce?auto=format&fit=crop&q=80&w=800' },
    { id: 2, name: 'Luxury Yacht Thousand Islands', price: 'Rp 15.000.000', img: 'https://images.unsplash.com/photo-1567891777981-ed9796861529?auto=format&fit=crop&q=80&w=800' },
    { id: 3, name: 'Jakarta Heli-Tour Skyline', price: 'Rp 8.000.000', img: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=800' },
    { id: 4, name: 'Artistic Gallery Private Tour', price: 'Rp 3.200.000', img: 'https://images.unsplash.com/photo-1493333858332-93acc5d1f504?auto=format&fit=crop&q=80&w=800' },
    { id: 5, name: 'Presidential Suite Retreat', price: 'Rp 25.000.000', img: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800' },
    { id: 6, name: 'Golf Executive Experience', price: 'Rp 5.500.000', img: 'https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?auto=format&fit=crop&q=80&w=800' },
  ];

  return (
    <div className="py-20 px-6 max-w-7xl mx-auto">
      <div className="text-center mb-16">
        <h2 className="text-4xl md:text-5xl font-serif mb-4">Destinasi <span className="text-luxury-gold">Eksklusif</span></h2>
        <div className="w-24 h-1 bg-luxury-gold mx-auto mb-6"></div>
        <p className="text-gray-400 max-w-2xl mx-auto">Kami mengkurasi perjalanan terbaik di Jakarta, memastikan setiap detik adalah kemewahan yang tak terlupakan.</p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        {travelPackages.map(pkg => (
          <div key={pkg.id} className="group cursor-pointer">
            <div className="relative overflow-hidden mb-4 aspect-[4/5] rounded-lg">
              <img 
                src={pkg.img} 
                alt={pkg.name} 
                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
              />
              <div className="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
              <div className="absolute bottom-6 left-6">
                <span className="bg-luxury-gold text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-tighter">Limited Edition</span>
              </div>
            </div>
            <h3 className="text-xl font-serif mb-2 group-hover:text-luxury-gold transition-colors">{pkg.name}</h3>
            <p className="text-luxury-gold font-bold">{pkg.price}</p>
            <button className="mt-4 text-xs uppercase tracking-widest border-b border-white/20 pb-1 group-hover:border-luxury-gold transition-all">Lihat Detail</button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default TravelList;
