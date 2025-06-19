<!-- pages/edit-account.php -->
<?php
session_start();
require_once "../database/connection.php";

// تأكد من أن المستخدم مسجل دخول
if (!isset($_SESSION['id'])) {
    header("Location: login-form.php");
    exit;
}

// جلب معلومات المستخدم من القاعدة
$stmt = $conn->prepare("SELECT * FROM account WHERE id = :id");
$stmt->bindParam(":id", $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php require_once "../includes/header.php"; ?>

<main class="account-container">
    <h2>Profiel bewerken</h2>

    <form action="/car_renting/actions/update-account.php" method="POST" class="account-form">
        <label for="full_name">Volledige naam</label>
        <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>

        <label for="phone">Telefoonnummer</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">

        <label for="address">Adres</label>
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>">

        <button type="submit" class="button-primary">Opslaan</button>
    </form>
</main>

<?php require_once "../includes/footer.php"; ?>
