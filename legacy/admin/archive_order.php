<?php
session_start();
if (!isset($_SESSION['admin_loge'])) header('Location: login.php');
include '../includes/db.php';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("UPDATE commandes SET visible = false WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
}
header('Location: orders.php');
