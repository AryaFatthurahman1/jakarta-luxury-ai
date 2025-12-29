<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $type = $_POST['type'];
    $name = trim($_POST['name']);
    $details = trim($_POST['details']);
    $date = $_POST['date'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    // Validation
    if (empty($name) || empty($type) || $price <= 0) {
        $_SESSION['booking_error'] = 'Please fill all required fields correctly.';
        header('Location: reservations.php');
        exit;
    }

    // Insert reservation
    $stmt = $conn->prepare("INSERT INTO reservations (user_id, type, name, details, date, quantity, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssid", $user_id, $type, $name, $details, $date, $quantity, $price);

    if ($stmt->execute()) {
        $_SESSION['booking_success'] = 'Reservation created successfully!';
    } else {
        $_SESSION['booking_error'] = 'Failed to create reservation. Please try again.';
    }

    $stmt->close();
    header('Location: reservations.php');
    exit;
}

$conn->close();
?>