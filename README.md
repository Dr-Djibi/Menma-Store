# Menma-Shop — Instructions de déploiement

Ce dépôt contient une petite boutique PHP. Cette configuration prépare le projet pour un déploiement sur Render en utilisant Docker et PostgreSQL.

## Local (docker-compose)

1. Copier `.env.example` en `.env` et adapter les valeurs si besoin.
2. Lancer les services :

   docker-compose up --build

3. Ouvrir http://localhost:8080

## Déploiement sur Render

1. Pousser le repo sur GitHub.
2. Créer un service web sur Render en choisissant le déploiement via Docker (ou utiliser `render.yaml`).
3. Définir les variables d'environnement : `DB_DRIVER`, `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`, `APP_ENV`.
4. N'oubliez pas d'initialiser la base PostgreSQL avec `db/init_postgres.sql`.

## Notes techniques

- `includes/db.php` utilise désormais les variables d'environnement et supporte `pgsql` et `mysql`.
- L'image Docker installe `pdo_pgsql` pour communiquer avec PostgreSQL.
- La base comporte maintenant une table `settings` (clé/valeur) pour stocker des éléments personnalisables : texte de la bannière, nom de la boutique, numéro WhatsApp, informations de l'application admin, etc. Vous pouvez modifier ces réglages depuis le nouvel onglet *Réglages* du panneau d'administration.
- Le schéma `db/init_postgres.sql` a été étendu :
  * colonne `visible boolean` sur `commandes` (pour archiver les commandes sans les supprimer) ;
  * création de `settings` ;
  * insertion de valeurs par défaut pour les clés principales.
  Si vous avez déjà une base en production, exécutez les requêtes suivantes pour mettre à jour :

  ```sql
  ALTER TABLE commandes ADD COLUMN visible boolean NOT NULL DEFAULT true;
  CREATE TABLE IF NOT EXISTS settings (
      key varchar(100) PRIMARY KEY,
      value text NOT NULL
  );
  -- puis insérer les valeurs par défaut (copier depuis init_postgres.sql)
  ```

- Une page d'administration `admin/settings.php` permet à un administrateur logué de modifier le texte d'en-tête, le nom de la boutique, le numéro WhatsApp, le nom/couleur/icône de l'application PWA, etc. Les modifications s'appliquent immédiatement sur le site public.
- Il existe désormais des écrans séparés pour la gestion des commandes (`admin/orders.php`) et la liste des administrateurs (`admin/admins.php`). Les commandes expédiées peuvent être "archivées" (masquées) automatiquement ou manuellement.
- Pour créer un administrateur, exécuter (dans le conteneur ou local) :

  php admin/create_admin.php <username> <password>

  Le mot de passe sera haché automatiquement.

- Les prix sont affichés en FGn (Franc guinéen) sans décimales ; les valeurs envoyées par les formulaires admin sont arrondies à l'entier le plus proche.

- PWA: le tableau de bord d'administration (seulement l'espace `/admin/`) possède désormais `admin/manifest.json`, `admin/service-worker.js` et `admin/offline.html` pour un mode hors-ligne basique. Le service worker est enregistré depuis `includes/footer_admin.php` avec le scope `/admin/`.

