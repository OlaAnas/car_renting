<?php
session_start();
require_once "../database/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $_SESSION['email'] = $email;

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Gelieve alle velden in te vullen."; // Please fill in all fields.
        header("Location: ../pages/login-form.php");
        exit;
    }

    $select_user = $conn->prepare("SELECT * FROM account WHERE email = :email");
    $select_user->bindParam(":email", $email);
    $select_user->execute();
    $user = $select_user->fetch(PDO::FETCH_ASSOC);

 if ($user && password_verify($password, $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email']; 

    unset($_SESSION['error'], $_SESSION['success']); 

    header("Location: ../index.php"); // Redirect to the home page after successful login
    exit;
}
    else {
        $_SESSION['error'] = "E-mailadres of wachtwoord is onjuist.";
        header("Location: ../pages/login-form.php");
        exit;
    }
} else {
    header("Location: ../pages/login-form.php");
    exit;
}
