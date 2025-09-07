<?php
// valider_proprietaire.php
require 'database.php';

if(isset($_POST['id'])){
    $id = (int)$_POST['id'];

    // Changer le statut en "validé"
    $req = $bdd->prepare("UPDATE proprietaire SET statut='validé' WHERE id=?");
    $req->execute([$id]);

    // Ici tu peux envoyer un email au propriétaire avec un lien de paiement
    header("Location: admin_validation.php");
}






$update = $bdd->prepare("UPDATE proprietaire SET statut='actif' WHERE id=?");
$update->execute([$id]);



$verifUser = $bdd->prepare("SELECT * FROM proprietaire WHERE Email=? AND statut='actif'");

?>
