<?php
$host = 'localhost'; // Database host
$db   = 'rental';    // Database name
$user = 'root';      // Database username
$pass = '';          // Database password

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4"; // Data Source Name for PDO
    $pdo = new PDO($dsn, $user, $pass); // Create a new PDO instance for database connection
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    echo "Databaseverbinding mislukt. Probeer later opnieuw."; // Show a user-friendly error message
    error_log("Database fout: " . $e->getMessage()); // Log the actual error for debugging
    exit; // Stop script execution
}
