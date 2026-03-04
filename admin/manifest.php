<?php
header('Content-Type: application/json');
include __DIR__ . '/../includes/db.php';


// ensure helper functions available
if (!function_exists('setting')) {
    include __DIR__ . '/../includes/db.php';
}

echo json_encode([
  'name' => setting('admin_app_name','Menma Shop Admin'),
  'short_name' => setting('admin_app_short_name','Menma Admin'),
  'start_url' => '/admin/index.php',
  'scope' => '/admin/',
  'display' => 'standalone',
  'background_color' => '#ffffff',
  'theme_color' => setting('admin_theme_color','#1a1a1a'),
  'description' => 'PWA pour l\'interface d\'administration de Menma Shop (espace /admin/)',
  'icons' => [
      ['src'=>'/assets/icons/admin-192.png','sizes'=>'192x192','type'=>'image/png'],
      ['src'=>'/assets/icons/admin-512.png','sizes'=>'512x512','type'=>'image/png'],
  ]
], JSON_PRETTY_PRINT);


