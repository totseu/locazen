<?php

//connexion a la base de donnee
require 'database.php';

//validation du formulaire 
if (isset($_POST['valider'])) {

    if (!empty($_POST['nom']) and !empty($_POST['email']) and !empty($_POST['Tel'])  and !empty($_POST['mdp']) ) {

        //creation des variables 
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $Tel = htmlspecialchars($_POST['Tel']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

   // verifier si l'utilisateur existe deja 
        $verificationUser = $bdd->prepare("SELECT * FROM users WHERE email = ? ");
        $verificationUser->execute(array($email));

   //si utilisateur n'existe pas on l'insere dans la base de donnee
        if($verificationUser->rowCount() == 0){

           // insertion de l'utilisateur dans la base de donne 
            $inseruser = $bdd->prepare("INSERT INTO users(nom, email,Tel, mdp) VALUES(?,?,?,?)");
            $inseruser->execute(array($nom, $email,$Tel, $mdp));
            $succeMsg="votre compte a ete cree avec succes";

      //recuperer les infos de l'utilisateur 
            $recupereUser = $bdd->prepare("SELECT id , nom, email, Tel  FROM users WHERE nom = ? and email = ? and Tel=? ");
            $recupereUser->execute(array($nom, $email,$Tel));

     //stocker les infos dans une session
            $userIfos = $recupereUser->fetch();
            $_SESSION['auth'] = true;
            $_SESSION['id']= $userIfos['id'];
            $_SESSION['nom']= $userIfos['nom'];
             $_SESSION['email']= $userIfos['email'];
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