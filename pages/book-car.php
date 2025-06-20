<?php
// Start the session to access session variables
session_start();
// Include the database connection file
require_once "../database/connection.php";
// Include the header for the page
require_once "../includes/header.php";

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['id'])) {
    header("Location: login-form.php");
    exit;
}

// Get the car ID from the query string, or set to 0 if not present
$car_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// If car ID is invalid, show error and exit
if ($car_id <= 0) {
    echo "<p style='padding: 20px;'>Geen geldige auto geselecteerd.</p>";
    require_once "../includes/footer.php";
    exit;
}
?>

<main style="max-width: 600px; margin: 40px auto; padding: 20px;">
    <h2>Auto reserveren</h2>

    <!-- Show booking success message if set in session -->
    <?php if (isset($_SESSION['booking_success'])): ?>
        <p style="color: green; margin-bottom: 20px;">
            <?= $_SESSION['booking_success']; unset($_SESSION['booking_success']); ?>
        </p>
    <?php endif; ?>

    <!-- Booking form for selecting start and end date -->
    <form action="../actions/booking.php" method="POST">
        <!-- Hidden input to pass car ID -->
        <input type="hidden" name="car_id" value="<?= $car_id ?>">

        <label for="start_date">Startdatum</label>
        <input type="date" name="start_date" required><br><br>

        <label for="end_date">Einddatum</label>
        <input type="date" name="end_date" required><br><br>

        <!-- Submit button to confirm booking -->
        <button type="submit" class="button-primary" style="padding: 10px 20px; background-color: #4169e1; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Bevestig reservering
        </button>
    </form>
</main>

<?php // Include the footer for the page
require_once "../includes/footer.php"; ?>
