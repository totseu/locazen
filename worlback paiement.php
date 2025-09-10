<?php
require 'database.php';

$reference = $_GET['reference'] ?? '';
if (!$reference) die("Référence manquante");

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.notchpay.co/payments/{$reference}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: sk_test.VgJ9RUzwst5UPLGdKdtxDTogJxekl0YJ2VH7ovohIrrIMKTETrSuCp66afProVsyWohvNAgeUkaZzDLw3XVs9lWGl5hOh16p9B2LiMpJ11DjlZcnCJRJz7UtO1TCA"
    ]
]);

$response = curl_exec($curl);
$data = json_decode($response, true);
curl_close($curl);

if (!isset($data['transaction'])) {
    die("Erreur API NotchPay : " . print_r($data, true));
}

if ($data['transaction']['status'] === 'complete') {
    echo "✅ Paiement réussi !";

    // Récupérer l'ID du proprio stocké dans la transaction (customer id)
    $proprioId = $data['transaction']['customer']['id'] ?? null;

    if ($proprioId) {
        // Calcul de la date de fin d'abonnement (+30 jours)
        $dateFin = date('Y-m-d', strtotime('+30 days'));

        $stmt = $bdd->prepare("UPDATE proprietaire SET abonnement_active = 1, date_fin_abonnement = ? WHERE id = ?");
        $stmt->execute([$dateFin, $proprioId]);

        echo "<br>✅ Abonnement activé jusqu’au $dateFin";
    }
} else {
    echo "❌ Paiement non complété.";
}
