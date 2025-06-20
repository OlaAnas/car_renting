<?php
session_start(); // Start the session to store user data and messages
require "../database/connection.php"; // Include the database connection file

$full_name = trim($_POST["full_name"]); // Get and trim the full name from the POST request
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // Get and sanitize the email from the POST request
$phone = trim($_POST["phone"]); // Get and trim the phone number from the POST request
$address = trim($_POST["address"]); // Get and trim the address from the POST request
$password = $_POST["password"]; // Get the password from the POST request
$confirm_password = $_POST["confirm-password"]; // Get the confirm password from the POST request

$_SESSION['email'] = $email; // Store the email in the session for repopulation on error

if ($password === $confirm_password) { // Check if the passwords match
    $check_account = $pdo->prepare("SELECT * FROM account WHERE email = :email"); // Prepare a query to check if the email already exists
    $check_account->bindParam(":email", $email); // Bind the email parameter
    $check_account->execute(); // Execute the query

    if ($check_account->rowCount() === 0) { // If no account exists with this email
        $options = ['cost' => 10]; // Set password hashing options
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT, $options); // Hash the password

        $create_account = $pdo->prepare(
            "INSERT INTO account (full_name, email, phone, address, password) VALUES (:full_name, :email, :phone, :address, :password)"
        ); // Prepare the insert statement
        $create_account->bindParam(":full_name", $full_name); // Bind the full name
        $create_account->bindParam(":email", $email); // Bind the email
        $create_account->bindParam(":phone", $phone); // Bind the phone
        $create_account->bindParam(":address", $address); // Bind the address
        $create_account->bindParam(":password", $encrypted_password); // Bind the hashed password
        $create_account->execute(); // Execute the insert statement

        $_SESSION["success"] = "Registratie is gelukt, log nu in:"; // Set a success message in the session
        unset($_SESSION["email"]); // Remove the email from the session
        header("Location: ../pages/login-form.php"); // Redirect to the login form
        exit(); // Stop script execution
    } else {
        $_SESSION["message"] = "Dit e-mailadres is al in gebruik."; // Set an error message if the email is already in use
        header("Location: ../pages/register-form.php"); // Redirect to the register form
        exit(); // Stop script execution
    }
} else {
    $_SESSION["message"] = "Wachtwoorden komen niet overeen."; // Set an error message if the passwords do not match
    header("Location: ../pages/register-form.php"); // Redirect to the register form
    exit(); // Stop script execution
}
