<?php
$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard';

switch ($url) {
    case 'projek':
        include "views/projek.php"; // atau 'controllers/projek.php' jika logic MVC
        break;
    case 'dashboard':
        include "views/dashboard.php";
        break;
    // tambahkan lainnya...
    default:
        echo "Halaman tidak ditemukan!";
        break;
}


require_once('Controllers/Page.php');

if (isset($_GET['url'])) {
    $file = $_GET['url'];
} else {
    header("Location: ?url=home");
    exit();
}


$title = strtoupper($file);
$home = new Page("$title", "$file");
$home->call();
