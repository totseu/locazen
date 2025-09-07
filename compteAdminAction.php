<?php
require 'database.php'; // connexion PDO

$nom = "Admin";
$email = "admin@locazen.com";
$password = password_hash("MotDePasse123", PASSWORD_DEFAULT); // hachage sécurisé

$stmt = $bdd->prepare("INSERT INTO administrateurs (nom, email, password) VALUES (?, ?, ?)");
$stmt->execute([$nom, $email, $password]);

echo "Admin créé avec succès !";
?>
