<?php
session_start(); // Start the session to access session variables
$_SESSION = []; // Clear all session variables for security
session_destroy(); // Destroy the session and remove session data
header("Location: /car_renting/pages/login-form.php"); // Redirect to the login page
exit(); // Terminate script execution
?>
