<?php
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=rental", $username, $password); // استخدم $conn بدل $pdo
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
