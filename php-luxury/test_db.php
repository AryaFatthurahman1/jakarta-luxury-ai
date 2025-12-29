<?php
echo "Testing database connection...\n";

try {
    $conn = new mysqli('localhost', 'root', '');
    echo "MySQLi object created\n";

    if ($conn->connect_error) {
        echo 'Connection failed: ' . $conn->connect_error . "\n";
    } else {
        echo "MySQL connection successful\n";
        $result = $conn->query('SHOW DATABASES LIKE "jakarta_luxury_ai"');
        if ($result) {
            if ($result->num_rows > 0) {
                echo "Database exists\n";
            } else {
                echo "Database does not exist\n";
            }
        } else {
            echo "Query failed: " . $conn->error . "\n";
        }
    }
    $conn->close();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
?>