
import React, { useState, useEffect } from 'react';
import { User, AppRoute } from './types';
import Navbar from './components/Navbar';
import Home from './components/Home';
import Login from './components/Auth/Login';
import Register from './components/Auth/Register';
import TravelList from './components/Travel/TravelList';
import FoodMenu from './components/Culinary/FoodMenu';
import ReservationForm from './components/Reservation/ReservationForm';
import AdminDashboard from './components/Admin/AdminDashboard';
import AiDesigner from './components/AI/AiDesigner';
import Footer from './components/Footer';

const App: React.FC = () => {
  const [currentUser, setCurrentUser] = useState<User | null>(null);
  const [currentRoute, setCurrentRoute] = useState<AppRoute>(AppRoute.HOME);

  useEffect(() => {
    const savedUser = localStorage.getItem('luxury_user');
    if (savedUser) {
      setCurrentUser(JSON.parse(savedUser));
    }

    const handleHashChange = () => {
      const hash = window.location.hash.replace('#', '') as AppRoute;
      if (Object.values(AppRoute).includes(hash)) {
        setCurrentRoute(hash);
      } else {
        setCurrentRoute(AppRoute.HOME);
      }
    };

    window.addEventListener('hashchange', handleHashChange);
    handleHashChange();

    return () => window.removeEventListener('hashchange', handleHashChange);
  }, []);

  const handleLogin = (user: User) => {
    setCurrentUser(user);
    localStorage.setItem('luxury_user', JSON.stringify(user));
    window.location.hash = AppRoute.HOME;
  };

  const handleLogout = () => {
    setCurrentUser(null);
    localStorage.removeItem('luxury_user');
    window.location.hash = AppRoute.HOME;
  };

  const renderContent = () => {
    switch (currentRoute) {
      case AppRoute.LOGIN:
        return <Login onLogin={handleLogin} />;
      case AppRoute.REGISTER:
        return <Register onLogin={handleLogin} />;
      case AppRoute.TRAVEL:
        return <TravelList />;
      case AppRoute.CULINARY:
        return <FoodMenu />;
      case AppRoute.RESERVATION:
        return <ReservationForm user={currentUser} />;
      case AppRoute.ADMIN:
        return currentUser?.role === 'admin' ? <AdminDashboard /> : <div className="p-20 text-center">Akses Ditolak</div>;
      case AppRoute.AI_DESIGNER:
        return <AiDesigner />;
      case AppRoute.HOME:
      default:
        return <Home />;
    }
  };

  return (
    <div className="min-h-screen flex flex-col font-sans text-luxury-text bg-luxury-dark selection:bg-luxury-gold selection:text-white">
      <Navbar user={currentUser} onLogout={handleLogout} />
      <main className="flex-grow">
        {renderContent()}
      </main>
      <Footer />
    </div>
  );
};

export default App;
