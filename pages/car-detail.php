<?php require "includes/header.php" ?>
<?php
require_once __DIR__ . '/../database/connection.php';
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
                    <p><?= htmlspecialchars($car['description']) ?></p>
                    <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                <?php else: ?>
                    <h2>Auto niet gevonden</h2>
                <?php endif; ?>
            </div>
        </div>
        <div class="row white-background">
            <?php if ($car): ?>
                <h2><?= htmlspecialchars($car['name']) ?></h2>
                <div class="rating">
                    <span class="stars stars-4"></span>
                    <span>440+ reviewers</span>
                </div>
                <p><?= htmlspecialchars($car['description']) ?></p>
                <div class="car-type">
                    <div class="grid">
                        <div class="row"><span class="accent-color">Type Car</span><span>Sport</span></div>
                        <div class="row"><span class="accent-color">Capacity</span><span>2 person</span></div>
                    </div>
                    <div class="grid">
                        <div class="row"><span class="accent-color">Steering</span><span>Manual</span></div>
                        <div class="row"><span class="accent-color">Gasoline</span><span>70L</span></div>
                    </div>
                    <div class="call-to-action">
                        <div class="row"><span class="font-weight-bold">€<?= number_format($car['price_per_day'], 2, ',', '.') ?></span> / dag</div>
                        <div class="row"><a href="" class="button-primary">Huur nu</a></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require "includes/footer.php" ?>