<?php require_once __DIR__ . '/includes/header.php'; ?> <!-- Include the header file -->
<?php
require_once __DIR__ . '/database/connection.php'; // Include the database connection

try {
    $stmt = $pdo->query("SELECT * FROM car ORDER BY id DESC LIMIT 3"); // Query the 3 most recent cars
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all car records as associative array
} catch (Exception $e) {
    $cars = []; // If query fails, set cars to empty array
}
?>
<main style="max-width: 1000px; margin: 0 auto; padding: 2em 1em;"> <!-- Main content container -->
    <!-- Hero Section -->
    <section style="text-align: center; margin-bottom: 2.5em;"> <!-- Hero section -->
        <h1 style="font-size: 2.5em; color: #3563e9; margin-bottom: 0.3em;">🚗 Welcome to Rydr</h1>
        <p style="font-size: 1.3em; color: #444;">Your fastest and easiest way to rent a car online.</p>
    </section>

    <!-- Featured Cars -->
    <section style="margin-bottom: 2.5em;"> <!-- Featured cars section -->
        <h2 style="text-align: center; color: #222; margin-bottom: 1.2em;">Featured Cars</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 2em; justify-content: center;"> <!-- Car cards container -->
            <?php foreach ($cars as $car): ?>
                <div style="background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 1em; width: 240px; text-align: center;"> <!-- Single car card -->
                    <img src="/car_renting/<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>" style="width: 140px; height: 90px; object-fit: contain; margin-bottom: 0.7em;"> <!-- Car image -->
                    <h3 style="margin: 0 0 0.3em 0;"><?= htmlspecialchars($car['brand']) ?> <?= htmlspecialchars($car['name']) ?></h3> <!-- Car brand and name -->
                    <p style="color: #3563e9; font-weight: bold;">€<?= number_format($car['price_per_day'], 2, ',', '.') ?> / day</p> <!-- Car price per day -->
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Call to Action -->
    <section style="text-align: center; margin-bottom: 2.5em;"> <!-- Call to action section -->
        <p style="font-size: 1.1em;">Don't have an account yet?</p>
        <a href="?page=register" class="button-primary" style="margin-top: 0.5em; padding: 12px 32px; font-size: 1.1em;">Create Account</a>
    </section>

    <!-- About Us Section -->
    <section style="background: #f6f7f9; border-radius: 10px; padding: 2em 1em; text-align: center;"> <!-- About us section -->
        <h2 style="color: #3563e9; margin-bottom: 0.5em;">About Us</h2>
        <p style="max-width: 650px; margin: 0 auto; color: #444; font-size: 1.1em;">
            At Rydr, booking your next ride is fast, easy, and affordable. Choose your car, book online in minutes, and enjoy transparent pricing with no hidden fees. Experience the freedom of the road with just a few clicks!
        </p>
    </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?> <!-- Include the footer file -->
