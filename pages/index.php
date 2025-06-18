<?php
require "includes/header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$file = "pages/" . basename($page) . ".php";

if (file_exists($file)) {
    include $file;
} else {
    include "pages/404.php";
}

require "includes/footer.php";
