<?php


require 'database.php';

// Validation du formulaire
if (isset($_POST['valider'])) {

    if (!empty($_POST['Email']) && !empty($_POST['mdp']) && !empty($_POST['role'])) {

        // Variables sécurisées
        $email = htmlspecialchars($_POST['Email']);
        $mdp   = $_POST['mdp']; // pas besoin de htmlspecialchars ici
        $role  = htmlspecialchars($_POST['role']);

        if ($role === "client") {

            // Vérifier utilisateur client
            $verifUser = $bdd->prepare("SELECT * FROM client WHERE Email = ?");
            $verifUser->execute([$email]);

            if ($verifUser->rowCount() > 0) {
                $userInfos = $verifUser->fetch();

                if (password_verify($mdp, $userInfos['mdp'])) {
                    // Stocker en session
                    $_SESSION['auth']  = true;
                    $_SESSION['id']    = $userInfos['id'];
                    $_SESSION['Nom']   = $userInfos['Nom'];
                    $_SESSION['Email'] = $userInfos['Email'];
                    $_SESSION['Tel']   = $userInfos['Tel'];

                    header('Location: texte_client.php');
                    exit;
                } else {
                    $erroMsg = "Mot de passe incorrect";
                }
            } else {
                $erroMsg = "Cet utilisateur n'existe pas";
            }

        } elseif ($role === "proprietaire") {

            // Vérifier utilisateur propriétaire
            $verifUser = $bdd->prepare("SELECT * FROM proprietaire WHERE Email = ?");
            $verifUser->execute([$email]);

            if ($verifUser->rowCount() > 0) {
                $userInfos = $verifUser->fetch();

                if (password_verify($mdp, $userInfos['mdp'])) {
                    $_SESSION['auth']  = true;
                    $_SESSION['id']    = $userInfos['id'];
                    $_SESSION['Nom']   = $userInfos['Nom'];
                    $_SESSION['Email'] = $userInfos['Email'];
                    $_SESSION['Tel']   = $userInfos['Tel'];

                    header('Location: texte_proprietaire.php');
                    exit;
                } else {
                    $erroMsg = "Mot de passe incorrect";
                }
            } else {
                $erroMsg = "Cet utilisateur n'existe pas";
            }

        } else {
            $erroMsg = "Veuillez choisir un rôle valide";
        }

    } else {
        $erroMsg = "Veuillez compléter tous les champs";
    }
}
?>
