<?php
// En-têtes anti-cache supplémentaires au cas où ce fichier est inclus directement
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration | Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/admin-responsive.css">
    <link rel="manifest" href="/admin/manifest.php">
    <link rel="apple-touch-icon" href="/assets/icons/admin-192.png">
    <meta name="theme-color" content="<?= htmlspecialchars(setting('admin_theme_color','#2b6cb0')) ?>">
</head>
<body>

<nav class="nav-admin">
    <?php
    if (!function_exists('setting')) {
        include __DIR__ . '/db.php';
    }
    $appName = setting('admin_app_name','STORE ADMIN');
    ?>
    <a href="index.php" class="logo"><?= htmlspecialchars($appName) ?><span>ADMIN</span></a>
    
    <button class="menu-toggle" id="menuToggle" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <div class="menu-admin" id="menuAdmin">
        <?php if (isset($_SESSION['admin_username'])): ?>
            <span class="admin-user">Bonjour, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
        <?php endif; ?>

        <a href="index.php" title="Liste des produits"><i class="fas fa-th-list"></i> <span>Produits</span></a>
        <a href="add_product.php" title="Ajouter un produit"><i class="fas fa-plus-circle"></i> <span>Ajouter</span></a>
        <a href="add_comment.php" title="Ajouter un avis client"><i class="fas fa-star"></i> <span>Avis</span></a>
        <a href="stats.php" title="Statistiques"><i class="fas fa-chart-line"></i> <span>Stats</span></a>
        <a href="orders.php" title="Commandes"><i class="fas fa-truck"></i> <span>Commandes</span></a>
        <a href="settings.php" title="Réglages"><i class="fas fa-cog"></i> <span>Réglages</span></a>
        <a href="admins.php" title="Admins"><i class="fas fa-users"></i> <span>Admins</span></a>
        <a href="../index.php" target="_blank" title="Voir le site public"><i class="fas fa-eye"></i> <span>Public</span></a>
        <!-- bouton copie lien public dans le menu -->
        <button id="copyMenuLinkBtn" class="btn-copy-link small" title="Copier le lien public">
            <i class="fas fa-link"></i>
        </button>
        <a href="logout.php" class="logout" title="Déconnexion"><i class="fas fa-power-off"></i> <span>Déco</span></a>
    </div>
</nav>

<script>document.addEventListener('DOMContentLoaded',function(){const t=document.getElementById('menuToggle'),m=document.getElementById('menuAdmin');if(t&&m){t.addEventListener('click',e=>{e.stopPropagation(),t.classList.toggle('active'),m.classList.toggle('active')});m.querySelectorAll('a').forEach(e=>{e.addEventListener('click',()=>{t.classList.remove('active'),m.classList.remove('active')})});document.addEventListener('click',e=>{!t.contains(e.target)&&!m.contains(e.target)&&(t.classList.remove('active'),m.classList.remove('active'))})}});</script>

<div class="admin-wrapper">