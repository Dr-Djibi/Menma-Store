<?php 
include 'includes/db.php'; 
// valeurs personnalisables
$heroSubtitle = setting('hero_subtitle','Commandez sur WhatsApp • Payez à la livraison');
$whatsappNumber = setting('whatsapp_number','224625968097');

include 'includes/header.php'; 

// 1. Récupération du produit
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if (!$p) { 
    echo "<div class='container' style='padding:50px; text-align:center;'><h2>Produit introuvable.</h2><a href='index.php'>Retour à l'accueil</a></div>"; 
    include 'includes/footer.php'; exit; 
}
?>

<div class="container">
    <div class="product-detail-layout">
        
        <div class="product-visuals">
            <div id="main-display" class="main-image">
                <img src="<?= htmlspecialchars($p['image_url']) ?>" id="view-target" class="main-img">
            </div>

            <div class="thumb-list">
                <?php 
                $colonnes = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5'];
                foreach($colonnes as $col): 
                    if(!empty($p[$col])): ?>
                        <img src="<?= htmlspecialchars($p[$col]) ?>" 
                             onclick="updateView(this.src)" 
                             class="thumb-item">
                    <?php endif; 
                endforeach; ?>
            </div>
        </div>

        <div class="product-info">
            <span class="badge-shipping"><?= htmlspecialchars(setting('hero_title','LIVRAISON GRATUITE')) ?></span>
            <h1 class="product-title"><?= htmlspecialchars($p['nom']) ?></h1>
            <p class="price-big"><?= number_format($p['prix'], 0, ',', ' ') ?> FGn</p>
            
            <div class="product-details">
                <h3>Détails du produit</h3>
                <p><?= nl2br(htmlspecialchars($p['description'])) ?></p>
            </div>

            <div class="order-box">
                <h3>Commander ce produit</h3>
                
                <form action="traitement_achat.php" method="POST" id="orderForm">
                    <input type="hidden" name="id_produit" value="<?= $p['id'] ?>">
                    
                    <div class="form-group">
                        <label for="nom_client">Nom complet</label>
                        <input type="text" name="nom_client" id="nom_client" placeholder="Ex: Mamadou Diallo" required>
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse de livraison</label>
                        <input type="text" name="adresse" id="adresse" placeholder="Ville / Quartier" required>
                    </div>
                    
                    <button type="submit" class="btn-whatsapp">
                         🛒 CONFIRMER LA COMMANDE
                    </button>
                </form>
                <p class="order-note">Paiement Cash à la livraison. Une fenêtre WhatsApp s'ouvrira après confirmation.</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Changer l'image principale au clic sur une miniature
    function updateView(src) {
        document.getElementById('view-target').src = src;
    }

    // Gérer l'envoi WhatsApp ET l'envoi Database
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const nom = document.getElementById('nom_client').value;
        const adresse = document.getElementById('adresse').value;
        const produit = "<?= addslashes($p['nom']) ?>";
        const prix = "<?= number_format($p['prix'], 0, ',', ' ') ?> FGn";

        // 1. Préparer le message WhatsApp
        const shippingText = <?= json_encode(setting('hero_title','LIVRAISON GRATUITE')) ?>;
        const message = `Bonjour Menma Shop ! Je commande :
📦 *Produit :* ${produit}
💰 *Prix :* ${prix}
🚚 *Livraison :* ${shippingText}
--------------------------
👤 *Client :* ${nom}
📍 *Adresse :* ${adresse}
--------------------------
_Je paierai à la réception._`;

        // 2. Ouvrir WhatsApp dans un nouvel onglet
        const whatsappUrl = `https://wa.me/<?= htmlspecialchars($whatsappNumber) ?>?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');

        // 3. Laisser le formulaire s'envoyer normalement vers Traitement_achat.php
        // Le PHP s'occupera de la base de données et de la réduction de stock.
    });
</script>

<div class="container">
    <?php include 'includes/section_commentaire.php'; ?>
</div>

<?php include 'includes/footer.php'; ?>
