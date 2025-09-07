<?php
// reset_password.php
require 'database.php';
$message = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Vérifier si le token existe et n'a pas expiré
    $stmt = $bdd->prepare("SELECT * FROM proprietaire WHERE reset_token = ? AND reset_expire > NOW()");
    $stmt->execute([$token]);
    $proprio = $stmt->fetch();

    if (!$proprio) {
        die("❌ Lien invalide ou expiré.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe et supprimer le token
        $stmt = $bdd->prepare("UPDATE proprietaire SET password = ?, reset_token = NULL, reset_expire = NULL WHERE id = ?");
        $stmt->execute([$password, $proprio['id']]);

        $message = "✅ Mot de passe réinitialisé avec succès ! <a href='connexion.php' class='text-blue-600 underline'>Se connecter</a>";
    }
} else {
    die("❌ Token manquant.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réinitialiser le mot de passe</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Réinitialiser le mot de passe</h2>

    <?php if ($message): ?>
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-sm">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-gray-700 font-medium mb-1">Nouveau mot de passe</label>
        <input type="password" name="password" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" />
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
        Réinitialiser
      </button>
    </form>
  </div>

</body>
</html>
