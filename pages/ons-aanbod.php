<?php
// Include the header for the page
require_once __DIR__ . '/../includes/header.php';
// Include the database connection file
require_once __DIR__ . '/../database/connection.php';

// Build the base query to select all cars
$query = "SELECT * FROM car WHERE 1=1";
$params = [];

// If a brand filter is set, add it to the query
if (!empty($_GET['brand'])) {
    $query .= " AND brand LIKE :brand";
    $params[':brand'] = '%' . $_GET['brand'] . '%';
}

// If a minimum price is set, add it to the query
if (!empty($_GET['min_price'])) {
    $query .= " AND price_per_day >= :min_price";
    $params[':min_price'] = $_GET['min_price'];
}

// If no minimum price is set, show only cars with price_per_day >= 100 by default
if (empty($_GET['min_price'])) {
    $query .= " AND price_per_day >= 100";
}

// If a maximum price is set, add it to the query
if (!empty($_GET['max_price'])) {
    $query .= " AND price_per_day <= :max_price";
    $params[':max_price'] = $_GET['max_price'];
}

// Prepare and execute the query with the parameters
$stmt = $pdo->prepare($query);
$stmt->execute($params);
// Fetch all cars that match the filters
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="padding: 20px; max-width: 1200px; margin: auto;">
    <h2>Ons aanbod</h2>

    <!-- Filter form for searching cars by brand and price -->
    <form method="GET" style="margin-bottom: 30px; display: flex; gap: 20px; flex-wrap: wrap; align-items: flex-end;">
        <div>
            <label>Merk:</label><br><br>
            <!-- Input for car brand filter -->
            <input type="text" name="brand" value="<?= isset($_GET['brand']) ? htmlspecialchars($_GET['brand']) : '' ?>" placeholder="Bijv. Audi">
        </div>

        <div>
            <label>Min. prijs per dag:</label><br><br>
            <!-- Input for minimum price filter -->
            <input type="number" name="min_price" value="<?= isset($_GET['min_price']) ? (int)$_GET['min_price'] : '' ?>">
        </div>

        <div>
            <label>Max. prijs per dag:</label><br><br>
            <!-- Input for maximum price filter -->
            <input type="number" name="max_price" value="<?= isset($_GET['max_price']) ? (int)$_GET['max_price'] : '' ?>">
        </div>

        <div>
            <!-- Submit button for filter form -->
            <button type="submit" class="button-primary">Filter</button>
        </div>
    </form>

    <div class="cars">
        <!-- Show the list of cars if any are found -->
        <?php if (count($cars) > 0): ?>
            <?php foreach ($cars as $car): ?>
                <div class="car-details">
                    <div class="car-brand">
                        <h3><?= htmlspecialchars($car['brand']) ?></h3>
                        <div class="car-type"> <?= htmlspecialchars($car['name']) ?> </div>
                    </div>
                    <img src="/car_renting/<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                    <div class="car-specification">
                     <span><img src="/car_renting/assets/images/icons/gas-station.svg" alt=""> <?= htmlspecialchars($car['fuel'] ?? 'n.v.t.') ?></span>
                     <span><img src="/car_renting/assets/images/icons/car.svg" alt=""> <?= htmlspecialchars($car['transmission'] ?? 'n.v.t.') ?></span>
                     <span><img src="/car_renting/assets/images/icons/profile-2user.svg" alt=""> <?= htmlspecialchars($car['capacity'] ?? 'n.v.t.') ?> personen</span>
                    </div>
                    <div class="rent-details">
                        <span><span class="font-weight-bold">&euro;<?= number_format($car['price_per_day'], 2, ',', '.') ?></span> / dag</span>
                        <a href="/car_renting/car-detail.php?id=<?= $car['id'] ?>" class="button-primary">Bekijk nu</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen auto's gevonden voor de opgegeven filters.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
