<?php
include 'config.php';

$result = $conn->query('SELECT COUNT(*) as count FROM users');
if ($result) {
    $row = $result->fetch_assoc();
    echo 'Users in database: ' . $row['count'] . "\n";
} else {
    echo 'Users query failed: ' . $conn->error . "\n";
}

$result = $conn->query('SELECT COUNT(*) as count FROM products');
if ($result) {
    $row = $result->fetch_assoc();
    echo 'Products in database: ' . $row['count'] . "\n";
} else {
    echo 'Products query failed: ' . $conn->error . "\n";
}

$result = $conn->query('SELECT COUNT(*) as count FROM reservations');
if ($result) {
    $row = $result->fetch_assoc();
    echo 'Reservations in database: ' . $row['count'] . "\n";
} else {
    echo 'Reservations query failed: ' . $conn->error . "\n";
}

$conn->close();
?>