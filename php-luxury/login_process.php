<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if admin
    if ($email === 'admin@luxury.com' && $password === 'admin123') {
        $_SESSION['user'] = [
            'id' => 1,
            'name' => 'Admin Luxury',
            'email' => 'admin@luxury.com',
            'phone' => '08123456789',
            'role' => 'admin'
        ];
        header('Location: admin.php');
        exit;
    }

    // Check database
    $stmt = $conn->prepare("SELECT id, name, email, phone, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'role' => $user['role']
            ];
            header('Location: index.php');
            exit;
        }
    }

    $_SESSION['error'] = 'Email atau password salah.';
    header('Location: login.php');
    exit;
}

$conn->close();
?>