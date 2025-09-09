<?php
session_start();
require 'database.php';

// Vérifie si le propriétaire est connecté
if (!isset($_GET['proprio_id'])) {
    die("Accès refusé");
}

$id_proprio = intval($_GET['proprio_id']);

// Récupère infos du propriétaire
$stmt = $bdd->prepare("SELECT Nom, Email, statut, abonnement_active, date_fin_abonnement FROM proprietaire WHERE id = ?");
$stmt->execute([$id_proprio]);
$proprio = $stmt->fetch(PDO::FETCH_ASSOC);

if ($proprio['statut'] !== 'validé') {
    die("Votre compte n'est pas encore validé par l'administrateur.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tarifs Propriétaire - Locazen</title>
<script src="https://cdn.notchpay.com/v1/notchpay.js"></script>
<link rel="stylesheet" href="src/css/output.css">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<header class="bg-blue-600 text-white py-6 shadow-lg">
<div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
  <h1 class="text-2xl font-bold">Locazen</h1>
  <nav class="space-x-6">
    <a href="index.php" class="hover:underline">Accueil</a>
    <a href="tarifs_proprietaire.php" class="underline font-semibold">Tarifs</a>
    <a href="contact.php" class="hover:underline">Contact</a>
  </nav>
</div>
</header>

<section class="text-center py-12 bg-white shadow-md">
<h2 class="text-3xl font-bold text-gray-800 mb-2">Nos Tarifs pour Propriétaires</h2>
<p class="text-gray-600 max-w-2xl mx-auto">
Publiez vos biens, gagnez en visibilité et maximisez vos revenus avec nos formules simples et transparentes.
</p>
</section>

<?php if ($proprio['abonnement_active'] == 1 && $proprio['date_fin_abonnement'] >= date('Y-m-d')): ?>
<p class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-6 max-w-2xl mx-auto">
✅ Votre abonnement est actif jusqu’au <?= htmlspecialchars($proprio['date_fin_abonnement']) ?>
</p>
<?php endif; ?>

<section class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Standard -->
<div class="bg-white shadow-lg rounded-2xl p-8 flex flex-col hover:scale-105 transition">
<h3 class="text-xl font-bold text-blue-600 mb-4">Formule Standard</h3>
<p class="text-gray-600 mb-6">Idéal pour un propriétaire débutant.</p>
<ul class="space-y-3 text-gray-700 mb-6">
<li>✔️ 1 annonce active</li>
<li>✔️ Visibilité classique</li>
<li>✔️ Assistance par email</li>
</ul>
<p class="text-3xl font-bold text-gray-800 mb-6">5 000 FCFA <span class="text-sm text-gray-500">/mois</span></p>
<button onclick="payer('standard', 5000)" class="bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Choisir</button>
</div>

<!-- Premium -->
<div class="bg-blue-600 text-white shadow-xl rounded-2xl p-8 flex flex-col transform scale-105">
<h3 class="text-xl font-bold mb-4">Formule Premium</h3>
<p class="mb-6">Parfaite pour les propriétaires actifs.</p>
<ul class="space-y-3 mb-6">
<li>✔️ Jusqu’à 5 annonces</li>
<li>✔️ Visibilité mise en avant</li>
<li>✔️ Assistance prioritaire</li>
<li>✔️ Badge propriétaire vérifié</li>
</ul>
<p class="text-3xl font-bold mb-6">12 000 FCFA <span class="text-sm">/mois</span></p>
<button onclick="payer('premium', 12000)" class="bg-white text-blue-600 py-2 rounded-lg hover:bg-gray-200">Choisir</button>
</div>

<!-- Business -->
<div class="bg-white shadow-lg rounded-2xl p-8 flex flex-col hover:scale-105 transition">
<h3 class="text-xl font-bold text-blue-600 mb-4">Formule Business</h3>
<p class="text-gray-600 mb-6">Pour agences ou multi-propriétaires.</p>
<ul class="space-y-3 text-gray-700 mb-6">
<li>✔️ Annonces illimitées</li>
<li>✔️ Visibilité maximale</li>
<li>✔️ Support 24/7</li>
<li>✔️ Rapport de performance</li>
</ul>
<p class="text-3xl font-bold text-gray-800 mb-6">25 000 FCFA <span class="text-sm text-gray-500">/mois</span></p>
<button onclick="payer('business', 25000)" class="bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Choisir</button>
</div>
</section>

<script>
function payer(formule, montant) {
    const publicKey = "pk_test.G3QKFEKozyw6PC1Vmk3gK3nMsRSNuQoDSoGluhdaqUzOUSFRIgefadhzorpe4oZs1TuOcX11D2MzUPVtdYs6WBE55dTZRkOn1eOaFmin674EVFP20xr6zrMBIyIkK";
    const reference = "NOTCH_" + Date.now();
    const proprioId = <?= json_encode($id_proprio) ?>;
    const email = <?= json_encode($proprio['Email']) ?>;

    NotchPay.pay({
        publicKey: publicKey,
        amount: montant,
        currency: "XAF",
        reference: reference,
        customer: { id: proprioId, email: email },
        metadata: { formule: formule }, // ENVOIE LA FORMULE AU WEBHOOK
        callback: function(response) {
            // Redirige vers une page de confirmation côté client
            window.location.href = "confirmation.php?reference=" + response.reference;
        }
    });
}

</script>

</body>
</html>
