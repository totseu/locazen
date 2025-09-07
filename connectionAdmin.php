<?php

require 'database.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $bdd->prepare("SELECT * FROM administrateurs WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if($admin && password_verify($password, $admin['password'])){
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nom'] = $admin['nom'];
        header("Location: texte_admin.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion Admin</title>
<link rel="stylesheet" href="src/css/output.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<form method="post" class="bg-white p-6 rounded shadow-md w-96 space-y-4">
    <h2 class="text-2xl font-bold text-gray-800">Connexion Administrateur</h2>
    <?php if(isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required class="w-full border p-2 rounded">
    <input type="password" name="password" placeholder="Mot de passe" required class="w-full border p-2 rounded">
    <button type="submit" name="login" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Se connecter</button>
</form>
</body>
</html>
