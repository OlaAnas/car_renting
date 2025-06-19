<?php
session_start();
$_SESSION = []; // Clear all session variables for security
session_destroy(); // Destroy the session
header("Location: /car_renting/pages/login-form.php"); // Redirect to login
exit(); // Terminate script
?>
