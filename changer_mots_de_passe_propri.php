<?php
require 'database.php';
session_start(); // Assure-toi que la session est bien démarrée

// Vérifier si le propriétaire est connecté
if (!isset($_SESSION['proprio_id'])) {
    header("Location: connexion.proprietaire.php");
    exit;
}

$id = $_SESSION['proprio_id'];
$success = $error = "";

// Traitement du changement de mot de passe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_pass = trim($_POST['old_password']);
    $new_pass = trim($_POST['new_password']);
    $confirm_pass = trim($_POST['confirm_password']);

    // Vérifier que les champs ne sont pas vides
    if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif ($new_pass !== $confirm_pass) {
        $error = "Les deux nouveaux mots de passe ne correspondent pas.";
    } else {
        // Récupérer le mot de passe actuel
        $stmt = $bdd->prepare("SELECT password FROM proprietaire WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($old_pass, $user['password'])) {
            // Hacher le nouveau mot de passe
            $hashed = password_hash($new_pass, PASSWORD_DEFAULT);

            // Mettre à jour en BDD
            $update = $bdd->prepare("UPDATE proprietaire SET password = ? WHERE id = ?");
            $update->execute([$hashed, $id]);

            $success = "Mot de passe changé avec succès ✅";
        } else {
            $error = "Ancien mot de passe incorrect.";
        }
    }
}
?>
