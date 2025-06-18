<?php
session_start();


// Redirect to login if not logged in
if (!isset($_SESSION['id'])) {
    header("Location: /rental-main/pages/login-form.php");
    exit;
}

// Include header
require_once "../includes/header.php";
?>

<main class="account-container">
    <h2>Mijn account</h2>

    <div class="account-info">
        <?php if (isset($_SESSION['email'])): ?>
            <p><strong>E-mailadres:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
        <?php else: ?>
            <p><strong>E-mailadres:</strong> Niet beschikbaar</p>
        <?php endif; ?>
    </div>
    
</main>

<?php
require_once "../includes/footer.php";
?>
