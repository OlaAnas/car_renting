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

// Get the user ID from the session
$user_id = $_SESSION['id'];
// Prepare SQL to fetch user details
$sql = "SELECT full_name, email, phone, address, created_at FROM account WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
// Fetch user data as associative array
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Prepare SQL to count the number of bookings for the user
$booking_stmt = $pdo->prepare("SELECT COUNT(*) FROM booking WHERE account_id = :id");
$booking_stmt->bindParam(':id', $user_id);
$booking_stmt->execute();
// Get the booking count
$booking_count = $booking_stmt->fetchColumn();
?>

<?php // Include the header for the page
require_once "../includes/header.php"; ?>

<main style="max-width: 600px; margin: 40px auto; padding: 30px; background: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 24px; text-align: center; color: #333;">Mijn account</h2>

    <?php if ($user): ?>
        <div style="line-height: 1.8; font-size: 16px; color: #444;">
            <!-- Display user details -->
            <p><strong>Naam:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
            <p><strong>E-mailadres:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Telefoonnummer:</strong> <?= !empty($user['phone']) ? htmlspecialchars($user['phone']) : 'Niet opgegeven' ?></p>
            <p><strong>Adres:</strong> <?= !empty($user['address']) ? htmlspecialchars($user['address']) : 'Niet opgegeven' ?></p>
            <p><strong>Account aangemaakt op:</strong> <?= date("d-m-Y", strtotime($user['created_at'])) ?></p>
            <p><strong>Aantal eerdere boekingen:</strong> <?= $booking_count ?> keer</p>
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <!-- Link to change password -->
            <a href="change-password.php" class="button-secondary" style="padding: 10px 20px; border: 1px solid #4169e1; color: #4169e1; border-radius: 5px; text-decoration: none;">Wachtwoord wijzigen</a>
            <!-- Link to edit profile -->
            <a href="edit-account.php" class="button-primary" style="padding: 10px 20px; background: #4169e1; color: #fff; border-radius: 5px; text-decoration: none;">Profiel bewerken</a>
        </div>
    <?php else: ?>
        <!-- Show error if user data is not found -->
        <p style="color: red;">Geen gebruikersgegevens gevonden.</p>
    <?php endif; ?>
</main>

<?php // Include the footer for the page
require_once "../includes/footer.php"; ?>
