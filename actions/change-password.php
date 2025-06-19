<?php
session_start();
require_once "../database/connection.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login-form.php");
    exit();
}

$user_id = $_SESSION['id'];

$current = $_POST['current_password'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

// Controleer of alle velden zijn ingevuld
if (empty($current) || empty($new) || empty($confirm)) {
    $_SESSION['error'] = "Vul alle velden in.";
    header("Location: ../pages/change-password.php");
    exit();
}

// Controleer of het nieuwe wachtwoord sterk genoeg is
if ($new !== $confirm) {
    $_SESSION['error'] = "Wachtwoorden komen niet overeen.";
    header("Location: ../pages/change-password.php");
    exit();
}

// 1. Controleer of het huidige wachtwoord correct is
$stmt = $conn->prepare("SELECT password FROM account WHERE id = :id");
$stmt->bindParam(":id", $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($current, $user['password'])) {
    $_SESSION['error'] = "Huidig wachtwoord is onjuist.";
    header("Location: ../pages/change-password.php");
    exit();
}

// 2. Controleer of het nieuwe wachtwoord sterk genoeg is
$new_hashed = password_hash($new, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE account SET password = :pass WHERE id = :id");
$update->bindParam(":pass", $new_hashed);
$update->bindParam(":id", $user_id);
$update->execute();

$_SESSION['success'] = "Wachtwoord succesvol bijgewerkt.";
header("Location: ../pages/change-password.php");
exit();
