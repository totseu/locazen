<?php
require 'database.php';

// Clé de hachage NotchPay pour vérifier l'intégrité des données
$secret = "VOTRE_CLE_DE_HASH"; 

// Récupère le payload envoyé par NotchPay
$payload = file_get_contents("php://input");
$signature = $_SERVER['HTTP_X_NOTCHPAY_SIGNATURE'] ?? '';

// Vérifie la signature pour sécuriser le webhook
if(hash_hmac('sha256', $payload, $secret) !== $signature){
    http_response_code(400);
    exit("Signature invalide");
}

$data = json_decode($payload, true);

// Vérifie si le paiement est réussi
if($data['status'] === 'success' && $data['paid'] === true){
    $proprioId = $data['customer']['id'];
    $formule = $data['metadata']['formule'] ?? 'standard'; // Récupère la formule envoyée dans metadata

    // Détermine la durée selon la formule
    $duree = 1; // 1 mois par défaut
    switch($formule){
        case "standard": $duree = 1; break;
        case "premium": $duree = 1; break;
        case "business": $duree = 1; break;
    }

    $date_debut = date('Y-m-d');
    $date_fin = date('Y-m-d', strtotime("+$duree months"));

    // Active l'abonnement dans la base
    $stmt = $bdd->prepare("UPDATE proprietaire 
                           SET abonnement_active = 1,
                               date_debut_abonnement = ?,
                               date_fin_abonnement = ?
                           WHERE id = ?");
    $stmt->execute([$date_debut, $date_fin, $proprioId]);
}

// Répond OK à NotchPay
http_response_code(200);
