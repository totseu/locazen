<?php
header('Content-Type: application/json');
require 'database.php';

$montant   = $_POST['amount'] ?? 0;
$formule   = $_POST['formule'] ?? '';
$proprioId = $_POST['proprio_id'] ?? '';
$email     = $_POST['email'] ?? '';

$reference = "NOTCH_" . uniqid(); // Référence unique

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.notchpay.co/payments",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Authorization:sk_test.0thjGGOItr04aqM1auK6rnfrsuLqPDjf2vGcaxfWNoogUTD3leNJ2WaXSGIZxMpwztGdYKzbP9XzhvyrkqynwL5DHb5m5OxLTyIBaOo0I1t38xgC5B5sRoWtJ2ufy",
    "Content-Type: application/json"
  ],
  CURLOPT_POSTFIELDS => json_encode([
    "amount" => $montant,
    "currency" => "XAF",
    "customer" => [
      "name"  => "Propriétaire $proprioId",
      "email" => $email,
      "phone" => "+237670000000" // ✅ numéro test NotchPay
    ],
    "description" => "Abonnement Locazen - $formule",
    "callback"    => "http://localhost/locazen/callback.php",
    "reference"   => $reference
  ])
]);

$response = curl_exec($curl);
$data = json_decode($response, true);
curl_close($curl);

echo json_encode($data);
