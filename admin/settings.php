<?php
session_start();
if (!isset($_SESSION['admin_loge'])) header('Location: login.php');

include '../includes/db.php';
include __DIR__.'/../includes/header_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        'hero_title','hero_subtitle','shop_name','whatsapp_number',
        'admin_app_name','admin_app_short_name','admin_theme_color'
    ];
    foreach ($fields as $k) {
        if (isset($_POST[$k])) {
            set_setting($k, trim($_POST[$k]));
        }
    }

    // upload d'une icône (192/512) si fourni
    if (!empty($_FILES['icon_192']['tmp_name'])) {
        move_uploaded_file(
            $_FILES['icon_192']['tmp_name'],
            __DIR__ . '/../assets/icons/admin-192.png'
        );
    }
    if (!empty($_FILES['icon_512']['tmp_name'])) {
        move_uploaded_file(
            $_FILES['icon_512']['tmp_name'],
            __DIR__ . '/../assets/icons/admin-512.png'
        );
    }

    $message = 'Paramètres enregistrés.';
}

$settings = [];
foreach (['hero_title','hero_subtitle','shop_name','whatsapp_number',
          'admin_app_name','admin_app_short_name','admin_theme_color'] as $k) {
    $settings[$k] = setting($k);
}
?>

<div class="admin-card">
    <h3>Paramètres du site</h3>
    <?php if (isset($message)): ?><p class="success"><?= $message ?></p><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <label>Texte héros<br>
            <input name="hero_title" value="<?= htmlspecialchars($settings['hero_title']) ?>">
        </label><br>
        <label>Sous‑texte héros<br>
            <input name="hero_subtitle" value="<?= htmlspecialchars($settings['hero_subtitle']) ?>">
        </label><br>
        <label>Nom de la boutique<br>
            <input name="shop_name" value="<?= htmlspecialchars($settings['shop_name']) ?>">
        </label><br>
        <label>Numéro WhatsApp<br>
            <input name="whatsapp_number" value="<?= htmlspecialchars($settings['whatsapp_number']) ?>">
        </label><br>
        <hr>
        <label>Nom de l'application admin<br>
            <input name="admin_app_name" value="<?= htmlspecialchars($settings['admin_app_name']) ?>">
        </label><br>
        <label>Nom court PWA<br>
            <input name="admin_app_short_name" value="<?= htmlspecialchars($settings['admin_app_short_name']) ?>">
        </label><br>
        <label>Couleur du thème<br>
            <input type="color" name="admin_theme_color" value="<?= htmlspecialchars($settings['admin_theme_color']) ?>">
        </label><br>
        <label>Icône 192px<br>
            <input type="file" name="icon_192" accept="image/png">
        </label><br>
        <label>Icône 512px<br>
            <input type="file" name="icon_512" accept="image/png">
        </label><br>
        <button class="btn-save">Enregistrer</button>
    </form>
</div>

<?php include __DIR__.'/../includes/footer_admin.php'; ?>