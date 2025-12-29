<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $room_type = $_POST['room_type'];
    $style = $_POST['style'];
    $description = trim($_POST['description']);
    $budget = $_POST['budget'];

    // Create design request as reservation
    $name = ucfirst($room_type) . ' ' . ucfirst($style) . ' Design';
    $details = "Room: $room_type\nStyle: $style\nDescription: $description\nBudget: $budget";
    $price = 500000; // Consultation fee

    $stmt = $conn->prepare("INSERT INTO reservations (user_id, type, name, details, price) VALUES (?, 'ai_design', ?, ?, ?)");
    $stmt->bind_param("issd", $user_id, $name, $details, $price);

    if ($stmt->execute()) {
        $_SESSION['design_success'] = 'Design consultation booked successfully! Our team will contact you soon.';
    } else {
        $_SESSION['design_error'] = 'Failed to book consultation. Please try again.';
    }

    $stmt->close();
    header('Location: ai-designer.php');
    exit;
}

$conn->close();
?>