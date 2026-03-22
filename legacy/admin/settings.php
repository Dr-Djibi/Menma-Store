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

<?php
$icon192 = is_file(__DIR__ . '/../assets/icons/admin-192.png') ? '../assets/icons/admin-192.png' : null;
$icon512 = is_file(__DIR__ . '/../assets/icons/admin-512.png') ? '../assets/icons/admin-512.png' : null;
$themeColor = htmlspecialchars($settings['admin_theme_color'] ?: '#2b6cb0');
?>

<div class="admin-card settings">
    <h3>Paramètres du site</h3>
    <?php if (isset($message)): ?><p class="success"><?= $message ?></p><?php endif; ?>

    <div class="settings-grid">
        <div class="settings-form">
            <form class="admin-form" method="post" enctype="multipart/form-data">
                <fieldset class="form-section">
                    <legend>Paramètres publics</legend>
                    <label>Texte héros<br>
                        <input type="text" name="hero_title" value="<?= htmlspecialchars($settings['hero_title']) ?>">
                    </label>
                    <label>Sous‑texte héros<br>
                        <input type="text" name="hero_subtitle" value="<?= htmlspecialchars($settings['hero_subtitle']) ?>">
                    </label>
                    <label>Nom de la boutique<br>
                        <input type="text" name="shop_name" value="<?= htmlspecialchars($settings['shop_name']) ?>">
                    </label>
                    <label>Numéro WhatsApp<br>
                        <input type="text" name="whatsapp_number" value="<?= htmlspecialchars($settings['whatsapp_number']) ?>" placeholder="+212...">
                    </label>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Paramètres de l'application admin</legend>
                    <label>Nom de l'application admin<br>
                        <input type="text" name="admin_app_name" value="<?= htmlspecialchars($settings['admin_app_name']) ?>">
                    </label>
                    <label>Nom court PWA<br>
                        <input type="text" name="admin_app_short_name" value="<?= htmlspecialchars($settings['admin_app_short_name']) ?>">
                    </label>
                    <label>Couleur du thème<br>
                        <input type="color" name="admin_theme_color" value="<?= htmlspecialchars($settings['admin_theme_color']) ?>">
                    </label>
                    <label>Icône 192px<br>
                        <input type="file" name="icon_192" accept="image/png">
                    </label>
                    <label>Icône 512px<br>
                        <input type="file" name="icon_512" accept="image/png">
                    </label>
                </fieldset>

                <button class="btn-save">Enregistrer tous les paramètres</button>
            </form>
        </div>

        <aside class="settings-preview">
            <h4>Aperçu</h4>
            <div class="preview-row">
                <div class="preview-icons">
                    <?php if ($icon192): ?>
                        <div class="icon-box"><img src="<?= $icon192 ?>" alt="Icon 192"></div>
                    <?php else: ?>
                        <div class="icon-box placeholder">192</div>
                    <?php endif; ?>

                    <?php if ($icon512): ?>
                        <div class="icon-box large"><img src="<?= $icon512 ?>" alt="Icon 512"></div>
                    <?php else: ?>
                        <div class="icon-box large placeholder">512</div>
                    <?php endif; ?>
                </div>

                <div class="preview-meta">
                    <div class="app-name"><?= htmlspecialchars($settings['admin_app_name'] ?: 'STORE ADMIN') ?></div>
                    <div class="app-short"><?= htmlspecialchars($settings['admin_app_short_name'] ?: 'ADMIN') ?></div>
                    <div class="theme-swatch" style="background: <?= $themeColor ?>;"></div>
                </div>
            </div>
            <p class="muted">Les icônes seront utilisées pour la PWA et la barre d'outils.</p>
            <a href="../index.php" target="_blank" class="btn-public"><i class="fas fa-eye"></i> Voir la boutique</a>
        </aside>
    </div>
</div>

<?php include __DIR__.'/../includes/footer_admin.php'; ?>