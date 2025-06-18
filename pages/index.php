<?php require "includes/header.php"; ?>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$file = "pages/" . basename($page) . ".php";

if (file_exists($file)) {
    include $file;
} else {
    include "pages/404.php";
}
?>


<div id="loginModal" class="modal hidden" aria-hidden="true">
    <div class="modal-content">
        <button class="modal-close">×</button>
    
        <h2>Login</h2>
        <form>
            <label for="email">E-mail:</label>
            <input type="email" id="email" required>
            
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" required>
            
            <button type="submit">Inloggen</button>
        </form>
    </div>
</div>

<?php require "includes/footer.php"; ?>
