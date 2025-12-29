<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Jakarta Luxury AI</title>
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

    // Check if admin
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: login.php');
        exit;
    }
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
                <a href="reservations.php" class="hover:text-luxury-gold transition-colors">Reservasi</a>
                <a href="store.php" class="hover:text-luxury-gold transition-colors">Store</a>
                <a href="admin.php" class="text-luxury-gold">Admin</a>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-luxury-gold">Admin: <?php echo $_SESSION['user']['name']; ?></span>
                <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a>
            </div>
        </div>
    </nav>

    <div class="py-12 px-6 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-luxury-gold mb-8">Admin Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <?php
            // Get stats
            $user_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
            $reservation_count = $conn->query("SELECT COUNT(*) as count FROM reservations")->fetch_assoc()['count'];
            $pending_count = $conn->query("SELECT COUNT(*) as count FROM reservations WHERE status = 'pending'")->fetch_assoc()['count'];
            $total_revenue = $conn->query("SELECT SUM(price) as total FROM reservations WHERE status = 'confirmed'")->fetch_assoc()['total'] ?? 0;
            ?>

            <div class="luxury-card p-6 rounded-xl text-center">
                <div class="text-3xl mb-2">👥</div>
                <div class="text-2xl font-bold text-luxury-gold"><?php echo $user_count; ?></div>
                <div class="text-gray-400">Total Users</div>
            </div>

            <div class="luxury-card p-6 rounded-xl text-center">
                <div class="text-3xl mb-2">📋</div>
                <div class="text-2xl font-bold text-luxury-gold"><?php echo $reservation_count; ?></div>
                <div class="text-gray-400">Total Reservations</div>
            </div>

            <div class="luxury-card p-6 rounded-xl text-center">
                <div class="text-3xl mb-2">⏳</div>
                <div class="text-2xl font-bold text-luxury-gold"><?php echo $pending_count; ?></div>
                <div class="text-gray-400">Pending Reservations</div>
            </div>

            <div class="luxury-card p-6 rounded-xl text-center">
                <div class="text-3xl mb-2">💰</div>
                <div class="text-2xl font-bold text-luxury-gold">Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?></div>
                <div class="text-gray-400">Total Revenue</div>
            </div>
        </div>

        <!-- Recent Reservations -->
        <div class="luxury-card p-8 rounded-xl mb-8">
            <h2 class="text-2xl font-serif mb-6 text-luxury-gold">Recent Reservations</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-luxury-gold/20">
                            <th class="text-left py-3 px-4">User</th>
                            <th class="text-left py-3 px-4">Type</th>
                            <th class="text-left py-3 px-4">Service</th>
                            <th class="text-left py-3 px-4">Date</th>
                            <th class="text-left py-3 px-4">Status</th>
                            <th class="text-left py-3 px-4">Price</th>
                            <th class="text-left py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("
                            SELECT r.*, u.name as user_name
                            FROM reservations r
                            JOIN users u ON r.user_id = u.id
                            ORDER BY r.created_at DESC
                            LIMIT 10
                        ");
                        while($row = $result->fetch_assoc()):
                        ?>
                        <tr class="border-b border-gray-700">
                            <td class="py-3 px-4"><?php echo $row['user_name']; ?></td>
                            <td class="py-3 px-4 capitalize"><?php echo $row['type']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['name']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['date'] ?: 'N/A'; ?></td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded text-sm <?php
                                    if($row['status'] === 'confirmed') echo 'bg-green-600';
                                    elseif($row['status'] === 'pending') echo 'bg-yellow-600';
                                    else echo 'bg-red-600';
                                ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td class="py-3 px-4">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                            <td class="py-3 px-4">
                                <form method="POST" action="update_reservation.php" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <select name="status" onchange="this.form.submit()" class="bg-luxury-dark border border-luxury-gold/30 rounded px-2 py-1 text-sm">
                                        <option value="pending" <?php if($row['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                                        <option value="confirmed" <?php if($row['status'] === 'confirmed') echo 'selected'; ?>>Confirm</option>
                                        <option value="cancelled" <?php if($row['status'] === 'cancelled') echo 'selected'; ?>>Cancel</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="luxury-card p-8 rounded-xl">
            <h2 class="text-2xl font-serif mb-6 text-luxury-gold">Recent Users</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-luxury-gold/20">
                            <th class="text-left py-3 px-4">Name</th>
                            <th class="text-left py-3 px-4">Email</th>
                            <th class="text-left py-3 px-4">Phone</th>
                            <th class="text-left py-3 px-4">Role</th>
                            <th class="text-left py-3 px-4">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM users ORDER BY created_at DESC LIMIT 10");
                        while($row = $result->fetch_assoc()):
                        ?>
                        <tr class="border-b border-gray-700">
                            <td class="py-3 px-4"><?php echo $row['name']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['email']; ?></td>
                            <td class="py-3 px-4"><?php echo $row['phone']; ?></td>
                            <td class="py-3 px-4 capitalize"><?php echo $row['role']; ?></td>
                            <td class="py-3 px-4"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>