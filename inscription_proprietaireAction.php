<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'database.php'; // connexion PDO $bdd

if (isset($_POST['valider'])) {

    // Récupération et nettoyage des champs
    $nomComple = trim(htmlspecialchars($_POST['nomComple'] ?? ''));
    $numeroPieceIdentite = trim(htmlspecialchars($_POST['numeroPieceIdentite'] ?? ''));
    $AdressePersonnelle = trim(htmlspecialchars($_POST['AdressePersonnelle'] ?? ''));
    $numeroTel = trim(htmlspecialchars($_POST['numeroTel'] ?? ''));
    $adresseEmail = strtolower(trim($_POST['adresseEmail'] ?? ''));
    $adresseBien = trim(htmlspecialchars($_POST['adresseCompleBien'] ?? ''));
    $typeBien = trim(htmlspecialchars($_POST['typeBien'] ?? ''));
    $superficie = trim(htmlspecialchars($_POST['Superficie'] ?? ''));
    $nombrePieces = trim(htmlspecialchars($_POST['NombrePieces'] ?? ''));
    $anneeConstruction = trim(htmlspecialchars($_POST['AnneeConstruction'] ?? ''));
    $reponsePropri = trim(htmlspecialchars($_POST['reponsePropri'] ?? ''));
    $numeroTitreFoncier = trim(htmlspecialchars($_POST['numeroTitreFoncier'] ?? ''));
    $dateDelivrance = $_POST['dateDelivrance'] ?? null;
    $nomIndiqueDocument = trim(htmlspecialchars($_POST['nomIndiqueDocument'] ?? ''));
    $reponsePropriCertificat = trim(htmlspecialchars($_POST['reponsePropriCertificat'] ?? ''));
    $dateDelivranceCertificat = $_POST['dateDelivranceCertificat'] ?? null;
    $nomIndiqueDocumentCertificat = trim(htmlspecialchars($_POST['nomIndiqueDocumentCertificat'] ?? ''));
    $reposeSignature = trim(htmlspecialchars($_POST['reposeSignature'] ?? ''));
    $reposeSignatureHypothes = trim(htmlspecialchars($_POST['reposeSignatureHypothes'] ?? ''));
    $description = trim(htmlspecialchars($_POST['description'] ?? ''));

    // 2️⃣ Vérification que tous les champs obligatoires sont remplis
    if (!$nomComple || !$numeroPieceIdentite || !$AdressePersonnelle || !$numeroTel || !$adresseEmail || !$typeBien || !$reponsePropri || !$reponsePropriCertificat || !$reposeSignature || !$reposeSignatureHypothes || !$description) {
        $erroMsg = "Veuillez remplir tous les champs obligatoires.";
        exit($erroMsg);
    }

    // Gestion des fichiers uploadés
    $uploadsDir = 'uploads/proprietaires/';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $fichiers = ['imageIdentite', 'imageDocument', 'imagePDF'];
    $cheminsFichiers = [];

    foreach ($fichiers as $file) {
        if (isset($_FILES[$file]) && $_FILES[$file]['error'] === 0) {
            $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
            $nomFichier = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES[$file]['tmp_name'], $uploadsDir . $nomFichier);
            $cheminsFichiers[$file] = $uploadsDir . $nomFichier;
        } else {
            $erroMsg = "Erreur lors de l'upload de $file";
            exit($erroMsg);
        }
    }

    // Vérifier si l'email existe déjà
    $checkEmail = $bdd->prepare("SELECT id FROM proprietaire WHERE Email = ?");
    $checkEmail->execute([$adresseEmail]);
    if ($checkEmail->rowCount() > 0) {
        exit("Cet email est déjà utilisé.");
    }

    //  Insertion dans la base de données
    $insert = $bdd->prepare("
        INSERT INTO proprietaire (
            Nom, Email, Tel, numeroPieceIdentite, AdressePersonnelle,
            adresseBien, typeBien, Superficie, NombrePieces, AnneeConstruction,
            reponsePropri, numeroTitreFoncier, dateDelivrance, nomIndiqueDocument,
            reponsePropriCertificat, dateDelivranceCertificat, nomIndiqueDocumentCertificat,
            reposeSignature, reposeSignatureHypothes, description,
            imageIdentite, imageDocument, imagePDF, statut
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'en attente')
    ");

    $insert->execute([
        $nomComple, $adresseEmail, $numeroTel, $numeroPieceIdentite, $AdressePersonnelle,
        $adresseBien, $typeBien, $superficie, $nombrePieces, $anneeConstruction,
        $reponsePropri, $numeroTitreFoncier, $dateDelivrance, $nomIndiqueDocument,
        $reponsePropriCertificat, $dateDelivranceCertificat, $nomIndiqueDocumentCertificat,
        $reposeSignature, $reposeSignatureHypothes, $description,
        $cheminsFichiers['imageIdentite'], $cheminsFichiers['imageDocument'], $cheminsFichiers['imagePDF']
    ]);

    //  Message succès
    echo "Votre demande a été envoyée avec succès. Elle sera vérifiée sous 4h.";
}
?>
