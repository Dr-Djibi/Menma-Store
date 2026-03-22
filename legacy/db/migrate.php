<?php
/**
 * db/migrate.php
 * Script de migration/vérification des tables et colonnes.
 * S'exécute une seule fois la première connexion.
 */

function run_migrations($pdo) {
    // Flag pour savoir si les migrations ont déjà roulé
    $flagFile = __DIR__ . '/.migrations_done';
    
    // Si le flag existe, les migrations ont déjà roulé
    if (file_exists($flagFile)) {
        return;
    }

    try {
        // 1. Vérifier si la colonne 'visible' existe sur 'commandes'
        $stmt = $pdo->query("
            SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name='commandes' AND column_name='visible'
        ");
        if ($stmt->rowCount() === 0) {
            // Colonnemanquante, l'ajouter
            $pdo->exec("ALTER TABLE commandes ADD COLUMN visible boolean NOT NULL DEFAULT true");
            echo "[Migration] Colonne 'visible' ajoutée à 'commandes'.\n";
        }

        // 2. Vérifier si la table 'settings' existe
        $stmt = $pdo->query("
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_name='settings'
        ");
        if ($stmt->rowCount() === 0) {
            // Table manquante, la créer
            $pdo->exec("
                CREATE TABLE settings (
                    key   varchar(100) PRIMARY KEY,
                    value text NOT NULL
                )
            ");
            echo "[Migration] Table 'settings' créée.\n";

            // Insérer les valeurs par défaut
            $defaults = [
                'hero_title' => 'LIVRAISON GRATUITE',
                'hero_subtitle' => 'Commandez sur WhatsApp • Payez à la livraison',
                'shop_name' => 'Menma Shop',
                'whatsapp_number' => '224625968097',
                'admin_app_name' => 'Menma Shop Admin',
                'admin_app_short_name' => 'Menma Admin',
                'admin_theme_color' => '#1a1a1a'
            ];
            
            $stmt = $pdo->prepare(
                'INSERT INTO settings(key,value) VALUES(?,?)'
            );
            foreach ($defaults as $k => $v) {
                $stmt->execute([$k, $v]);
            }
            echo "[Migration] Valeurs par défaut insérées dans 'settings'.\n";
        }

        // 3. Vérifier si les valeurs par défaut sont présentes dans 'settings'
        $keys = ['hero_title','hero_subtitle','shop_name','whatsapp_number',
                 'admin_app_name','admin_app_short_name','admin_theme_color'];
        $defaults = [
            'hero_title' => 'LIVRAISON GRATUITE',
            'hero_subtitle' => 'Commandez sur WhatsApp • Payez à la livraison',
            'shop_name' => 'Menma Shop',
            'whatsapp_number' => '224625968097',
            'admin_app_name' => 'Menma Shop Admin',
            'admin_app_short_name' => 'Menma Admin',
            'admin_theme_color' => '#1a1a1a'
        ];
        
        foreach ($keys as $k) {
            $stmt = $pdo->prepare('SELECT value FROM settings WHERE key = ?');
            $stmt->execute([$k]);
            if ($stmt->rowCount() === 0) {
                $stmt = $pdo->prepare('INSERT INTO settings(key,value) VALUES(?,?)');
                $stmt->execute([$k, $defaults[$k]]);
                echo "[Migration] Clé '$k' insérée avec valeur par défaut.\n";
            }
        }

        // Marquer les migrations comme complétées
        if (!file_exists($flagFile)) {
            file_put_contents($flagFile, date('Y-m-d H:i:s'));
            echo "[Migration] Migrations complétées avec succès.\n";
        }

    } catch (Exception $e) {
        // Log l'erreur mais ne break pas l'app
        error_log('[Migration Error] ' . $e->getMessage());
    }
}
