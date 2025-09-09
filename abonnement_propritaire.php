<?php
require 'database.php';
session_start();

if (!isset($_SESSION['proprio_id'])) {
    header("Location: connexion.proprietaire.php");
    exit;
}

$id = $_SESSION['proprio_id'];
$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duree = intval($_POST['duree']); // en mois
    $date_debut = date('Y-m-d');
    $date_fin = date('Y-m-d', strtotime("+$duree months"));

    $stmt = $bdd->prepare("UPDATE proprietaire 
                           SET abonnement_active = 1, 
                               date_debut_abonnement = ?, 
                               date_fin_abonnement = ? 
                           WHERE id = ?");
    $stmt->execute([$date_debut, $date_fin, $id]);

    $success = "✅ Abonnement activé jusqu’au $date_fin";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Abonnement - Locazen</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<main class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg">
  <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">📅 Gérer mon abonnement</h2>

  <?php if ($error): ?>
    <p class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4"><?= $error ?></p>
  <?php endif; ?>

  <?php if ($success): ?>
    <p class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4"><?= $success ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-6">
    <label class="block text-gray-700 mb-1">Choisir une durée</label>
    <select name="duree" class="w-full border px-4 py-2 rounded-lg">
      <option value="1">1 mois</option>
      <option value="3">3 mois</option>
      <option value="6">6 mois</option>
      <option value="12">12 mois</option>
    </select>
    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
      Activer / Renouveler
    </button>
  </form>
</main>

</body>
</html>
