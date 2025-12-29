<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jakarta Luxury AI</title>
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
        .glass { background: rgba(22, 22, 22, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-md">
        <div class="glass p-10 border border-luxury-gold/20 rounded-lg shadow-2xl">
            <h2 class="text-3xl font-serif text-center mb-8 text-luxury-gold">Masuk ke Jakarta Luxury AI</h2>

            <?php
            session_start();
            if(isset($_SESSION['error'])) {
                echo '<div class="bg-red-600 text-white p-3 rounded mb-6">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }
            ?>

            <form action="login_process.php" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 bg-luxury-card border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 bg-luxury-card border border-luxury-gold/30 rounded-lg focus:border-luxury-gold focus:outline-none text-white">
                </div>

                <button type="submit" class="w-full bg-luxury-gold text-black py-3 rounded-lg font-semibold hover:bg-opacity-80 transition-colors">
                    Masuk
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-400">Belum punya akun? <a href="register.php" class="text-luxury-gold hover:underline">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</body>
</html>