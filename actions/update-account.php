<?php
session_start();
require_once "../database/connection.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login-form.php");
    exit;
}

// Zorg ervoor dat de gebruiker is ingelogd
$full_name = trim($_POST['full_name']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);

$stmt = $pdo->prepare("UPDATE account SET full_name = :full_name, phone = :phone, address = :address WHERE id = :id");
$stmt->bindParam(":full_name", $full_name);
$stmt->bindParam(":phone", $phone);
$stmt->bindParam(":address", $address);
$stmt->bindParam(":id", $_SESSION['id']);

if ($stmt->execute()) {
    $_SESSION['success'] = "Profiel succesvol bijgewerkt.";
    header("Location: ../pages/account.php");
    exit;
} else {
    $_SESSION['error'] = "Er is een fout opgetreden.";
    header("Location: ../pages/edit-account.php");
    exit;
}
