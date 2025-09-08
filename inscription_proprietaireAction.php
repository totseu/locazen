<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    
    //connexion a la base de donnee
    //code...
    $bdd = new  PDO("mysql:host=localhost;dbname=locazen;charset=utf8", "root","");
} catch (Exception $e) {
    //throw $th;
    die('une erreur a ete trouvee : ' .$e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    // Vérification des champs obligatoires
    if (!$nomComple || !$numeroPieceIdentite || !$AdressePersonnelle || !$numeroTel || !$adresseEmail || !$typeBien || !$reponsePropri || !$reponsePropriCertificat || !$reposeSignature || !$reposeSignatureHypothes || !$description) {
        $_SESSION['error'] = " Veuillez remplir tous les champs obligatoires.";
        header("Location: s'incristion_proprietaire.php");
        exit;
    }

    // Vérifier si l'email existe déjà
    $checkEmail = $bdd->prepare("SELECT id FROM proprietaire WHERE Email = ?");
    $checkEmail->execute([$adresseEmail]);
    if ($checkEmail->rowCount() > 0) {
        $_SESSION['error'] = " Cet email est déjà utilisé.";
        header("Location: s'incristion_proprietaire.php");
        exit;
    }

    // Gestion des fichiers uploadés
    $uploadsDir = 'uploads/proprietaires/';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $fichiers = ['imageIdentite', 'imageDocument', 'imagePDF'];
    $cheminsFichiers = [];

    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'pdf'];
    $tailleMax = 5 * 1024 * 1024; // 5 Mo

    foreach ($fichiers as $file) {
        if (isset($_FILES[$file]) && $_FILES[$file]['error'] === 0) {
            $ext = strtolower(pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION));

            // Vérifier extension
            if (!in_array($ext, $extensionsAutorisees)) {
                $_SESSION['error'] = " Le fichier $file doit être en JPG, PNG ou PDF.";
                header("Location: inscription_proprietaire.php");
                exit;
            }

            // Vérifier taille
            if ($_FILES[$file]['size'] > $tailleMax) {
                $_SESSION['error'] = " Le fichier $file dépasse la taille maximale de 5 Mo.";
                header("Location: inscription_proprietaire.php");
                exit;
            }

            $nomFichier = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES[$file]['tmp_name'], $uploadsDir . $nomFichier);
            $cheminsFichiers[$file] = $uploadsDir . $nomFichier;
        } else {
            $_SESSION['error'] = " Erreur lors de l'upload du fichier $file.";
            header("Location: inscription_proprietaire.php");
            exit;
        }
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

    $_SESSION['success'] = "✅ Votre demande a été envoyée avec succès. Elle sera vérifiée sous 4h.";
    header("Location: page de redirection.propri.php");
    exit;
}
?>

