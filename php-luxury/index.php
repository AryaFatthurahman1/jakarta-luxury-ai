<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jakarta Luxury AI - Travel & Culinary</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        luxury: {
                            gold: '#C5A059',
                            dark: '#0A0A0A',
                            card: '#161616',
                            text: '#E5E5E5'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #0A0A0A; color: #E5E5E5; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0A0A0A; }
        ::-webkit-scrollbar-thumb { background: #C5A059; border-radius: 4px; }
        .glass { background: rgba(22, 22, 22, 0.8); backdrop-filter: blur(10px); }
        .luxury-card { background: rgba(22, 22, 22, 0.9); border: 1px solid rgba(197, 160, 89, 0.2); }
    </style>
</head>
<body class="font-sans">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass border-b border-luxury-gold/20 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <a href="index.php" class="text-2xl font-serif font-bold tracking-tighter text-luxury-gold">
                    JAKARTA LUXURY AI
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-widest font-medium">
                <a href="#travel" class="hover:text-luxury-gold transition-colors">Travel</a>
                <a href="#culinary" class="hover:text-luxury-gold transition-colors">Culinary</a>
                <a href="#ai-designer" class="hover:text-luxury-gold transition-colors">AI Designer</a>
                <a href="reservations.php" class="hover:text-luxury-gold transition-colors">Reservasi</a>
                <a href="store.php" class="hover:text-luxury-gold transition-colors">Store</a>
            </div>

            <div class="flex items-center space-x-4">
                <?php if(isset($_SESSION['user'])): ?>
                    <span class="text-luxury-gold">Welcome, <?php echo $_SESSION['user']['name']; ?></span>
                    <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="bg-luxury-gold text-black px-4 py-2 rounded hover:bg-opacity-80">Login</a>
                    <a href="register.php" class="border border-luxury-gold text-luxury-gold px-4 py-2 rounded hover:bg-luxury-gold hover:text-black transition-colors">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&q=80&w=2000" alt="Jakarta Night" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-luxury-dark via-transparent to-luxury-dark/50"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl">
            <h1 class="text-5xl md:text-8xl font-serif mb-6 leading-tight">
                Eksplorasi <span class="text-luxury-gold">Jakarta</span> yang Tak Terlupakan
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300">
                Platform AI terdepan untuk desain travel dan culinary yang mewah di Jakarta
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#travel" class="bg-luxury-gold text-black px-8 py-4 rounded-lg font-semibold hover:bg-opacity-80 transition-colors">
                    Mulai Jelajah
                </a>
                <a href="#ai-designer" class="border border-luxury-gold text-luxury-gold px-8 py-4 rounded-lg font-semibold hover:bg-luxury-gold hover:text-black transition-colors">
                    AI Designer
                </a>
            </div>
        </div>
    </section>

    <!-- Travel Section -->
    <section id="travel" class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-serif mb-6">Luxury Travel Experiences</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Temukan pengalaman perjalanan eksklusif di Jakarta dengan sentuhan kemewahan dan kecanggihan AI
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="luxury-card p-8 rounded-xl hover:border-luxury-gold/40 transition-all">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=600" alt="Presidential Suite" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-2xl font-serif mb-4 text-luxury-gold">Presidential Suite Retreat</h3>
                    <p class="text-gray-300 mb-6">Pengalaman menginap di suite presiden dengan pemandangan kota Jakarta yang spektakuler</p>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-luxury-gold">Rp 25.000.000</span>
                        <a href="reservations.php?type=travel&id=1" class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">Reserve Now</a>
                    </div>
                </div>

                <div class="luxury-card p-8 rounded-xl hover:border-luxury-gold/40 transition-all">
                    <img src="https://images.unsplash.com/photo-1567891777981-ed9796861529?auto=format&fit=crop&q=80&w=600" alt="Yacht Experience" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-2xl font-serif mb-4 text-luxury-gold">Luxury Yacht Thousand Islands</h3>
                    <p class="text-gray-300 mb-6">Perjalanan yacht pribadi ke Kepulauan Seribu dengan layanan premium</p>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-luxury-gold">Rp 15.000.000</span>
                        <a href="reservations.php?type=travel&id=2" class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">Reserve Now</a>
                    </div>
                </div>

                <div class="luxury-card p-8 rounded-xl hover:border-luxury-gold/40 transition-all">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=600" alt="Helicopter Tour" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-2xl font-serif mb-4 text-luxury-gold">Jakarta Heli-Tour Skyline</h3>
                    <p class="text-gray-300 mb-6">Tur helikopter eksklusif menyusuri langit Jakarta dengan pemandangan kota</p>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-luxury-gold">Rp 8.000.000</span>
                        <a href="reservations.php?type=travel&id=3" class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">Reserve Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Culinary Section -->
    <section id="culinary" class="py-24 px-6 bg-luxury-card">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-serif mb-6">Signature Culinary Experiences</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Nikmati pengalaman kuliner mewah dengan cita rasa autentik Jakarta yang diperkaya teknologi AI
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="luxury-card p-8 rounded-xl hover:border-luxury-gold/40 transition-all">
                    <img src="https://picsum.photos/seed/food1/600/400" alt="Rijsttafel Fusion" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-2xl font-serif mb-4 text-luxury-gold">Rijsttafel Modern Fusion</h3>
                    <p class="text-gray-300 mb-6">Warisan kuliner Belanda-Indonesia dengan sentuhan kontemporer</p>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-luxury-gold">Rp 1.200.000</span>
                        <a href="reservations.php?type=culinary&id=1" class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">Reserve Now</a>
                    </div>
                </div>

                <div class="luxury-card p-8 rounded-xl hover:border-luxury-gold/40 transition-all">
                    <img src="https://picsum.photos/seed/food2/600/400" alt="Wagyu Beef" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-2xl font-serif mb-4 text-luxury-gold">Wagyu Beef Maranggi</h3>
                    <p class="text-gray-300 mb-6">Sate Maranggi khas Purwakarta dengan daging Wagyu A5</p>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-luxury-gold">Rp 950.000</span>
                        <a href="reservations.php?type=culinary&id=2" class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">Reserve Now</a>
                    </div>
                </div>

                <div class="luxury-card p-8 rounded-xl hover:border-luxury-gold/40 transition-all">
                    <img src="https://picsum.photos/seed/food3/600/400" alt="Truffle Nasi Goreng" class="w-full h-48 object-cover rounded-lg mb-6">
                    <h3 class="text-2xl font-serif mb-4 text-luxury-gold">Truffle Nasi Goreng</h3>
                    <p class="text-gray-300 mb-6">Nasi goreng aromatik dengan potongan Truffle Hitam segar</p>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold text-luxury-gold">Rp 650.000</span>
                        <a href="reservations.php?type=culinary&id=3" class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">Reserve Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Designer Section -->
    <section id="ai-designer" class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-serif mb-6">AI Interior Designer</h2>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Buat desain interior mewah untuk ruangan Anda dengan bantuan kecerdasan buatan terkini
                </p>
            </div>

            <div class="luxury-card p-12 rounded-xl text-center">
                <div class="max-w-2xl mx-auto">
                    <h3 class="text-3xl font-serif mb-8 text-luxury-gold">Design Your Dream Space</h3>
                    <p class="text-lg text-gray-300 mb-8">
                        Masukkan deskripsi ruangan Anda dan biarkan AI kami menciptakan desain interior yang sempurna
                    </p>
                    <a href="ai-designer.php" class="bg-luxury-gold text-black px-8 py-4 rounded-lg font-semibold text-lg hover:bg-opacity-80 transition-colors">
                        Start Designing
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black border-t border-luxury-gold/20 pt-20 pb-10 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-2 space-y-6">
                <h2 class="text-3xl font-serif font-bold tracking-tighter text-luxury-gold">
                    JAKARTA LUXURY AI
                </h2>
                <p class="text-gray-500 max-w-sm leading-relaxed text-sm">
                    Platform AI terdepan untuk eksplorasi travel dan culinary design di Jakarta. Menghadirkan kemewahan melalui teknologi mutakhir.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">Instagram</a>
                    <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">Facebook</a>
                    <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">Twitter</a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-6 text-luxury-gold">Services</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#travel" class="text-gray-400 hover:text-white transition-colors">Luxury Travel</a></li>
                    <li><a href="#culinary" class="text-gray-400 hover:text-white transition-colors">Culinary Experiences</a></li>
                    <li><a href="#ai-designer" class="text-gray-400 hover:text-white transition-colors">AI Designer</a></li>
                    <li><a href="reservations.php" class="text-gray-400 hover:text-white transition-colors">Reservations</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-6 text-luxury-gold">Contact</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li>📧 info@jakartaluxury.ai</li>
                    <li>📱 +62 812-3456-7890</li>
                    <li>📍 Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-[10px] text-gray-600 uppercase tracking-[0.2em]">
            <p>© 2025 JAKARTA LUXURY AI. ALL RIGHTS RESERVED.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-luxury-gold transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-luxury-gold transition-colors">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>