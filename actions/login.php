<?php
session_start(); // Start the session to store user data and messages
require_once "../database/connection.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Check if the request method is POST
    $email = trim($_POST['email']); // Get and trim the email from the POST request
    $password = $_POST['password']; // Get the password from the POST request

    $_SESSION['email'] = $email; // Store the email in the session for repopulation on error

    if (empty($email) || empty($password)) { // Check if either email or password is empty
        $_SESSION['error'] = "Gelieve alle velden in te vullen."; // Set an error message if fields are empty
        header("Location: ../pages/login-form.php"); // Redirect to the login form
        exit; // Stop script execution
    }

    $stmt = $pdo->prepare("SELECT * FROM account WHERE email = :email"); // Prepare a query to select the user by email
    $stmt->bindParam(":email", $email); // Bind the email parameter
    $stmt->execute(); // Execute the query
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data as an associative array

    if ($user && password_verify($password, $user['password'])) { // If user exists and password is correct
        $_SESSION['id'] = $user['id']; // Store the user id in the session
        $_SESSION['email'] = $user['email']; // Store the user email in the session

        unset($_SESSION['error']); // Remove any previous error messages from the session

        header("Location: ../pages/home.php"); // Redirect to the home page after successful login
        exit; // Stop script execution
    } else {
        $_SESSION['error'] = "E-mailadres of wachtwoord is onjuist."; // Set an error message if login fails
        header("Location: ../pages/login-form.php"); // Redirect to the login form
        exit; // Stop script execution
    }
} else {
    header("Location: ../pages/login-form.php"); // Redirect to the login form if not a POST request
    exit; // Stop script execution
}
