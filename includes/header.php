<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rydr</title>
    <link rel="stylesheet" href="/rental-main/assets/css/main.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/">
            Rydr.
        </a>
    </div>
    <form action="">
        <input type="search" name="" id="" placeholder="Welke auto wilt u huren?">
        <img src="/rental-main/assets/images/icons/search-normal.svg" alt="" class="search-icon">
    </form>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/ons-aanbod">Ons aanbod</a></li>
            <li><a href="#">Hulp nodig?</a></li>
        </ul>
    </nav>

    <div class="menu">
        <?php if (isset($_SESSION['id'])): ?>
        <div class="account" style="position: relative;">
            <img src="/rental-main/assets/images/profil.png" alt="Account" id="accountIcon" style="width: 40px; height: 40px; border-radius: 50%; cursor: pointer;">
            
            <div class="account-dropdown" id="dropdownMenu" style="display: none; position: absolute; right: 0; top: 45px; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 10px; width: 180px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 100;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    if ($currentPage === "account.php"): ?>
                        <li style="margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="/rental-main/assets/images/icons/setting.svg" alt="" style="margin-right: 8px;">
                            <a href="/rental-main/index.php" style="text-decoration: none; color: #333;">Naar overzicht</a>
                        </li>
                    <?php else: ?>
                        <li style="margin-bottom: 8px; display: flex; align-items: center;">
                            <img src="/rental-main/assets/images/icons/setting.svg" alt="" style="margin-right: 8px;">
                            <a href="/rental-main/pages/account.php" style="text-decoration: none; color: #333;">Naar account</a>
                        </li>
                    <?php endif; ?>

                    <li style="display: flex; align-items: center;">
                        <img src="/rental-main/assets/images/icons/logout.svg" alt="" style="margin-right: 8px;">
                        <a href="/rental-main/actions/logout.php" style="text-decoration: none; color: #333;">Uitloggen</a>
                    </li>
                </ul>
            </div>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const icon = document.getElementById("accountIcon");
            const dropdown = document.getElementById("dropdownMenu");

            icon.addEventListener("click", function (e) {
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.style.display = "none";
                }
            });
        });
        </script>

        <?php else: ?>
            <a href="/rental-main/pages/register-form.php" class="button-primary">Start met huren</a>
        <?php endif; ?>
    </div>
</div>
<div class="content">
