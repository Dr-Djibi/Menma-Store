<?php
if (!function_exists('setting')) {
    include __DIR__ . '/db.php';
}
$shopName = setting('shop_name', 'Menma Shop');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($shopName) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container nav-container">
            <a href="index.php" class="logo"><?= htmlspecialchars($shopName) ?> <span>Shop</span></a>
            <button class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="#products">Produits</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">