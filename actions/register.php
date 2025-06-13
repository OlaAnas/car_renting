<?php
session_start();
require "../database/connection.php";

$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];

$_SESSION['email'] = $email;

if ($password === $confirm_password) {
    $check_account = $conn->prepare("SELECT * FROM account WHERE email = :email");
    $check_account->bindParam(":email", $email);
    $check_account->execute();

    if ($check_account->rowCount() === 0) {
        // Encrypt password with high cost
        $options = ['cost' => 14];
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT, $options);

        $create_account = $conn->prepare("INSERT INTO account (email, password) VALUES (:email, :password)");
        $create_account->bindParam(":email", $email);
        $create_account->bindParam(":password", $encrypted_password);
        $create_account->execute();

        $_SESSION["success"] = "Registratie is gelukt, log nu in:";
        unset($_SESSION["email"]);
        header("Location: ../pages/login-form.php");
        exit();
    } else {
        $_SESSION["message"] = "Dit e-mailadres is al in gebruik.";
        header("Location: ../pages/register-form.php");
        exit();
    }
} else {
    $_SESSION["message"] = "Wachtwoorden komen niet overeen.";
    header("Location: ../pages/register-form.php");
    exit();
}
