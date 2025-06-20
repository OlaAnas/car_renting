<!-- pages/edit-account.php -->
<?php
// Start the session to access session variables
session_start();
// Include the database connection file
require_once "../database/connection.php";

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['id'])) {
    header("Location: login-form.php");
    exit;
}

// Fetch the user's information from the database using their session ID
$stmt = $pdo->prepare("SELECT * FROM account WHERE id = :id");
$stmt->bindParam(":id", $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php // Include the header for the page
require_once "../includes/header.php"; ?>

<main class="account-container">
    <h2>Profiel bewerken</h2>

    <!-- Form for editing user profile information -->
    <form action="/car_renting/actions/update-account.php" method="POST" class="account-form">
        <label for="full_name">Volledige naam</label>
        <!-- Input for full name, pre-filled with user's current name -->
        <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>

        <label for="phone">Telefoonnummer</label>
        <!-- Input for phone number, pre-filled with user's current phone -->
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">

        <label for="address">Adres</label>
        <!-- Input for address, pre-filled with user's current address -->
        <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>">

        <!-- Submit button to save changes -->
        <button type="submit" class="button-primary">Opslaan</button>
    </form>
</main>

<?php // Include the footer for the page
require_once "../includes/footer.php"; ?>
