<?php
// Start the session to access session variables
session_start();
// Include the header for the page
require_once "../includes/header.php";

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['id'])) {
    header("Location: login-form.php");
    exit();
}
?>

<main class="form-container">
    <h2>Wachtwoord wijzigen</h2>

    <!-- Show error or success message if set in session -->
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php elseif (isset($_SESSION['success'])): ?>
        <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <!-- Form for changing password -->
    <form action="../actions/change-password.php" method="post" style="max-width: 400px; margin: 0 auto;">
        <div style="margin-bottom: 16px;">
            <label for="current_password">Huidig wachtwoord</label><br>
            <!-- Input for current password -->
            <input type="password" name="current_password" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="new_password">Nieuw wachtwoord</label><br>
            <!-- Input for new password -->
            <input type="password" name="new_password" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 24px;">
            <label for="confirm_password">Bevestig nieuw wachtwoord</label><br>
            <!-- Input for confirming new password -->
            <input type="password" name="confirm_password" required style="width: 100%; padding: 8px;">
        </div>

        <!-- Submit button to update password -->
        <button type="submit" class="button-primary">Wachtwoord bijwerken</button>
    </form>
</main>

<?php // Include the footer for the page
require_once "../includes/footer.php"; ?>
