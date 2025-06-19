<?php
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=rental", $username, $password); // استخدم $conn بدل $pdo
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
