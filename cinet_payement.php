<?php
// fichier: cinet_payement.php

// Activer le reporting des erreurs pour debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Charger les classes nécessaires
require_once __DIR__ . '/../src/new-guichet.php';
require_once __DIR__ . '/../commande.php';
require_once __DIR__ . '/../marchand.php';

// Vérifie si le script est appelé via POST et si cpm_trans_id existe
$cpm_trans_id = $_POST['cpm_trans_id'] ?? null;
$site_id = $_POST['cpm_site_id'] ?? null;

if (!$cpm_trans_id || !$site_id) {
    die("Erreur : cpm_trans_id ou cpm_site_id non fourni !");
}

// Création d'un fichier log pour debug
$log  = "User: " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
    "TransId: " . $cpm_trans_id . PHP_EOL .
    "SiteId: " . $site_id . PHP_EOL .
    "-------------------------" . PHP_EOL;

file_put_contents(__DIR__ . '/log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);

try {
    // Récupération de l'API key du marchand
    $apikey = $marchand["apikey"]; // Assure-toi que $marchand est défini correctement

    // Initialisation de CinetPay
    $CinetPay = new CinetPay($site_id, $apikey);

    // Vérification du statut de la transaction
    $CinetPay->getPayStatus($cpm_trans_id, $site_id);

    $amount = $CinetPay->chk_amount;
    $currency = $CinetPay->chk_currency;
    $message = $CinetPay->chk_message;
    $code = $CinetPay->chk_code;
    $metadata = $CinetPay->chk_metadata;

    // Log du statut de la transaction
    $log  = "User: " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
        "Code: " . $code . PHP_EOL .
        "Message: " . $message . PHP_EOL .
        "Amount: " . $amount . PHP_EOL .
        "Currency: " . $currency . PHP_EOL .
        "-------------------------" . PHP_EOL;

    file_put_contents(__DIR__ . '/log_' . date("j.n.Y") . '.log', $log, FILE_APPEND);

    // Vérification du code retour CinetPay
    if ($code === '00') {
        // Paiement réussi
        echo "Félicitations, votre paiement a été effectué avec succès !";

        // Ici tu peux mettre à jour ta base de données
        // $commande = new Commande();
        // $commande->set_transactionId($cpm_trans_id);
        // $commande->update();

    } else {
        // Paiement échoué
        echo "Echec, votre paiement a échoué pour cause : " . $message;
    }

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
