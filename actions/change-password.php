<?php
session_start(); // Start the session to access user data
require_once "../database/connection.php"; // Include the database connection file

if (!isset($_SESSION['id'])) { // Check if the user is logged in
    header("Location: ../pages/login-form.php"); // Redirect to login form if not logged in
    exit(); // Stop script execution
}

$user_id = $_SESSION['id']; // Get the user id from the session

$current = $_POST['current_password']; // Get the current password from the POST request
$new = $_POST['new_password']; // Get the new password from the POST request
$confirm = $_POST['confirm_password']; // Get the confirm password from the POST request

if (empty($current) || empty($new) || empty($confirm)) { // Check if any field is empty
    $_SESSION['error'] = "Vul alle velden in."; // Set an error message if fields are empty
    header("Location: ../pages/change-password.php"); // Redirect to the change password page
    exit(); // Stop script execution
}

if ($new !== $confirm) { // Check if the new password matches the confirmation
    $_SESSION['error'] = "Wachtwoorden komen niet overeen."; // Set an error message if passwords do not match
    header("Location: ../pages/change-password.php"); // Redirect to the change password page
    exit(); // Stop script execution
}

$stmt = $pdo->prepare("SELECT password FROM account WHERE id = :id"); // Prepare a query to get the current password hash
$stmt->bindParam(":id", $user_id); // Bind the user id parameter
$stmt->execute(); // Execute the query
$user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data

if (!$user || !password_verify($current, $user['password'])) { // Check if the current password is correct
    $_SESSION['error'] = "Huidig wachtwoord is onjuist."; // Set an error message if the current password is incorrect
    header("Location: ../pages/change-password.php"); // Redirect to the change password page
    exit(); // Stop script execution
}

$new_hashed = password_hash($new, PASSWORD_DEFAULT); // Hash the new password
$update = $pdo->prepare("UPDATE account SET password = :pass WHERE id = :id"); // Prepare the update statement
$update->bindParam(":pass", $new_hashed); // Bind the new hashed password
$update->bindParam(":id", $user_id); // Bind the user id
$update->execute(); // Execute the update

$_SESSION['success'] = "Wachtwoord succesvol bijgewerkt."; // Set a success message in the session
header("Location: ../pages/change-password.php"); // Redirect to the change password page
exit(); // Stop script execution
