<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php
require_once __DIR__ . '/../database/connection.php';

try {
    $stmt = $pdo->query("SELECT * FROM car LIMIT 8");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $cars = [];
}
?>
    <header>
        <div class="advertorials">
            <div class="advertorial">
                <h2>Hét platform om een auto te huren</h2>
                <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
                <a href="#" class="button-primary">Huur nu een auto</a>
                <img src="assets/images/car-rent-header-image-1.png" alt="">
                <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
            <div class="advertorial">
                <h2>Wij verhuren ook bedrijfswagens</h2>
                <p>Voor een vaste lage prijs met prettig voordelen.</p>
                <a href="#" class="button-primary">Huur een bedrijfswagen</a>
                <img src="assets/images/car-rent-header-image-2.png" alt="">
                <img src="assets/images/header-block-background.svg" alt="" class="background-header-element">
 
            </div>
        </div>
    </header>
 
    <main>
    <h2 class="section-title">Populaire auto's</h2>
    <div class="cars">
        <?php foreach ($cars as $car): ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= htmlspecialchars($car['brand']) ?></h3>
                    <div class="car-type">
                        <?= htmlspecialchars($car['name']) ?>
                    </div>
                </div>
                <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt="">?</span>
                    <span><img src="assets/images/icons/car.svg" alt="">?</span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt="">?</span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?= number_format($car['price_per_day'], 2, ',', '.') ?></span> / dag</span>
                    <a href="/car-detail?id=<?= $car['id'] ?>" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <h2 class="section-title">Aanbevolen auto's</h2>
    <div class="cars">
        <?php for ($i = 4; $i <= 11; $i++) : ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3>Koenigegg</h3>
                    <div class="car-type">
                        Sport
                    </div>
                </div>
                <img src="assets/images/products/car%20(<?= $i ?>).svg" alt="">
                <div class="car-specification">
                    <span><img src="assets/images/icons/gas-station.svg" alt="">90l</span>
                    <span><img src="assets/images/icons/car.svg" alt="">Schakel</span>
                    <span><img src="assets/images/icons/profile-2user.svg" alt="">2 People</span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€249,00</span> / dag</span>
                    <a href="/car-detail" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="show-more">
        <a class="button-primary" href="#">Toon alle</a>
    </div>
    </main>
 
<?php require "includes/footer.php" ?>