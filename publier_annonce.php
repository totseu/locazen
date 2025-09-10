<?php

require 'database.php'; // connexion PDO ($bdd)

// Vérifier si le propriétaire est connecté
if (!isset($_SESSION['proprio_id'])) {
    die("Accès refusé. Connectez-vous d'abord.");
}

// Vérifier si le formulaire est soumis
if (isset($_POST['valider'])) {
    $type = trim($_POST['type']);
    $titre = trim($_POST['titre']);
    $adresse = trim($_POST['adresse']);
    $prix = floatval($_POST['prix']);
    $superficie = floatval($_POST['superficie']);
    $description = trim($_POST['description']);
    $proprio_id = $_SESSION['proprio_id'];

    if ($type && $titre && $adresse && $prix > 0 && $superficie > 0 && $description) {

        // 1️⃣ Insertion de l'annonce avec date/heure
        $stmt = $bdd->prepare("INSERT INTO annonce 
            (proprietaire_id, type, titre, adresse, description, prix, superficie, statut, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW())");
        $stmt->execute([$proprio_id, $type, $titre, $adresse, $description, $prix, $superficie]);
        $annonce_id = $bdd->lastInsertId();

        // 2️⃣ Dossier d'upload
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        // 3️⃣ Upload des images
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                $fileName = time().'_'.basename($_FILES['images']['name'][$key]);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($tmpName, $targetFile)) {
                    $stmtImg = $bdd->prepare("INSERT INTO annonce_media (annonce_id, media_type, file_path) VALUES (?, 'image', ?)");
                    $stmtImg->execute([$annonce_id, 'uploads/'.$fileName]);
                }
            }
        }

        // 4️⃣ Upload des vidéos
        if (!empty($_FILES['videos']['name'][0])) {
            foreach ($_FILES['videos']['tmp_name'] as $key => $tmpName) {
                $fileName = time().'_'.basename($_FILES['videos']['name'][$key]);
                $targetFile = $uploadDir . $fileName;
                if (move_uploaded_file($tmpName, $targetFile)) {
                    $stmtVid = $bdd->prepare("INSERT INTO annonce_media (annonce_id, media_type, file_path) VALUES (?, 'video', ?)");
                    $stmtVid->execute([$annonce_id, 'uploads/'.$fileName]);
                }
            }
        }

        echo "<p style='color:green;'>✅ Bien publié avec succès !</p>";
        echo "<p>Publié le : ".date('d/m/Y H:i')."</p>";

    } else {
        echo "<p style='color:red;'>Tous les champs sont obligatoires.</p>";
    }
} else {
    echo "<p style='color:red;'>Formulaire non soumis.</p>";
}
?>
