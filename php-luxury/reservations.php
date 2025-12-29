<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - Jakarta Luxury AI</title>
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

    // Redirect if not logged in
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }

    $user = $_SESSION['user'];
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
                <a href="ai-designer.php" class="hover:text-luxury-gold transition-colors">AI Designer</a>
                <a href="reservations.php" class="text-luxury-gold">Reservasi</a>
                <a href="store.php" class="hover:text-luxury-gold transition-colors">Store</a>
                <?php if($user['role'] === 'admin'): ?>
                <a href="admin.php" class="hover:text-luxury-gold transition-colors">Admin</a>
                <?php endif; ?>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-luxury-gold">Welcome, <?php echo $user['name']; ?></span>
                <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a>
            </div>
        </div>
    </nav>

    <div class="py-12 px-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-luxury-gold">My Reservations</h1>
            <a href="#book" class="bg-luxury-gold text-black px-6 py-2 rounded hover:bg-opacity-80">New Reservation</a>
        </div>

        <?php
        // Get user's reservations
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $user['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <?php if($result->num_rows > 0): ?>
            <div class="grid gap-6">
                <?php while($reservation = $result->fetch_assoc()): ?>
                    <div class="luxury-card p-6 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-semibold text-luxury-gold mb-2"><?php echo ucfirst($reservation['type']); ?>: <?php echo $reservation['name']; ?></h3>
                                <p class="text-gray-300 mb-2"><?php echo $reservation['details']; ?></p>
                                <p class="text-sm text-gray-400">Date: <?php echo $reservation['date']; ?> | Quantity: <?php echo $reservation['quantity']; ?> | Price: Rp <?php echo number_format($reservation['price'], 0, ',', '.'); ?></p>
                                <span class="inline-block px-3 py-1 rounded text-sm <?php
                                    if($reservation['status'] === 'confirmed') echo 'bg-green-600';
                                    elseif($reservation['status'] === 'pending') echo 'bg-yellow-600';
                                    else echo 'bg-red-600';
                                ?>">
                                    <?php echo ucfirst($reservation['status']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-xl text-gray-400 mb-4">No reservations found.</p>
                <a href="#book" class="bg-luxury-gold text-black px-6 py-2 rounded hover:bg-opacity-80">Create Your First Reservation</a>
            </div>
        <?php endif; ?>

        <!-- Booking Form -->
        <div id="book" class="mt-16 luxury-card p-8 rounded-xl">
            <h2 class="text-3xl font-serif mb-8 text-luxury-gold text-center">Book Your Experience</h2>

            <?php
            if(isset($_SESSION['booking_error'])) {
                echo '<div class="bg-red-600 text-white p-3 rounded mb-6">'.$_SESSION['booking_error'].'</div>';
                unset($_SESSION['booking_error']);
            }
            if(isset($_SESSION['booking_success'])) {
                echo '<div class="bg-green-600 text-white p-3 rounded mb-6">'.$_SESSION['booking_success'].'</div>';
                unset($_SESSION['booking_success']);
            }
            ?>

            <form action="book_process.php" method="POST" class="max-w-2xl mx-auto space-y-6">
                <div>
                    <label for="type" class="block text-sm font-medium mb-2">Experience Type</label>
                    <select id="type" name="type" required class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                        <option value="">Select Type</option>
                        <option value="travel">Travel Experience</option>
                        <option value="culinary">Culinary Experience</option>
                        <option value="ai_design">AI Design Consultation</option>
                    </select>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium mb-2">Service Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                </div>

                <div>
                    <label for="details" class="block text-sm font-medium mb-2">Details</label>
                    <textarea id="details" name="details" rows="3"
                              class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-sm font-medium mb-2">Date</label>
                        <input type="date" id="date" name="date"
                               class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium mb-2">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                               class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                    </div>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium mb-2">Price (Rp)</label>
                    <input type="number" id="price" name="price" required
                           class="w-full px-4 py-3 bg-luxury-dark border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                </div>

                <button type="submit" class="w-full bg-luxury-gold text-black py-3 rounded-lg font-semibold hover:bg-opacity-80 transition-colors">
                    Book Now
                </button>
            </form>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>