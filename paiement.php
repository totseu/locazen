<?php
require 'database.php';

// Vérifie si le propriétaire est connecté
if (!isset($_SESSION['proprio_id'])) {
    die("Accès refusé");
}

$id_proprio = $_SESSION['proprio_id'];

// Récupère l'email du propriétaire
$stmt = $bdd->prepare("SELECT Email FROM proprietaire WHERE id = ?");
$stmt->execute([$id_proprio]);
$proprio = $stmt->fetch(PDO::FETCH_ASSOC);

$pack = $_GET['pack'] ?? '';
if(!$pack) die("Aucun pack sélectionné");

switch($pack) {
    case 'basic':
        $montant = 5000;
        $formule = "Standard";
        break;
    case 'premium':
        $montant = 12000;
        $formule = "Premium";
        break;
    case 'pro':      // accepte 'pro'
    case 'business':
        $montant = 25000;
        $formule = "Business";
        break;
    default:
        die("Pack inconnu !");
}

// Formulaire auto-submit pour POST vers create_payment.php
?>
<form id="paymentForm" action="create_payment.php" method="post">
    <input type="hidden" name="amount" value="<?= $montant ?>">
    <input type="hidden" name="formule" value="<?= $formule ?>">
    <input type="hidden" name="proprio_id" value="<?= $id_proprio ?>">
    <input type="hidden" name="email" value="<?= htmlspecialchars($proprio['Email']) ?>">
</form>

<script>
document.getElementById('paymentForm').submit();
</script>
