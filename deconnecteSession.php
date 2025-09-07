 <?php 
// session_start();
// $_SESSION = [];
// session_destroy();
// header('location: index.php');

// deconnecteSession.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Supprimer toutes les variables de session
$_SESSION = [];

// Supprimer le cookie de session si activé
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000, // Expiré
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Redirection
header("Location: index.php");
exit;

?> 