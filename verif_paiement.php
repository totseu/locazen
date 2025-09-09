<?php
require 'database.php';

$privateKey = "sk_test.nyrtmU59TqeyGqcvWbWmnhAEvaeSqaVMWQVitchwrxlyT2aDYcJEeLN5Rrmndjd7GvtCF6jGOxXc7cWvVUB8GWsRbKM0CTwvF6A6ZraysXm20m4y6xKEeC6JbLZmv"; // Remplace par ta clé privée NotchPay

$reference = $_GET['reference'] ?? null;
$formule = $_GET['formule'] ?? null;
$id_proprio = $_GET['proprio_id'] ?? null;

if (!$reference || !$formule || !$id_proprio) {
    die("Données manquantes.");
}

// Vérifie le paiement sur NotchPay
$ch = curl_init("https://api.notchpay.com/v1/payment/verify/$reference");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $privateKey"]);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if($data['status'] === 'success' && $data['paid'] === true){
    // Durée selon la formule
    $duree = 1;
    switch($formule){
        case "standard": $duree = 1; break;
        case "premium": $duree = 1; break;
        case "business": $duree = 1; break;
    }

    $date_debut = date('Y-m-d');
    $date_fin = date('Y-m-d', strtotime("+$duree months"));

    $stmt = $bdd->prepare("UPDATE proprietaire 
                           SET abonnement_active = 1,
                               date_debut_abonnement = ?,
                               date_fin_abonnement = ?
                           WHERE id = ?");
    $stmt->execute([$date_debut, $date_fin, $id_proprio]);

    echo "✅ Paiement confirmé ! Votre abonnement '$formule' est actif jusqu'au $date_fin";
} else {
    echo "⚠️ Paiement échoué ou en attente. Veuillez réessayer.";
}
