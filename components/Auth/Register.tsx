
import React, { useState } from 'react';
import { User, AppRoute } from '../../types';

interface RegisterProps {
  onLogin: (user: User) => void;
}

const Register: React.FC<RegisterProps> = ({ onLogin }) => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    password: '',
    confirmPassword: ''
  });
  const [error, setError] = useState('');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError('');

    if (formData.password !== formData.confirmPassword) {
      setError('Password tidak cocok.');
      return;
    }

    const newUser: User = {
      id: Date.now().toString(),
      name: formData.name,
      email: formData.email,
      phone: formData.phone,
      role: 'customer'
    };

    // Save to mock DB
    const usersJson = localStorage.getItem('luxury_db_users');
    const users: User[] = usersJson ? JSON.parse(usersJson) : [];
    
    if (users.some(u => u.email === formData.email)) {
      setError('Email sudah terdaftar.');
      return;
    }

    users.push(newUser);
    localStorage.setItem('luxury_db_users', JSON.stringify(users));
    
    onLogin(newUser);
  };

  return (
    <div className="min-h-[90vh] flex items-center justify-center px-6 py-12">
      <div className="w-full max-w-lg bg-luxury-card p-10 border border-luxury-gold/20 rounded-lg shadow-2xl">
        <h2 className="text-3xl font-serif text-center mb-8">Daftar Akun <span className="text-luxury-gold">Baru</span></h2>
        
        {error && <div className="mb-4 p-3 bg-red-900/20 border border-red-500 text-red-400 text-xs rounded">{error}</div>}

        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nama Lengkap</label>
              <input 
                type="text" 
                required
                value={formData.name}
                onChange={(e) => setFormData({...formData, name: e.target.value})}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="Kayla Ariellia"
              />
            </div>
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nomor Telepon</label>
              <input 
                type="tel" 
                required
                value={formData.phone}
                onChange={(e) => setFormData({...formData, phone: e.target.value})}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="0812..."
              />
            </div>
          </div>
          <div>
            <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Alamat Email</label>
            <input 
              type="email" 
              required
              value={formData.email}
              onChange={(e) => setFormData({...formData, email: e.target.value})}
              className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
              placeholder="nama@email.com"
            />
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Password</label>
              <input 
                type="password" 
                required
                value={formData.password}
                onChange={(e) => setFormData({...formData, password: e.target.value})}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="••••••••"
              />
            </div>
            <div>
              <label className="block text-xs uppercase tracking-widest text-gray-500 mb-2">Ulangi Password</label>
              <input 
                type="password" 
                required
                value={formData.confirmPassword}
                onChange={(e) => setFormData({...formData, confirmPassword: e.target.value})}
                className="w-full bg-black border border-white/10 p-3 text-sm focus:border-luxury-gold outline-none transition-all"
                placeholder="••••••••"
              />
            </div>
          </div>
          <button 
            type="submit"
            className="w-full py-4 bg-luxury-gold text-black font-bold tracking-widest hover:bg-yellow-600 transition-all rounded-sm uppercase text-xs mt-4"
          >
            Daftar Sekarang
          </button>
        </form>

        <p className="mt-8 text-center text-xs text-gray-500">
          Sudah memiliki akun? <a href={`#${AppRoute.LOGIN}`} className="text-luxury-gold hover:underline">Masuk disini</a>
        </p>
      </div>
    </div>
  );
};

export default Register;
