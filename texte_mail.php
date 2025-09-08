<?php
// Activer les erreurs pour debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure PHPMailer
// require 'vendor/autoload.php'; // si installé avec Composer
// ou sinon : require 'PHPMailer/PHPMailer.php'; + les autres fichiers manuellement

require 'lib/phpmailer/Exception.php';
require 'lib/phpmailer/PHPMailer.php';
require 'lib/phpmailer/SMTP.php';


$mail = new PHPMailer(true);

try {
    // Paramètres serveur SMTP Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'totseunathan@gmail.com';   // ton adresse Gmail
    $mail->Password   = 'gyybnsgxhalvusry';       // ton mot de passe d'application (sans espaces)
    $mail->SMTPSecure = 'tls'; 
    $mail->Port       = 587;

    // Expéditeur
    $mail->setFrom('totseunathan@gmail.com', 'Locazen Test');

    // Destinataire
    $mail->addAddress('mamtonaomie12@example.com'); // mets ton autre adresse Gmail ou Outlook pour test

    // Contenu du mail
    $mail->isHTML(true);
    $mail->Subject = '✅ Test SMTP Gmail depuis Locazen';
    $mail->Body    = 'Ceci est un test avec <b>PHPMailer + Gmail SMTP</b>.';

    // Envoi
    $mail->send();
    echo '📩 Message envoyé avec succès !';
} catch (Exception $e) {
    echo "❌ Erreur d'envoi : {$mail->ErrorInfo}";
}
