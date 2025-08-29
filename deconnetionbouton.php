<?php
session_start(); // Toujours démarrer la session pour pouvoir la manipuler

// Détruire toutes les variables de session
$_SESSION = array();

// Si tu veux détruire le cookie de session aussi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Redirection vers la page de connexion
header("Location: connexion.php");
exit();
?>
