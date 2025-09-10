<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.notchpay.co/payments",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Authorization: sk_test.A2PFeXOJG0wXjziWjuumbgAyVDehq8ldEeKIzX6gl3VDLVgX2DYv1RSqApWoxgD3ZdeNDFJcBY6cn9Z3h4gtwSGG3SaAxdFdlyh8NKiO1lGOtbWTSlH1Rkd5jYYPt", // remplace par ta clé Notch Pay
    "Content-Type: application/json"
  ],
  CURLOPT_POSTFIELDS => json_encode([
    "amount" => 5000, // Montant
    "currency" => "XAF", // Devise
    "customer" => [
      "name" => "John Doe",
      "email" => "john@example.com",
      "phone" => "+237691727382"
    ],
    "description" => "Paiement pour commande #123",
    "callback" => "https://tonsite.com/callback", // page de retour
  "reference" => "order_" . uniqid()

  ])
]);

$response = curl_exec($curl);
$data = json_decode($response, true);
curl_close($curl);

// Vérifier si l'URL de paiement existe
if (isset($data["authorization_url"])) {
    header("Location: " . $data["authorization_url"]);
    exit();
} else {
    echo "<pre>";
    print_r($data); // Affiche la réponse si erreur
    echo "</pre>";
}
