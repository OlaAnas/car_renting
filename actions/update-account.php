<?php
session_start(); // Start the session to access user data
require_once "../database/connection.php"; // Include the database connection file

if (!isset($_SESSION['id'])) { // Check if the user is logged in
    header("Location: ../pages/login-form.php"); // Redirect to login form if not logged in
    exit; // Stop script execution
}

$full_name = trim($_POST['full_name']); // Get and trim the full name from the POST request
$phone = trim($_POST['phone']); // Get and trim the phone number from the POST request
$address = trim($_POST['address']); // Get and trim the address from the POST request

$stmt = $pdo->prepare("UPDATE account SET full_name = :full_name, phone = :phone, address = :address WHERE id = :id"); // Prepare the update statement
$stmt->bindParam(":full_name", $full_name); // Bind the full name parameter
$stmt->bindParam(":phone", $phone); // Bind the phone parameter
$stmt->bindParam(":address", $address); // Bind the address parameter
$stmt->bindParam(":id", $_SESSION['id']); // Bind the user id from the session

if ($stmt->execute()) { // Execute the update and check if it was successful
    $_SESSION['success'] = "Profiel succesvol bijgewerkt."; // Set a success message in the session
    header("Location: ../pages/account.php"); // Redirect to the account page
    exit; // Stop script execution
} else {
    $_SESSION['error'] = "Er is een fout opgetreden."; // Set an error message in the session
    header("Location: ../pages/edit-account.php"); // Redirect to the edit account page
    exit; // Stop script execution
}
