<?php
// Create database connection without specifying database
$conn = new mysqli('localhost', 'root', '');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS jakarta_luxury_ai";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->close();

// Now connect to the database
include 'config.php';

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}

// Create reservations table
$sql = "CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('travel', 'culinary', 'ai_design') NOT NULL,
    name VARCHAR(255) NOT NULL,
    details TEXT,
    date DATE,
    time TIME,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Reservations table created successfully<br>";
} else {
    echo "Error creating reservations table: " . $conn->error . "<br>";
}

// Create products table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category ENUM('travel', 'culinary', 'ai_design') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Products table created successfully<br>";
} else {
    echo "Error creating products table: " . $conn->error . "<br>";
}

// Insert sample products
$products = [
    ['Presidential Suite Retreat', 'Luxury suite with panoramic Jakarta view', 'travel', 25000000, 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=600'],
    ['Luxury Yacht Thousand Islands', 'Private yacht tour to Thousand Islands', 'travel', 15000000, 'https://images.unsplash.com/photo-1567891777981-ed9796861529?auto=format&fit=crop&q=80&w=600'],
    ['Jakarta Heli-Tour Skyline', 'Exclusive helicopter tour over Jakarta', 'travel', 8000000, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=600'],
    ['Rijsttafel Modern Fusion', 'Dutch-Indonesian fusion cuisine', 'culinary', 1200000, 'https://picsum.photos/seed/food1/600/400'],
    ['Wagyu Beef Maranggi', 'Premium Wagyu beef satay', 'culinary', 950000, 'https://picsum.photos/seed/food2/600/400'],
    ['Truffle Nasi Goreng', 'Black truffle fried rice', 'culinary', 650000, 'https://picsum.photos/seed/food3/600/400']
];

foreach ($products as $product) {
    $stmt = $conn->prepare("INSERT IGNORE INTO products (name, description, category, price, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $product[0], $product[1], $product[2], $product[3], $product[4]);
    $stmt->execute();
    $stmt->close();
}

echo "Sample products inserted<br>";

// Create admin user
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT IGNORE INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $password, $role);

$name = 'Admin Luxury';
$email = 'admin@luxury.com';
$phone = '08123456789';
$password = $admin_password;
$role = 'admin';

$stmt->execute();
$stmt->close();

echo "Admin user created (admin@luxury.com / admin123)<br>";

$conn->close();
echo "Database setup completed!";
?>