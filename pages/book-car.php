<?php
session_start();
require_once "../database/connection.php";
require_once "../includes/header.php";

// تأكد أن المستخدم مسجل دخول
if (!isset($_SESSION['id'])) {
    header("Location: login-form.php");
    exit;
}

$car_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($car_id <= 0) {
    echo "<p style='padding: 20px;'>Geen geldige auto geselecteerd.</p>";
    require_once "../includes/footer.php";
    exit;
}
?>

<main style="max-width: 600px; margin: 40px auto; padding: 20px;">
    <h2>Auto reserveren</h2>

    <?php if (isset($_SESSION['booking_success'])): ?>
        <p style="color: green; margin-bottom: 20px;"><?= $_SESSION['booking_success']; unset($_SESSION['booking_success']); ?></p>
    <?php endif; ?>

    <form action="../actions/booking.php" method="POST">
        <input type="hidden" name="car_id" value="<?= $car_id ?>">

        <label for="start_date">Startdatum</label>
        <input type="date" name="start_date" required><br><br>

        <label for="end_date">Einddatum</label>
        <input type="date" name="end_date" required><br><br>

        <button type="submit" class="button-primary" style="padding: 10px 20px; background-color: #4169e1; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Bevestig reservering
        </button>
    </form>
</main>

<?php require_once "../includes/footer.php"; ?>
