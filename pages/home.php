<?php
// Include the header for the page
require_once __DIR__ . '/../includes/header.php';
// Include the database connection file
require_once __DIR__ . '/../database/connection.php';

try {
    // Query the database for the first 8 cars
    $stmt = $pdo->query("SELECT * FROM car LIMIT 8");
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // If there is an error, set cars to an empty array
    $cars = [];
}
?>
<header>
    <div class="advertorials">
        <div class="advertorial">
            <!-- Main promotional message -->
            <h2>Hét platform om een auto te huren</h2>
            <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
            <!-- Link to the car offer page -->
            <a href="/car_renting/pages/ons-aanbod.php" class="button-primary">Huur nu een auto</a>
            <img src="/car_renting/assets/images/car-rent-header-image-1.png" alt="">
            <img src="/car_renting/assets/images/header-circle-background.svg" alt="" class="background-header-element">
        </div>
        <div class="advertorial">
            <!-- Promotional message for business vehicles -->
            <h2>Wij verhuren ook bedrijfswagens</h2>
            <p>Voor een vaste lage prijs met prettig voordelen.</p>
            <a href="#" class="button-primary">Huur een bedrijfswagen</a>
            <img src="/car_renting/assets/images/car-rent-header-image-2.png" alt="">
            <img src="/car_renting/assets/images/header-block-background.svg" alt="" class="background-header-element">
        </div>
    </div>
</header>

<main>
    <!-- Show success or error message if set in session -->
    <?php if (isset($_SESSION['success'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; margin: 20px auto; max-width: 600px; border: 1px solid #c3e6cb; border-radius: 6px;">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 15px; margin: 20px auto; max-width: 600px; border: 1px solid #f5c6cb; border-radius: 6px;">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <h2 class="section-title">Populaire auto's</h2>
    <div class="cars">
        <!-- Loop through each car and display its details -->
        <?php foreach ($cars as $car): ?>
            <div class="car-details">
                <div class="car-brand">
                    <!-- Show car brand -->
                    <h3><?= htmlspecialchars($car['brand']) ?></h3>
                    <!-- Show car name/type -->
                    <div class="car-type"><?= htmlspecialchars($car['name']) ?></div>
                </div>
                <!-- Show car image -->
                <img src="/car_renting/<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                <div class="car-specification">
                    <!-- Show car fuel type -->
                    <span><img src="/car_renting/assets/images/icons/gas-station.svg" alt=""> <?= htmlspecialchars($car['fuel'] ?? 'n.v.t.') ?></span>
                    <!-- Show car transmission type -->
                    <span><img src="/car_renting/assets/images/icons/car.svg" alt=""> <?= htmlspecialchars($car['transmission'] ?? 'n.v.t.') ?></span>
                    <!-- Show car capacity -->
                    <span><img src="/car_renting/assets/images/icons/profile-2user.svg" alt=""> <?= htmlspecialchars($car['capacity'] ?? 'n.v.t.') ?> personen</span>
                </div>
                <div class="rent-details">
                    <!-- Show car price per day -->
                    <span><span class="font-weight-bold">€<?= number_format($car['price_per_day'], 2, ',', '.') ?></span> / dag</span>
                    <!-- Link to car detail page -->
                    <a href="/car_renting/pages/car-detail.php?id=<?= $car['id'] ?>" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <div class="show-more">
        <a class="button-primary" href="/car_renting/pages/ons-aanbod.php">Toon alle</a>
    </div>
</main>

<?php // Include the footer for the page
require_once __DIR__ . '/../includes/footer.php'; ?>
