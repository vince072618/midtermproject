<?php
// Database credentials
$db_host = 'localhost';
$db_name = 'camba';
$db_user = 'root';  // Default XAMPP MySQL username
$db_pass = '';      // Default XAMPP MySQL password (leave empty)

// Create a PDO instance
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
