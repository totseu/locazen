<?php

require 'database.php';

// Validation du formulaire
if (isset($_POST['valider'])) {

    if (!empty($_POST['Nom']) && !empty($_POST['Email']) && !empty($_POST['Tel']) && !empty($_POST['mdp'])) {

        // Création des variables
        $Nom   = htmlspecialchars(trim($_POST['Nom']));
        $Email = strtolower(trim($_POST['Email'])); // nettoyage + minuscule
        $Tel   = htmlspecialchars(trim($_POST['Tel']));
        $mdp   = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        // Vérifier si l'utilisateur existe déjà
        $verificationUser = $bdd->prepare("SELECT id FROM clients WHERE LOWER(Email) = LOWER(?)");
        $verificationUser->execute([$Email]);

        if ($verificationUser->rowCount() == 0) {

            // Insertion utilisateur
            $inseruser = $bdd->prepare("INSERT INTO clients(Nom, Email, Tel, mdp) VALUES(?,?,?,?)");
            $inseruser->execute([$Nom, $Email, $Tel, $mdp]);

            // Récupérer l'ID inséré
            $userId = $bdd->lastInsertId();

            // Stocker les infos en session
            $_SESSION['auth'] = true;
            $_SESSION['id']   = $userId;
            $_SESSION['Nom']  = $Nom;
            $_SESSION['Email']= $Email;
            $_SESSION['Tel']  = $Tel;

            // Redirection
            header('location: texte_client.php');
            exit();

        } else {
            $erroMsg = "Votre email existe déjà.";
        }
    } else {
        $erroMsg = "Veuillez compléter tous les champs.";
    }
}
?>

