<?php
session_start();
require "../includes/header.php";
?>
<main>
    <form action="/car_renting/actions/register.php" method="post" class="account-form">
        <h2>Maak een account aan</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <label for="email">Uw e-mail</label>
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
        <input
            type="password"
            name="password"
            id="password"
            placeholder="Uw wachtwoord"
            required
        >

        <label for="confirm-password">Herhaal wachtwoord</label>
        <input
            type="password"
            name="confirm-password"
            id="confirm-password"
            placeholder="Uw wachtwoord"
            required
        >
        <!-- Full name -->
<label for="full_name">Volledige naam</label>
<input type="text" id="full_name" name="full_name" required>

<!-- Phone number -->
<label for="phone">Telefoonnummer</label>
<input type="text" id="phone" name="phone">

<!-- Address -->
<label for="address">Adres</label>
<textarea id="address" name="address"></textarea><br>


        <input type="submit" value="Maak account aan" class="button-primary">
    </form>
</main>
<?php require "../includes/footer.php"; ?>
