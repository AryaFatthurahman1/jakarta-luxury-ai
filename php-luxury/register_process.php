<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Password tidak cocok.';
        header('Location: register.php');
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password minimal 6 karakter.';
        header('Location: register.php');
        exit;
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Email sudah terdaftar.';
        header('Location: register.php');
        exit;
    }

    // Insert new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, 'customer')");
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['user'] = [
            'id' => $conn->insert_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'role' => 'customer'
        ];
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Terjadi kesalahan. Silakan coba lagi.';
        header('Location: register.php');
        exit;
    }
}

$conn->close();
?>