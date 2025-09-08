<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/phpmailer/Exception.php';
require 'lib/phpmailer/PHPMailer.php';
require 'lib/phpmailer/SMTP.php';


require 'database.php'; // connexion PDO $bdd

if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit;
}

// Vérifie que l'ID du propriétaire est fourni
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = intval($_POST['id']);

    // Générer un mot de passe temporaire
    $tempPassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
    $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);

    // Mettre à jour le propriétaire : statut validé + mot de passe
    $stmt = $bdd->prepare("UPDATE proprietaire SET statut = 'validé', password = ? WHERE id = ?");
    $stmt->execute([$hashedPassword, $id]);

    // Récupérer email et nom du propriétaire pour l'envoi
    $stmt2 = $bdd->prepare("SELECT Nom, Email FROM proprietaire WHERE id = ?");
    $stmt2->execute([$id]);
    $proprio = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($proprio) {
        $to = $proprio['Email'];
        $subject = "Votre compte Locazen a été validé";
        $message = "
Bonjour {$proprio['Nom']},

Votre compte propriétaire sur Locazen a été validé par l'administrateur.

Voici votre mot de passe temporaire : $tempPassword

Veuillez vous connecter et changer votre mot de passe dès la première connexion :
https://votre-site.com/connexion_proprietaire.php

Merci,
L'équipe Locazen
";
        $headers = "From: no-reply@locazen.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoyer l'email
        mail($to, $subject, $message, $headers);
    }

    $_SESSION['success'] = "Propriétaire validé et email envoyé !";
    header("Location: texte_admin.php");
    exit;
}
?>
