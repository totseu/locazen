<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/phpmailer/Exception.php';
require 'lib/phpmailer/PHPMailer.php';
require 'lib/phpmailer/SMTP.php';

Serveur SMTP : smtp.gmail.com
Port : 587 (TLS) ou 465 (SSL)
Sécurité : TLS ou SSL


$mail = new PHPMailer(true);

try {
    // Configuration serveur Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tonemail@gmail.com'; // ton Gmail
    $mail->Password   = 'mot_de_passe_application'; // mot de passe d’application (16 caractères généré par Google)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Expéditeur
    $mail->setFrom('tonemail@gmail.com', 'Locazen');

    // Destinataire
    $mail->addAddress('destinataire@mail.com', 'Nom Propriétaire');

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = 'Test Locazen';
    $mail->Body    = '<h1>✅ Test réussi</h1><p>Ceci est un email envoyé avec PHPMailer.</p>';
    $mail->AltBody = '✅ Test réussi - Ceci est un email envoyé avec PHPMailer.';

    // Envoi
    $mail->send();
    echo "✅ Email envoyé avec succès !";

} catch (Exception $e) {
    echo "❌ Erreur : {$mail->ErrorInfo}";
}
