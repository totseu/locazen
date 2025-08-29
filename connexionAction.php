<?php

//validation du formulaire

if(isset($_POST['valider'])){

    if(!empty($_POST['email']) and !empty($_POST['mdp']) and !empty($_POST['role']) ){

        //connexion a la base de donnee 
        require 'database.php';

        //creation des variables 
        $email=htmlspecialchars($_POST['email']);
        $mdp=htmlspecialchars($_POST['mdp']);
        $role=htmlspecialchars($_POST['role']);

        if($role == "client"){
            //verifier si l'utilisateur existe dans la base de donnee
            $verifUser = $bdd->prepare("SELECT * FROM users WHERE email = ? ");
            $verifUser->execute(array($email));
    
            if($verifUser->rowCount() > 0){
                //recuperer les infos de l'utilisateur 
                $userIfos = $verifUser->fetch();
    
                //verifier le mot de passe 
                if(password_verify($mdp, $userIfos['mdp'])){
                    //stocker les infos dans une session
                    $_SESSION['auth'] = true;
                    $_SESSION['id']= $userIfos['id'];
                    $_SESSION['nom']= $userIfos['nom'];
                    $_SESSION['email']= $userIfos['email'];
                    $_SESSION['Tel']= $userIfos['Tel'];
    
                    //redirection vers la page d'accueil
                    header('location: texte_client.php?id='.$_SESSION['id']);
    
                }else{
                    $erroMsg="mot de passe incorrect";
                }
    
            }else{
                $erroMsg="cet utilisateur n'existe pas";
            }

        }elseif($role == "proprietaire"){

            //verifier si l'utilisateur existe dans la base de donnee
            $verifUser = $bdd->prepare("SELECT * FROM proprietaire WHERE email = ? ");
            $verifUser->execute(array($email));
    
            if($verifUser->rowCount() > 0){
                //recuperer les infos de l'utilisateur 
                $userIfos = $verifUser->fetch();
    
                //verifier le mot de passe 
                if(password_verify($mdp, $userIfos['mdp'])){
                    //stocker les infos dans une session
                    $_SESSION['auth'] = true;
                    $_SESSION['id']= $userIfos['id'];
                    $_SESSION['nom']= $userIfos['nom'];
                     $_SESSION['email']= $userIfos['email'];
                        $_SESSION['Tel']= $userIfos['Tel'];

                    //redirection vers la page d'accueil
                    header('location: texte_proprietaire.php');
                }else{
                    $erroMsg="mot de passe incorrect";
                }
            }else{
                $erroMsg="cet utilisateur n'existe pas";
            }
        }else{
            $erroMsg="veuillez choisir un role";
        }
    }else{
        $erroMsg="veuillez completer tous les champs";
    }
}


?>