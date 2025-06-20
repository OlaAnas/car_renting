<?php
$host = 'localhost';
$db   = 'rental';
$user = 'root';
$pass = '';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Databaseverbinding mislukt. Probeer later opnieuw.";
    error_log("Database fout: " . $e->getMessage());
    exit;
}
