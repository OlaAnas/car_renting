<?php require_once "../includes/header.php"; ?>
<?php
require_once __DIR__ . '/../database/connection.php';

// تأمين المعرف المرسل
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$car = null;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM car WHERE id = ?");
    $stmt->execute([$id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<main class="car-detail">
    <div class="grid">
        <div class="row">
            <div class="advertorial">
                <?php if ($car): ?>
                    <h2><?= htmlspecialchars($car['name']) ?> - <?= htmlspecialchars($car['brand']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($car['description'])) ?></p>
                    <img src="/car_renting/<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>" style="max-width: 100%; border-radius: 10px;">
                <?php else: ?>
                    <h2>Auto niet gevonden</h2>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($car): ?>
            <div class="row white-background" style="padding: 20px; border-radius: 8px; background: #f9f9f9; margin-top: 20px;">
                <h2><?= htmlspecialchars($car['name']) ?></h2>
                <div class="rating" style="margin-bottom: 10px;">
                    <span class="stars stars-4"></span>
                    <span>440+ reviewers</span>
                </div>
                <p><?= nl2br(htmlspecialchars($car['description'])) ?></p>

                <div class="car-type" style="margin-top: 20px;">
                    <div class="grid">
                        <div class="row"><span class="accent-color">Type Auto:</span><span>Sport</span></div>
                        <div class="row"><span class="accent-color">Capaciteit:</span><span>2 personen</span></div>
                    </div>
                    <div class="grid">
                        <div class="row"><span class="accent-color">Versnelling:</span><span>Handmatig</span></div>
                        <div class="row"><span class="accent-color">Brandstof:</span><span>70L</span></div>
                    </div>

                    <div class="call-to-action" style="margin-top: 20px;">
                        <div class="row">
                            <span class="font-weight-bold">€<?= number_format($car['price_per_day'], 2, ',', '.') ?></span> / dag
                        </div>
                        <div class="row">
                            <a href="/car_renting/pages/book-car.php?id=<?= $car['id'] ?>" class="button-primary" style="margin-top: 10px;">Reserveer deze auto</a>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once "../includes/footer.php"; ?>
