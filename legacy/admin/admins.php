<?php
session_start();
if (!isset($_SESSION['admin_loge'])) header('Location: login.php');
include '../includes/db.php';
include __DIR__.'/../includes/header_admin.php';

$admins = $pdo->query('SELECT id,username,created_at FROM admins ORDER BY username')->fetchAll();
?>
<div class="admin-card">
  <h3>Comptes administrateurs</h3>
  <table>
    <tr><th>Utilisateur</th><th>Créé le</th></tr>
    <?php foreach($admins as $a): ?>
      <tr>
        <td><?= htmlspecialchars($a['username']) ?></td>
        <td><?= htmlspecialchars($a['created_at']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php include __DIR__.'/../includes/footer_admin.php'; ?>