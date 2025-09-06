<?php
// inscription_proprietaireAction.
require 'database.php';


 if(isset($_POST['valider'])){
    $nomComplet = $_POST['nomComplet'];
    $AdressePersonnelle = $_POST['AdressePersonnelle'];
    $numeroTel = $_POST['numeroTel'];
    $adresseEmail = $_POST['adresseEmail'];
    $adresseCompleBien = $_POST['adresseCompleBien'];
    $typeBien = $_POST['typeBien'];
    $superficie = $_POST['superficie'];
    $nombrePieces = $_POST['nombrePieces'];
    $anneeConstruction = $_POST['anneeConstruction'];
    $reponsePropri = $_POST['reponsePropri'];
    $numeroTitreFoncier = $_POST['numeroTitreFoncier'];
    $dateDelivrance = $_POST['dateDelivrance'];
    $nomIndiqueDocument = $_POST['nomIndiqueDocument'];
    $reponsePropriCertificat =$_POST['reponsePropricertificat'];
    $numeroTitreFoncier = $_POST['numeroTitreFoncier'];
    $dateDelivranceCertificat = $_POST['dateDelivranceCertificat'];
    $nomIndiqueDocumentCertificat = $_POST['nomIndiqueDocumentCertificat'];
    $reposeSignature = $_POST['reposeSignature'];
    $reposeSignatureHypothes = $_POST['reposeSignatureHypothes'];
    $description = $_POST['description'];
    $Signature_proprietaire = $_POST['Signature_proprietaire'];

    
    $insert = $bdd->prepare("INSERT INTO proprietaire(numeroTitreFoncier, dateDelivranceCertificat, nomIndiqueDocumentCertificat, reposeSignature, reposeSignatureHypothes, description, Signature_proprietaire) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $insert->execute(array($numeroTitreFoncier, $dateDelivranceCertificat, $nomIndiqueDocumentCertificat, $reposeSignature, $reposeSignatureHypothes, $description, $Signature_proprietaire));
    
    if($insert){
        header('Location: s\'incristion_proprietaire.html');
    } else {
        echo "Erreur lors de l'insertion des données.";
    }
 }
?>