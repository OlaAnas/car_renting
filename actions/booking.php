<?php
session_start(); // Start the session to access user data
require_once "../database/connection.php"; // Include the database connection file

// Check if user is logged in
if (!isset($_SESSION['id'])) { // If user is not logged in
    header("Location: ../pages/login-form.php"); // Redirect to login form
    exit; // Stop script execution
}

$account_id = $_SESSION['id']; // Get the account id from the session
$car_id = isset($_POST['car_id']) ? (int)$_POST['car_id'] : 0; // Get the car id from POST or set to 0
$start_date = $_POST['start_date'] ?? ''; // Get the start date from POST or set to empty string
$end_date = $_POST['end_date'] ?? ''; // Get the end date from POST or set to empty string

// Validate input data
if (!$car_id || !$start_date || !$end_date) { // If any field is missing
    $_SESSION['error'] = "Alle velden zijn verplicht."; // Set an error message
    header("Location: ../pages/book-car.php?id=$car_id"); // Redirect to booking page
    exit; // Stop script execution
}

// Check date order
if (strtotime($end_date) < strtotime($start_date)) { // If end date is before start date
    $_SESSION['error'] = "Einddatum moet na de startdatum zijn."; // Set an error message
    header("Location: ../pages/book-car.php?id=$car_id"); // Redirect to booking page
    exit; // Stop script execution
}

try {
    // Execute booking
    $stmt = $pdo->prepare("INSERT INTO booking (account_id, car_id, start_date, end_date) VALUES (:account_id, :car_id, :start_date, :end_date)"); // Prepare the insert statement
    $stmt->bindParam(':account_id', $account_id); // Bind the account id
    $stmt->bindParam(':car_id', $car_id); // Bind the car id
    $stmt->bindParam(':start_date', $start_date); // Bind the start date
    $stmt->bindParam(':end_date', $end_date); // Bind the end date
    $stmt->execute(); // Execute the insert statement

    $_SESSION['success'] = "✅ Reservering succesvol geplaatst!"; // Set a success message
    header("Location: ../pages/home.php"); // Redirect to home page
    exit; // Stop script execution
} catch (PDOException $e) {
    $_SESSION['error'] = "Er is een fout opgetreden bij het reserveren."; // Set an error message if booking fails
    header("Location: ../pages/book-car.php?id=$car_id"); // Redirect to booking page
    exit; // Stop script execution
}
