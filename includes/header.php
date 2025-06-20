<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rydr</title>
    <link rel="stylesheet" href="/car_renting/assets/css/main.css">
    <link rel="icon" type="image/png" href="/car_renting/assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <meta name="description" content="Rydr - Snel en eenvoudig een auto huren. Bekijk ons aanbod van huurauto's en bedrijfswagens.">
    <meta name="keywords" content="auto huren, huurauto, bedrijfswagen, goedkoop, Rydr, autoverhuur, Rotterdam">
    <meta name="robots" content="index, follow">
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/car_renting/index.php">Rydr.</a>
    </div>

    <form action="/car_renting/pages/ons-aanbod.php" method="get" style="display: flex; align-items: center; gap: 8px;">
        <input type="search" name="brand" placeholder="Zoek op merk..." style="padding: 6px 10px; border-radius: 6px; border: 1px solid #ccc;">
        <button type="submit" style="background: none; border: none; cursor: pointer;">
            <img src="/car_renting/assets/images/icons/search-normal.svg" alt="Zoek" class="search-icon" style="width: 22px; height: 22px;">
        </button>
    </form>

    <nav>
        <ul>
            <li><a href="/car_renting/pages/home.php">Home</a></li>
            <li><a href="/car_renting/pages/ons-aanbod.php">Ons aanbod</a></li>
            <li><a href="/car_renting/pages/over-ons.php">Overons</a></li>
        </ul>
    </nav>

  <div class="menu">
    <?php if (isset($_SESSION['id'])): ?>
        <div class="account" style="position: relative;">
            <img src="/car_renting/assets/images/profil.png" alt="Account" id="accountIcon"
                 style="cursor: pointer; width: 40px; height: 40px; border-radius: 50%;">

            <div class="account-dropdown" id="dropdownMenu"
                 style="display: none; position: absolute; right: 0; top: 45px; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 10px; width: 190px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 100;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    <?php if (basename($_SERVER['PHP_SELF']) === 'account.php'): ?>
                        <li style="margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="/car_renting/assets/images/icons/car.svg" alt="Home"
                                 style="width: 18px; margin-right: 8px;">
                            <a href="/car_renting/index.php"
                               style="text-decoration: none; color: #333;">Terug naar Home</a>
                        </li>
                    <?php else: ?>
                        <li style="margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="/car_renting/assets/images/icons/profile-2user.svg" alt="Account"
                                 style="width: 18px; margin-right: 8px;">
                            <a href="/car_renting/pages/account.php"
                               style="text-decoration: none; color: #333;">Naar account</a>
                        </li>
                    <?php endif; ?>
                    <li style="display: flex; align-items: center;">
                        <img src="/car_renting/assets/images/icons/logout.svg" alt="Logout"
                             style="width: 18px; margin-right: 8px;">
                        <a href="/car_renting/actions/logout.php"
                           style="text-decoration: none; color: #333;">Uitloggen</a>
                    </li>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="auth-dropdown-wrapper" style="position: relative;">
            <button id="authToggle" class="button-primary" style="cursor: pointer;">Start met huren</button>
            <div id="authDropdown"
                 style="display: none; position: absolute; top: 45px; right: 0; background: white; border: 1px solid #ddd; border-radius: 8px; padding: 10px; width: 190px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 100;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 8px; display: flex; align-items: center;">
                        <img src="/car_renting/assets/images/icons/profile-2user.svg" alt="Login"
                             style="width: 18px; margin-right: 8px;">
                        <a href="/car_renting/pages/login-form.php"
                           style="text-decoration: none; color: #333;">Inloggen</a>
                    </li>
                    <li style="display: flex; align-items: center;">
                        <img src="/car_renting/assets/images/icons/setting.svg" alt="Register"
                             style="width: 18px; margin-right: 8px;">
                        <a href="/car_renting/pages/register-form.php"
                           style="text-decoration: none; color: #333;">Account aanmaken</a>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
    </div>



<div class="content">

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Dropdown for logged in user
    const icon = document.getElementById("accountIcon");
    const dropdown = document.getElementById("dropdownMenu");

    if (icon && dropdown) {
        icon.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function (e) {
            if (!dropdown.contains(e.target) && e.target !== icon) {
                dropdown.style.display = "none";
            }
        });
    }

    // Dropdown for not logged in
    const authToggle = document.getElementById("authToggle");
    const authDropdown = document.getElementById("authDropdown");

    if (authToggle && authDropdown) {
        authToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            authDropdown.style.display = authDropdown.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function (e) {
            if (!authDropdown.contains(e.target) && e.target !== authToggle) {
                authDropdown.style.display = "none";
            }
        });
    }
});
</script>
