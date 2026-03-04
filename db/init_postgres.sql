-- Schéma PostgreSQL initial pour Menma-Shop

CREATE TABLE IF NOT EXISTS produits (
    id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nom varchar(255) NOT NULL,
    prix numeric(10,2) NOT NULL DEFAULT 0.00,
    stock integer NOT NULL DEFAULT 0,
    description text,
    image_url varchar(1024),
    image_url2 varchar(1024),
    image_url3 varchar(1024),
    image_url4 varchar(1024),
    image_url5 varchar(1024),
    video_url varchar(1024),
    created_at timestamp with time zone DEFAULT now()
);

CREATE TABLE IF NOT EXISTS commentaires (
    id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_produit integer NOT NULL REFERENCES produits(id) ON DELETE CASCADE,
    nom_client varchar(255) NOT NULL,
    note integer,
    texte text,
    created_at timestamp with time zone DEFAULT now()
);

CREATE TABLE IF NOT EXISTS commandes (
    id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_produit integer NOT NULL REFERENCES produits(id),
    nom_client varchar(255) NOT NULL,
    adresse_livraison text NOT NULL,
    statut_livraison varchar(50) NOT NULL DEFAULT 'en attente',
    visible boolean NOT NULL DEFAULT true,
    created_at timestamp with time zone DEFAULT now()
);

-- Table de configuration clé/valeur pour personnalisation
CREATE TABLE IF NOT EXISTS settings (
    key   varchar(100) PRIMARY KEY,
    value text NOT NULL
);

-- valeurs par défaut si inexistantes
INSERT INTO settings(key,value) VALUES
('hero_title','LIVRAISON GRATUITE'),
('hero_subtitle','Commandez sur WhatsApp • Payez à la livraison'),
('shop_name','Menma Shop'),
('whatsapp_number','224625968097'),
('admin_app_name','Menma Shop Admin'),
('admin_app_short_name','Menma Admin'),
('admin_theme_color','#1a1a1a')
ON CONFLICT (key) DO NOTHING;

-- Indexes d'exemple
CREATE INDEX IF NOT EXISTS idx_commentaires_id_produit ON commentaires(id_produit);
CREATE INDEX IF NOT EXISTS idx_commandes_id_produit ON commandes(id_produit);

-- Table des administrateurs pour la gestion des accès
CREATE TABLE IF NOT EXISTS admins (
    id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    username varchar(100) NOT NULL UNIQUE,
    password_hash varchar(255) NOT NULL,
    failed_attempts integer NOT NULL DEFAULT 0,
    last_failed_at timestamp with time zone,
    created_at timestamp with time zone DEFAULT now()
);

-- Active l'extension pgcrypto pour le hachage des mots de passe
CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- Insertion de l'admin par défaut (Mot de passe: Djil45ll)
INSERT INTO admins (username, password_hash)
VALUES ('Djibril', crypt('Djil45ll', gen_salt('bf')))
ON CONFLICT (username) DO UPDATE 
SET password_hash = crypt('Djil45ll', gen_salt('bf'));
