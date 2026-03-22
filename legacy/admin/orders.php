<?php
session_start();
if (!isset($_SESSION['admin_loge'])) header('Location: login.php');
include '../includes/db.php';
include __DIR__.'/../includes/header_admin.php';

// archivage manuel
if (isset($_GET['archive_all'])) {
    $pdo->exec("UPDATE commandes SET visible = false
                 WHERE statut_livraison='Expédié'
                   AND created_at < now() - interval '24 hours'");
    $msg = 'Commandes expédiées plus de 24 h archivées.';
}

$orders = $pdo->query("SELECT * FROM commandes
                       WHERE visible = true
                       ORDER BY id DESC")->fetchAll();
?>
<div class="admin-card">
  <h3>Commandes</h3>
  <?php if (isset($msg)): ?><p class="success"><?= $msg ?></p><?php endif; ?>
  <a href="?archive_all=1" class="btn-save"
     onclick="return confirm('Archiver toutes les commandes expédiées ?')">
     Archiver expédiées >24 h
  </a>
  <div class="table-responsive">
    <table>
      <thead><tr><th>Client</th><th>Statut</th><th>Actions</th></tr></thead>
      <tbody>
      <?php foreach($orders as $com): ?>
        <tr>
          <td><?= htmlspecialchars($com['nom_client']) ?></td>
          <td><span class="status-badge"><?= htmlspecialchars($com['statut_livraison']) ?></span></td>
          <td class="actions-cell">
            <a href="update_livraison.php?id=<?= $com['id'] ?>&statut=Expédié" class="btn-action btn-primary">
              <i class="fas fa-shipping-fast"></i> Expédier
            </a>
            <a href="archive_order.php?id=<?= $com['id'] ?>"
               onclick="return confirm('Archiver cette commande ?')" class="btn-action btn-danger">
              <i class="fas fa-archive"></i> Archiver
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__.'/../includes/footer_admin.php'; ?>