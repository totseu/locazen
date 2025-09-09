<?php
// Toujours démarrer la session avant toute sortie

require 'database.php';

// Vérifie si le propriétaire est connecté
if (!isset($_SESSION['proprio_id'])) {
    header("Location: connexion_proprietaire.php");
    exit;
}

// Récupère le statut du propriétaire
$id = (int) $_SESSION['proprio_id'];
$stmt = $bdd->prepare("SELECT Nom, statut FROM proprietaire WHERE id = ?");
$stmt->execute([$id]);
$proprio = $stmt->fetch(PDO::FETCH_ASSOC);

// Si le compte n'existe pas
if (!$proprio) {
    session_destroy(); // supprimer la session si l’utilisateur est introuvable
    header("Location: connexion_proprietaire.php?error=compte_introuvable");
    exit;
}

$nom = htmlspecialchars($proprio['Nom'], ENT_QUOTES, 'UTF-8');
$statut = $proprio['statut'];

// Vérification stricte du statut
$statuts_valides = ['en attente', 'validé', 'actif'];
if (!in_array($statut, $statuts_valides, true)) {
    echo " Erreur : statut invalide détecté.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Propriétaire - Locazen</title>
  <link rel="stylesheet" href="src/css/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
      <h1 class="text-2xl font-bold text-blue-600">LocaZen</h1>
      <div class="hidden md:flex space-x-8">
        <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Accueil</a>
        <a href="#tarifs" class="text-gray-700 hover:text-blue-600 font-medium">Tarifs</a>
        <a href="#publier" class="text-gray-700 hover:text-blue-600 font-medium">Publier</a>
        <a href="changer_mots_de_passe_propri.php"  class="text-gray-700 hover:text-blue-600 font-medium">changer mots de passe </a>
      </div>
      <div>
        <a href="index.php" class="text-red-600 font-semibold hover:underline">Déconnexion</a>
      </div>
    </div>
  </nav>

  <main class="max-w-6xl mx-auto py-12 px-6">

    <?php if ($statut === 'en attente'): ?>
      <!-- Compte en attente -->
      <div class="bg-yellow-100 border-l-4 border-yellow-500 p-6 rounded-lg text-yellow-800">
        <h2 class="text-2xl font-bold mb-2">Bonjour <?= $nom ?> 👋</h2>
        <p>Votre compte est actuellement <strong>en attente de validation</strong> par l'administrateur.</p>
        <p>Vous recevrez un email dès que votre compte sera validé.</p>
      </div>

    <?php elseif ($statut === 'validé'): ?>
      <!-- Compte validé mais pas encore abonné -->
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue <?= $nom ?> 👋</h2>
        <p class="text-gray-600 mb-6">Votre compte a été validé par l'administrateur. Choisissez un abonnement pour accéder à toutes les fonctionnalités.</p>

        <!-- Section Tarifs -->
        <section id="tarifs" class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h4 class="text-xl font-semibold mb-2">Pack Basic</h4>
            <p class="text-gray-600 mb-4">Idéal pour commencer</p>
            <p class="text-3xl font-bold text-blue-600 mb-6">5 000 FCFA <span class="text-sm">/mois</span></p>
            <ul class="text-gray-600 mb-6 space-y-2">
              <li>✅ Publier jusqu’à 3 biens</li>
              <li>✅ Assistance par email</li>
            </ul>
            <a href="paiement.php?pack=basic" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">S’abonner</a>
          </div>

          <div class="bg-white shadow-lg rounded-2xl p-6 text-center border-2 border-blue-600">
            <h4 class="text-xl font-semibold mb-2">Pack Pro</h4>
            <p class="text-gray-600 mb-4">Le plus populaire</p>
            <p class="text-3xl font-bold text-blue-600 mb-6">10 000 FCFA <span class="text-sm">/mois</span></p>
            <ul class="text-gray-600 mb-6 space-y-2">
              <li>✅ Publier jusqu’à 10 biens</li>
              <li>✅ Mise en avant de vos annonces</li>
              <li>✅ Support prioritaire</li>
            </ul>
            <a href="paiement.php?pack=pro" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">S’abonner</a>
          </div>

          <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h4 class="text-xl font-semibold mb-2">Pack Premium</h4>
            <p class="text-gray-600 mb-4">Pour les grands propriétaires</p>
            <p class="text-3xl font-bold text-blue-600 mb-6">20 000 FCFA <span class="text-sm">/mois</span></p>
            <ul class="text-gray-600 mb-6 space-y-2">
              <li>✅ Biens illimités</li>
              <li>✅ Annonces boostées</li>
              <li>✅ Assistance 24/7</li>
            </ul>
            <a href="paiement.php?pack=premium" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">S’abonner</a>
          </div>
        </section>
      </div>

    <?php elseif ($statut === 'actif'): ?>
      <!-- Compte actif -->
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Bienvenue <?= $nom ?> 👋</h2>
        <p class="text-gray-600 mb-6">Votre abonnement est actif. Vous pouvez maintenant publier vos biens et gérer votre espace propriétaire.</p>
        <a href="dashboard_proprio.php" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">Accéder au dashboard</a>
      </div>
    <?php endif; ?>

  </main>

  <footer class="bg-white shadow-inner py-6 mt-12">
    <div class="max-w-6xl mx-auto text-center text-gray-500 text-sm">
      © 2025 LocaZen - Espace Propriétaire. Tous droits réservés.
    </div>
  </footer>

</body>
</html>
