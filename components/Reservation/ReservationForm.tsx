
import React, { useState } from 'react';
import { User, Reservation } from '../../types';

interface ReservationFormProps {
  user: User | null;
}

const ReservationForm: React.FC<ReservationFormProps> = ({ user }) => {
  const [submitted, setSubmitted] = useState(false);
  const [formData, setFormData] = useState({
    name: user?.name || '',
    email: user?.email || '',
    phone: user?.phone || '',
    address: '',
    date: '',
    time: '',
    peopleCount: 2,
    packageType: 'Culinary Experience',
    notes: ''
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    
    const newReservation: Reservation = {
      id: Math.random().toString(36).substr(2, 9),
      userId: user?.id || 'guest',
      name: formData.name,
      address: formData.address,
      date: formData.date,
      time: formData.time,
      peopleCount: formData.peopleCount,
      packageType: formData.packageType,
      status: 'pending'
    };

    // Save to local storage mock DB
    const reservationsJson = localStorage.getItem('luxury_db_reservations');
    const reservations: Reservation[] = reservationsJson ? JSON.parse(reservationsJson) : [];
    reservations.push(newReservation);
    localStorage.setItem('luxury_db_reservations', JSON.stringify(reservations));

    setSubmitted(true);
  };

  if (submitted) {
    return (
      <div className="py-40 px-6 text-center max-w-2xl mx-auto">
        <div className="text-6xl mb-6">✨</div>
        <h2 className="text-4xl font-serif mb-4">Reservasi Berhasil</h2>
        <p className="text-gray-400 mb-8">Terima kasih {formData.name}, tim konserje kami akan menghubungi Anda dalam waktu kurang dari 24 jam untuk konfirmasi akhir.</p>
        <button 
          onClick={() => setSubmitted(false)}
          className="px-10 py-4 bg-luxury-gold text-black font-bold uppercase tracking-widest"
        >
          Buat Reservasi Lain
        </button>
      </div>
    );
  }

  return (
    <div className="py-20 px-6 max-w-4xl mx-auto">
      <div className="mb-12 text-center">
        <h2 className="text-4xl font-serif mb-2">Buat <span className="text-luxury-gold">Reservasi</span></h2>
        <p className="text-gray-500 uppercase tracking-widest text-xs">Pengalaman Tak Terlupakan Menanti</p>
      </div>

      <form onSubmit={handleSubmit} className="bg-luxury-card p-10 rounded-lg border border-white/10 shadow-xl space-y-6">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-xs uppercase tracking-widest text-gray-400">Nama Pemesan</label>
            <input 
              required
              type="text" 
              placeholder="Masukkan nama lengkap Anda"
              value={formData.name}
              onChange={(e: React.ChangeEvent<HTMLInputElement>) => setFormData({...formData, name: e.target.value})}
              className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all"
            />
          </div>
          <div className="space-y-2">
            <label className="text-xs uppercase tracking-widest text-gray-400">Nomor Telepon</label>
            <input 
              required
              type="tel" 
              placeholder="Contoh: +62 812-3456-7890"
              value={formData.phone}
              onChange={(e: React.ChangeEvent<HTMLInputElement>) => setFormData({...formData, phone: e.target.value})}
              className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all"
            />
          </div>
        </div>

        <div className="space-y-2">
          <label className="text-xs uppercase tracking-widest text-gray-400">Alamat Penjemputan / Pengantaran</label>
          <input 
            required
            type="text" 
            placeholder="Misal: Menteng, Jakarta Pusat"
            value={formData.address}
            onChange={(e: React.ChangeEvent<HTMLInputElement>) => setFormData({...formData, address: e.target.value})}
            className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all"
          />
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="space-y-2">
            <label className="text-xs uppercase tracking-widest text-gray-400">Pilih Paket</label>
            <select 
              title="Pilih jenis paket layanan"
              value={formData.packageType}
              onChange={(e: React.ChangeEvent<HTMLSelectElement>) => setFormData({...formData, packageType: e.target.value})}
              className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all appearance-none"
            >
              <option>Culinary Experience</option>
              <option>Travel & Tour</option>
              <option>Full VIP Package</option>
              <option>Custom AI Design</option>
            </select>
          </div>
          <div className="space-y-2">
            <label className="text-xs uppercase tracking-widest text-gray-400">Tanggal</label>
            <input 
              required
              type="date" 
              placeholder="Pilih tanggal"
              value={formData.date}
              onChange={(e: React.ChangeEvent<HTMLInputElement>) => setFormData({...formData, date: e.target.value})}
              className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all"
            />
          </div>
          <div className="space-y-2">
            <label className="text-xs uppercase tracking-widest text-gray-400">Waktu</label>
            <input 
              required
              type="time" 
              placeholder="Pilih waktu"
              value={formData.time}
              onChange={(e: React.ChangeEvent<HTMLInputElement>) => setFormData({...formData, time: e.target.value})}
              className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all"
            />
          </div>
        </div>

        <div className="space-y-2">
          <label className="text-xs uppercase tracking-widest text-gray-400">Catatan Tambahan (Opsional)</label>
          <textarea 
            rows={4}
            value={formData.notes}
            onChange={(e: React.ChangeEvent<HTMLTextAreaElement>) => setFormData({...formData, notes: e.target.value})}
            className="w-full bg-black border border-white/10 p-4 focus:border-luxury-gold outline-none text-sm transition-all"
            placeholder="Alergi makanan, kebutuhan khusus, dll..."
          ></textarea>
        </div>

        {!user && (
          <p className="text-xs text-yellow-500/80 italic text-center">Anda sedang memesan sebagai tamu. Login untuk menyimpan riwayat reservasi Anda.</p>
        )}

        <button 
          type="submit"
          className="w-full py-5 bg-luxury-gold text-black font-bold uppercase tracking-[0.3em] hover:bg-yellow-600 transition-all rounded-sm shadow-lg"
        >
          Konfirmasi Reservasi
        </button>
      </form>
    </div>
  );
};

export default ReservationForm;
