
import React from 'react';

const FoodMenu: React.FC = () => {
  const menuItems = [
    { name: 'Rijsttafel Modern Fusion', desc: 'Warisan kuliner Belanda-Indonesia dengan sentuhan kontemporer.', price: 'Rp 1.200.000', img: 'https://picsum.photos/seed/food1/600/600' },
    { name: 'Wagyu Beef Maranggi', desc: 'Sate Maranggi khas Purwakarta dengan daging Wagyu A5.', price: 'Rp 950.000', img: 'https://picsum.photos/seed/food2/600/600' },
    { name: 'Truffle Nasi Goreng', desc: 'Nasi goreng aromatik dengan potongan Truffle Hitam segar.', price: 'Rp 650.000', img: 'https://picsum.photos/seed/food3/600/600' },
    { name: 'Lobster Laksa Jakarta', desc: 'Mie laksa kaya rempah dengan topping lobster laut selatan.', price: 'Rp 880.000', img: 'https://picsum.photos/seed/food4/600/600' },
    { name: 'Kerapu Bakar Jimbaran Style', desc: 'Ikan kerapu segar dibakar dengan bumbu Bali eksklusif.', price: 'Rp 720.000', img: 'https://picsum.photos/seed/food5/600/600' },
    { name: 'Gado-Gado Deconstructed', desc: 'Interpretasi artistik dari salad sayur klasik Jakarta.', price: 'Rp 450.000', img: 'https://picsum.photos/seed/food6/600/600' },
  ];

  return (
    <div className="py-20 px-6 max-w-7xl mx-auto">
      <div className="text-center mb-16">
        <h2 className="text-4xl md:text-5xl font-serif mb-4">Mahakarya <span className="text-luxury-gold">Kuliner</span></h2>
        <p className="text-gray-400">Setiap gigitan adalah perjalanan rasa yang mendalam.</p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
        {menuItems.map((item, idx) => (
          <div key={idx} className="flex flex-col sm:flex-row gap-6 items-start p-6 bg-luxury-card rounded-lg border border-white/5 hover:border-luxury-gold/30 transition-all">
            <img src={item.img} alt={item.name} className="w-full sm:w-32 h-32 object-cover rounded-md" />
            <div className="flex-grow">
              <div className="flex justify-between items-start mb-2">
                <h3 className="text-xl font-serif">{item.name}</h3>
                <span className="text-luxury-gold font-bold text-sm">{item.price}</span>
              </div>
              <p className="text-gray-500 text-sm leading-relaxed mb-4">{item.desc}</p>
              <button className="px-4 py-2 border border-luxury-gold/30 text-[10px] uppercase font-bold tracking-widest hover:bg-luxury-gold hover:text-black transition-all">Pesan Sekarang</button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default FoodMenu;
