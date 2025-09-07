<?php

//connexion a la base de donnee
require 'database.php';

//validation du formulaire 
if (isset($_POST['valider'])) {

    if (!empty($_POST['Nom']) and !empty($_POST['Email']) and !empty($_POST['Tel'])  and !empty($_POST['mdp']) ) {

        //creation des variables 
        $Nom = htmlspecialchars($_POST['Nom']);
        $Email = htmlspecialchars($_POST['Email']);
        $Tel = htmlspecialchars($_POST['Tel']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

   // verifier si l'utilisateur existe deja 
        $verificationUser = $bdd->prepare("SELECT * FROM users WHERE Email = ? ");
        $verificationUser->execute(array($Email));

   //si utilisateur n'existe pas on l'insere dans la base de donnee
        if($verificationUser->rowCount() == 0){

           // insertion de l'utilisateur dans la base de donne 
            $inseruser = $bdd->prepare("INSERT INTO users(Nom, Email,Tel, mdp) VALUES(?,?,?,?)");
            $inseruser->execute(array($Nom, $Email,$Tel, $mdp));
            $succeMsg="votre compte a ete cree avec succes";

      //recuperer les infos de l'utilisateur 
            $recupereUser = $bdd->prepare("SELECT id , Nom, Email, Tel  FROM users WHERE Nom = ? and email = ? and Tel=? ");
            $recupereUser->execute(array($Nom, $Email,$Tel));

     //stocker les infos dans une session
            $userIfos = $recupereUser->fetch();
            $_SESSION['auth'] = true;
            $_SESSION['id']= $userIfos['id'];
            $_SESSION['Nom']= $userIfos['Nom'];
             $_SESSION['Email']= $userIfos['Email'];
              $_SESSION['Tel']= $userIfos['Tel'];
     //redirection vers la page d'accueil
              header('location: texte_client.php');

    //    echo "inscription reussie";
        }else{
            $erroMsg="votre email existe deja ";
        }
        //fin de la condition si les champs sont vides
        }else{
            $erroMsg="veuillez completer tous les champs";
        }

    
}
?>