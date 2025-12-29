
import React, { useState, useEffect } from 'react';
import { Reservation, User, Product } from '../../types';

const AdminDashboard: React.FC = () => {
  const [reservations, setReservations] = useState<Reservation[]>([]);
  const [users, setUsers] = useState<User[]>([]);
  const [products, setProducts] = useState<Product[]>([]);
  const [activeTab, setActiveTab] = useState<'reservations' | 'users' | 'goods'>('reservations');

  useEffect(() => {
    // Load data from mock DB
    const res = localStorage.getItem('luxury_db_reservations');
    const u = localStorage.getItem('luxury_db_users');
    const p = localStorage.getItem('luxury_db_products');
    
    if (res) setReservations(JSON.parse(res));
    if (u) setUsers(JSON.parse(u));
    if (p) setProducts(JSON.parse(p));
  }, []);

  const updateStatus = (id: string, status: Reservation['status']) => {
    const updated = reservations.map(r => r.id === id ? { ...r, status } : r);
    setReservations(updated);
    localStorage.setItem('luxury_db_reservations', JSON.stringify(updated));
  };

  return (
    <div className="p-8 max-w-7xl mx-auto">
      <div className="flex justify-between items-center mb-10">
        <h1 className="text-3xl font-serif">Admin <span className="text-luxury-gold">Dashboard</span></h1>
        <div className="flex bg-luxury-card p-1 rounded-lg border border-white/10">
          <button 
            onClick={() => setActiveTab('reservations')}
            className={`px-6 py-2 rounded-md text-xs uppercase tracking-widest font-bold transition-all ${activeTab === 'reservations' ? 'bg-luxury-gold text-black' : 'text-gray-400 hover:text-white'}`}
          >
            Reservasi
          </button>
          <button 
            onClick={() => setActiveTab('users')}
            className={`px-6 py-2 rounded-md text-xs uppercase tracking-widest font-bold transition-all ${activeTab === 'users' ? 'bg-luxury-gold text-black' : 'text-gray-400 hover:text-white'}`}
          >
            Pelanggan
          </button>
          <button 
            onClick={() => setActiveTab('goods')}
            className={`px-6 py-2 rounded-md text-xs uppercase tracking-widest font-bold transition-all ${activeTab === 'goods' ? 'bg-luxury-gold text-black' : 'text-gray-400 hover:text-white'}`}
          >
            Inventori
          </button>
        </div>
      </div>

      <div className="bg-luxury-card border border-white/10 rounded-xl overflow-hidden shadow-2xl">
        {activeTab === 'reservations' && (
          <table className="w-full text-left text-sm">
            <thead className="bg-black/40 text-luxury-gold uppercase text-[10px] tracking-widest border-b border-white/10">
              <tr>
                <th className="p-5">Nama</th>
                <th className="p-5">Paket</th>
                <th className="p-5">Tanggal & Waktu</th>
                <th className="p-5">Status</th>
                <th className="p-5">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/5">
              {reservations.length > 0 ? reservations.map((res) => (
                <tr key={res.id} className="hover:bg-white/5 transition-colors">
                  <td className="p-5">
                    <div className="font-bold">{res.name}</div>
                    <div className="text-[10px] text-gray-500">{res.address}</div>
                  </td>
                  <td className="p-5">
                    <span className="bg-white/10 px-2 py-1 rounded text-xs">{res.packageType}</span>
                  </td>
                  <td className="p-5">
                    <div>{res.date}</div>
                    <div className="text-[10px] text-gray-500">{res.time}</div>
                  </td>
                  <td className="p-5">
                    <span className={`px-2 py-1 rounded-full text-[10px] font-bold uppercase ${
                      res.status === 'confirmed' ? 'bg-green-900/40 text-green-400 border border-green-500/20' : 
                      res.status === 'pending' ? 'bg-yellow-900/40 text-yellow-400 border border-yellow-500/20' : 
                      'bg-red-900/40 text-red-400 border border-red-500/20'
                    }`}>
                      {res.status}
                    </span>
                  </td>
                  <td className="p-5">
                    <div className="flex space-x-2">
                      <button onClick={() => updateStatus(res.id, 'confirmed')} className="p-2 bg-green-900/20 text-green-500 hover:bg-green-900/40 rounded transition-all">✓</button>
                      <button onClick={() => updateStatus(res.id, 'cancelled')} className="p-2 bg-red-900/20 text-red-500 hover:bg-red-900/40 rounded transition-all">✕</button>
                    </div>
                  </td>
                </tr>
              )) : (
                <tr>
                  <td colSpan={5} className="p-20 text-center text-gray-600 italic">Belum ada reservasi masuk.</td>
                </tr>
              )}
            </tbody>
          </table>
        )}

        {activeTab === 'users' && (
          <div className="p-20 text-center">
             <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
               {users.map(u => (
                 <div key={u.id} className="p-6 border border-white/5 bg-black/20 rounded-lg">
                    <h3 className="font-serif text-lg mb-1">{u.name}</h3>
                    <p className="text-gray-500 text-xs mb-3">{u.email}</p>
                    <div className="flex justify-between items-center pt-3 border-t border-white/10">
                      <span className="text-luxury-gold text-xs font-bold">{u.phone}</span>
                      <span className="text-[10px] uppercase bg-white/10 px-2 py-1 rounded">{u.role}</span>
                    </div>
                 </div>
               ))}
             </div>
          </div>
        )}

        {activeTab === 'goods' && (
          <div className="p-10">
            <div className="flex justify-between mb-8">
              <h2 className="text-xl font-serif">Katalog Barang & Paket</h2>
              <button className="bg-luxury-gold text-black px-6 py-2 text-xs font-bold uppercase tracking-widest rounded shadow-lg">Tambah Baru</button>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
              {[1, 2, 3, 4].map(i => (
                <div key={i} className="bg-black/30 border border-white/10 rounded-lg overflow-hidden group">
                  <div className="h-40 bg-gray-900 relative">
                    <img src={`https://picsum.photos/seed/item${i}/400/300`} className="w-full h-full object-cover group-hover:scale-110 transition-transform" alt="Product" />
                  </div>
                  <div className="p-4">
                    <h4 className="text-sm font-bold mb-1">Paket Wisata Luxury {i}</h4>
                    <p className="text-luxury-gold font-serif mb-3">Rp 10.000.000</p>
                    <div className="flex space-x-2">
                      <button className="flex-1 py-2 bg-white/10 hover:bg-white/20 text-[10px] uppercase tracking-widest font-bold">Edit</button>
                      <button className="flex-1 py-2 bg-red-900/20 hover:bg-red-900/30 text-red-500 text-[10px] uppercase tracking-widest font-bold">Hapus</button>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default AdminDashboard;
