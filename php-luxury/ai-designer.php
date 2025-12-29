
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Designer - Jakarta Luxury AI</title>
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
    <?php
    session_start();
    include 'config.php';
    ?>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass border-b border-luxury-gold/20 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <a href="index.php" class="text-2xl font-serif font-bold tracking-tighter text-luxury-gold">
                    JAKARTA LUXURY AI
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-widest font-medium">
                <a href="index.php#travel" class="hover:text-luxury-gold transition-colors">Travel</a>
                <a href="index.php#culinary" class="hover:text-luxury-gold transition-colors">Culinary</a>
                <a href="ai-designer.php" class="text-luxury-gold">AI Designer</a>
                <a href="reservations.php" class="hover:text-luxury-gold transition-colors">Reservasi</a>
                <a href="store.php" class="hover:text-luxury-gold transition-colors">Store</a>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="admin.php" class="hover:text-luxury-gold transition-colors">Admin</a>
                <?php endif; ?>
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

    <div class="py-20 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-serif mb-6 text-luxury-gold">AI Interior Designer</h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Buat desain interior mewah untuk ruangan Anda dengan bantuan kecerdasan buatan terkini
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Design Form -->
            <div class="luxury-card p-8 rounded-xl">
                <h2 class="text-2xl font-serif mb-6 text-luxury-gold">Design Your Space</h2>

                <?php if(isset($_SESSION['design_success'])): ?>
                    <div class="bg-green-600 text-white p-3 rounded mb-6"><?php echo $_SESSION['design_success']; unset($_SESSION['design_success']); ?></div>
                <?php endif; ?>

                <form action="design_process.php" method="POST" class="space-y-6">
                    <div>
                        <label for="room_type" class="block text-sm font-medium mb-2">Room Type</label>
                        <select id="room_type" name="room_type" required
                                class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                            <option value="">Select Room Type</option>
                            <option value="living_room">Living Room</option>
                            <option value="bedroom">Bedroom</option>
                            <option value="dining_room">Dining Room</option>
                            <option value="office">Office</option>
                            <option value="kitchen">Kitchen</option>
                            <option value="bathroom">Bathroom</option>
                        </select>
                    </div>

                    <div>
                        <label for="style" class="block text-sm font-medium mb-2">Design Style</label>
                        <select id="style" name="style" required
                                class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                            <option value="">Select Style</option>
                            <option value="modern">Modern Luxury</option>
                            <option value="traditional">Traditional Luxury</option>
                            <option value="minimalist">Minimalist Luxury</option>
                            <option value="industrial">Industrial Luxury</option>
                            <option value="bohemian">Bohemian Luxury</option>
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium mb-2">Room Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Describe your room and design preferences..."
                                  class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white"></textarea>
                    </div>

                    <div>
                        <label for="budget" class="block text-sm font-medium mb-2">Budget Range</label>
                        <select id="budget" name="budget"
                                class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                            <option value="">Select Budget</option>
                            <option value="under_50m">Under Rp 50 Million</option>
                            <option value="50m_100m">Rp 50M - 100M</option>
                            <option value="100m_200m">Rp 100M - 200M</option>
                            <option value="over_200m">Over Rp 200 Million</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-luxury-gold text-black py-3 rounded-lg font-semibold hover:bg-opacity-80 transition-colors">
                        Generate Design
                    </button>
                </form>
            </div>

            <!-- Design Preview -->
            <div class="luxury-card p-8 rounded-xl">
                <h2 class="text-2xl font-serif mb-6 text-luxury-gold">Design Preview</h2>

                <div id="designPreview" class="space-y-6">
                    <div class="text-center py-12 text-gray-400">
                        <div class="text-6xl mb-4">🎨</div>
                        <p>Fill out the form to generate your AI design</p>
                    </div>
                </div>

                <!-- Sample Designs -->
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="aspect-square bg-luxury-dark rounded-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&q=80&w=300" alt="Modern Living Room" class="w-full h-full object-cover">
                    </div>
                    <div class="aspect-square bg-luxury-dark rounded-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&q=80&w=300" alt="Luxury Bedroom" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="mt-20 luxury-card p-12 rounded-xl text-center">
            <h2 class="text-3xl font-serif mb-8 text-luxury-gold">Why Choose Our AI Designer?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="text-4xl mb-4">🤖</div>
                    <h3 class="text-xl font-semibold mb-2">Advanced AI Technology</h3>
                    <p class="text-gray-400">Powered by cutting-edge AI algorithms for stunning, personalized designs</p>
                </div>
                <div>
                    <div class="text-4xl mb-4">💎</div>
                    <h3 class="text-xl font-semibold mb-2">Luxury Focus</h3>
                    <p class="text-gray-400">Every design incorporates premium materials and luxury aesthetics</p>
                </div>
                <div>
                    <div class="text-4xl mb-4">⚡</div>
                    <h3 class="text-xl font-semibold mb-2">Instant Results</h3>
                    <p class="text-gray-400">Get professional design concepts in minutes, not days</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulate design generation
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const preview = document.getElementById('designPreview');
            preview.innerHTML = `
                <div class="text-center">
                    <div class="animate-spin text-4xl mb-4">⏳</div>
                    <p class="text-luxury-gold">Generating your luxury design...</p>
                </div>
            `;

            setTimeout(() => {
                preview.innerHTML = `
                    <div class="space-y-4">
                        <div class="aspect-video bg-luxury-dark rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&q=80&w=600" alt="Generated Design" class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-luxury-gold mb-2">Your Luxury Design</h3>
                            <p class="text-gray-300">This is a preview of your AI-generated design. Contact us for full implementation.</p>
                            <button onclick="bookConsultation()" class="mt-4 bg-luxury-gold text-black px-6 py-2 rounded hover:bg-opacity-80">
                                Book Consultation
                            </button>
                        </div>
                    </div>
                `;
            }, 3000);
        });

        function bookConsultation() {
            window.location.href = 'reservations.php';
        }
    </script>

    <?php $conn->close(); ?>
</body>
</html>