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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = intval($_POST['id']);

    // Générer un mot de passe temporaire
    $tempPassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
    $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);



    $stmt = $bdd->prepare("UPDATE proprietaire SET statut = 'validé', mdp = ? WHERE id = ?");
$stmt->execute([$hashedPassword, $id]);


    // Récupérer email et nom du propriétaire
    $stmt2 = $bdd->prepare("SELECT Nom, Email FROM proprietaire WHERE id = ?");
    $stmt2->execute([$id]);
    $proprio = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($proprio) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'totseunathan@gmail.com'; // ton Gmail
            $mail->Password   = 'gyybnsgxhalvusry';       // mot de passe d'application
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('totseunathan@gmail.com', 'Locazen');
            $mail->addAddress($proprio['Email'], $proprio['Nom']);
            $mail->isHTML(true);
            $mail->Subject = "Votre compte Locazen a été validé";
            $mail->Body    = "
<p>Bonjour {$proprio['Nom']},</p>
<p>Votre compte propriétaire sur Locazen a été validé par l'administrateur.</p>
<p>Voici votre mot de passe temporaire : <b>$tempPassword</b></p>
<p>Veuillez vous connecter et changer votre mot de passe dès la première connexion :<br>
<a href='https://votre-site.com/connexion_proprietaire.php'>Connexion</a></p>
<p>Merci,<br>L'équipe Locazen</p>
";

            $mail->send();
        } catch (Exception $e) {
            $_SESSION['error'] = "Erreur d'envoi du mail : {$mail->ErrorInfo}";
        }
    }

    $_SESSION['success'] = "Propriétaire validé et email envoyé !";
    header("Location: texte_admin.php");
    exit;
}


?>


