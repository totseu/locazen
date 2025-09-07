<?php
// forgot_password.php
require 'database.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Vérifier si l'email existe
    $stmt = $bdd->prepare("SELECT id FROM proprietaire WHERE email = ?");
    $stmt->execute([$email]);
    $proprio = $stmt->fetch();

    if ($proprio) {
        // Générer un token unique
        $token = bin2hex(random_bytes(50));
        $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Sauvegarder le token en BD
        $stmt = $bdd->prepare("UPDATE proprietaire SET reset_token = ?, reset_expire = ? WHERE email = ?");
        $stmt->execute([$token, $expire, $email]);

        // Lien de réinitialisation
        $resetLink = "http://localhost/reset_password.php?token=" . $token;

        // ⚠️ Ici tu devras configurer un envoi d'email réel (PHPMailer ou autre)
        $message = "✅ Un lien de réinitialisation a été envoyé : <a href='$resetLink'>$resetLink</a>";
    } else {
        $message = "❌ Cet email n'existe pas.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mot de passe oublié</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Mot de passe oublié</h2>

    <?php if ($message): ?>
      <div class="bg-gray-100 text-gray-700 px-4 py-2 rounded mb-4 text-sm">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" name="email" required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" />
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
        Envoyer le lien
      </button>
    </form>
  </div>

</body>
</html>
