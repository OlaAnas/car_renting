<?php
// Start the session to access session variables
session_start();
// Include the header for the page
require "../includes/header.php";
?>
<main>
    <!-- Registration form for creating a new account -->
    <form action="/car_renting/actions/register.php" method="post" class="account-form">
        <h2>Maak een account aan</h2>

        <!-- Show message if set in session -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
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

        <label for="confirm-password">Herhaal wachtwoord</label>
        <!-- Input for confirming password -->
        <input
            type="password"
            name="confirm-password"
            id="confirm-password"
            placeholder="Uw wachtwoord"
            required
        >
        <!-- Input for full name -->
        <label for="full_name">Volledige naam</label>
        <input type="text" id="full_name" name="full_name" required>

        <!-- Input for phone number -->
        <label for="phone">Telefoonnummer</label>
        <input type="text" id="phone" name="phone">

        <!-- Input for address -->
        <label for="address">Adres</label>
        <textarea id="address" name="address"></textarea><br>

        <!-- Submit button to create account -->
        <input type="submit" value="Maak account aan" class="button-primary">
    </form>
</main>
<?php // Include the footer for the page
require "../includes/footer.php"; ?>
