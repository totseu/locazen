<?php
// connexion.php

require 'database.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $bdd->prepare("SELECT * FROM proprietaire WHERE email = ?");
    $stmt->execute([$email]);
    $proprio = $stmt->fetch();

    if ($proprio && password_verify($password, $proprio['password'])) {
        $_SESSION['proprio_id'] = $proprio['id'];
        $_SESSION['proprio_nom'] = $proprio['nom'];
        header("Location: dashboard_proprio.php"); // redirection après connexion
        exit();
    } else {
        $error = "❌ Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - Locazen</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Connexion Propriétaire</h2>
    
    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4 text-sm">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <!-- Email -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" name="email" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Mot de passe -->
      <div>
        <label class="block text-gray-700 font-medium mb-1">Mot de passe</label>
        <input type="password" name="password" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
      </div>

      <!-- Bouton -->
      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
        Se connecter
      </button>
    </form>

    <!-- Lien mot de passe oublié -->
    <p class="text-center text-sm text-gray-600 mt-6">
      Mot de passe oublié ? <a href="reset_password.php" class="text-blue-600 hover:underline">Réinitialiser</a>
    </p>
  </div>

</body>
</html>
