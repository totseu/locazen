<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$message = $_SESSION['success'] ?? "Merci pour votre inscription.";
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Merci - Locazen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-8 text-center">
        <h1 class="text-2xl font-bold text-green-600">✅ Succès</h1>
        <p class="mt-4 text-gray-700"><?= $message ?></p>
        <a href="index.php" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Retour à l'accueil</a>
    </div>
</body>
</html>
