<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - Jakarta Luxury AI</title>
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
                <a href="ai-designer.php" class="hover:text-luxury-gold transition-colors">AI Designer</a>
                <a href="reservations.php" class="hover:text-luxury-gold transition-colors">Reservasi</a>
                <a href="store.php" class="text-luxury-gold">Store</a>
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

    <div class="py-12 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-serif mb-6 text-luxury-gold">Luxury Store</h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Temukan koleksi produk eksklusif untuk melengkapi pengalaman luxury Anda
            </p>
        </div>

        <?php
        // Get products
        $result = $conn->query("SELECT * FROM products ORDER BY category, name");
        $products = [];
        while($row = $result->fetch_assoc()) {
            $products[$row['category']][] = $row;
        }
        ?>

        <?php foreach($products as $category => $category_products): ?>
            <section class="mb-16">
                <h2 class="text-3xl font-serif mb-8 text-luxury-gold capitalize"><?php echo $category; ?> Collection</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach($category_products as $product): ?>
                        <div class="luxury-card p-6 rounded-xl hover:border-luxury-gold/40 transition-all">
                            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"
                                 class="w-full h-48 object-cover rounded-lg mb-6">
                            <h3 class="text-xl font-serif mb-4 text-luxury-gold"><?php echo $product['name']; ?></h3>
                            <p class="text-gray-300 mb-6"><?php echo $product['description']; ?></p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-luxury-gold">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                                <button onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes($product['name']); ?>', <?php echo $product['price']; ?>)"
                                        class="bg-luxury-gold text-black px-6 py-3 rounded hover:bg-opacity-80">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>

    <!-- Cart Modal -->
    <div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="luxury-card p-8 rounded-xl max-w-md w-full">
                <h3 class="text-2xl font-serif mb-6 text-luxury-gold text-center">Shopping Cart</h3>
                <div id="cartItems" class="space-y-4 mb-6">
                    <!-- Cart items will be added here -->
                </div>
                <div class="flex justify-between">
                    <button onclick="clearCart()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Clear Cart</button>
                    <button onclick="checkout()" class="bg-luxury-gold text-black px-4 py-2 rounded hover:bg-opacity-80">Checkout</button>
                </div>
                <button onclick="closeCart()" class="absolute top-4 right-4 text-gray-400 hover:text-white">×</button>
            </div>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('luxury_cart') || '[]');

        function addToCart(id, name, price) {
            cart.push({id, name, price});
            localStorage.setItem('luxury_cart', JSON.stringify(cart));
            alert('Added to cart!');
        }

        function showCart() {
            const cartItems = document.getElementById('cartItems');
            cartItems.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                total += item.price;
                cartItems.innerHTML += `
                    <div class="flex justify-between items-center">
                        <span>${item.name}</span>
                        <span>Rp ${item.price.toLocaleString()}</span>
                    </div>
                `;
            });

            cartItems.innerHTML += `<hr class="my-4"><div class="flex justify-between font-bold"><span>Total:</span><span>Rp ${total.toLocaleString()}</span></div>`;
            document.getElementById('cartModal').classList.remove('hidden');
        }

        function closeCart() {
            document.getElementById('cartModal').classList.add('hidden');
        }

        function clearCart() {
            cart = [];
            localStorage.removeItem('luxury_cart');
            closeCart();
        }

        function checkout() {
            alert('Checkout functionality would be implemented here!');
            clearCart();
        }

        // Add cart button to navigation
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.querySelector('nav .flex.items-center.justify-between');
            if (nav) {
                const cartButton = document.createElement('button');
                cartButton.onclick = showCart;
                cartButton.className = 'bg-luxury-gold text-black px-4 py-2 rounded hover:bg-opacity-80';
                cartButton.textContent = 'Cart (' + cart.length + ')';
                nav.appendChild(cartButton);
            }
        });
    </script>

    <?php $conn->close(); ?>
</body>
</html>