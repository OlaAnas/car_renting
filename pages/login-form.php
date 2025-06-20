<?php
// Start the session to access session variables
session_start();
// Include the header for the page
require "../includes/header.php";
?>
<main>
    <!-- Login form for user authentication -->
    <form action="../actions/login.php" class="account-form" method="post">
        <h2>Log in</h2>

        <!-- Show success message if set in session -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="succes-message">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Show error message if set in session -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <label for="email">Uw e-mail</label>
        <!-- Input for email address, pre-filled if available in session -->
        <input
            type="email"
            name="email"
            id="email"
            placeholder="johndoe@gmail.com"
            value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>"
            required
            autofocus
        >

        <label for="password">Uw wachtwoord</label>
        <!-- Input for password -->
        <input
            type="password"
            name="password"
            id="password"
            placeholder="Uw wachtwoord"
            required
        >

        <!-- Submit button to log in -->
        <input type="submit" value="Log in" class="button-primary">
    </form>
</main>
<?php // Include the footer for the page
require "../includes/footer.php"; ?>
