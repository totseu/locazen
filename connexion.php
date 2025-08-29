<?php
require 'connexionAction.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/output.css">
    <title>Connexion - Locazen</title>
</head>
<body class="bg-gray-100">


   
<!-- Header / Nav -->
<header class=" fixed w-screen z-50">
    <div class="flex justify-between items-center py-4 px-6 md:px-20 -mt-10">
        <a href="/tailwind css/index.php"><img src="/tailwind css/src/assets/images/Logo moderne de Locazen avec maison (1).png" alt="Locazen" class="h-[70px] w-[90px] rounded-2xl"></a>
</header>



    <!-- Formulaire de connexion -->
    <section class="flex justify-center items-center min-h-screen  mt-10  ">
        <?php
         if(isset($erroMsg)){
            echo '<p class="bg-red-500 text-white p-3 rounded-lg text-center absolute top-20">'.$erroMsg.'</p>';
         }
       
        ?>
        <div class="bg-white shadow-lg rounded-2xl p-10 w-full max-w-md">
            <h2 class="text-3xl font-bold text-blue-700 text-center mb-8">Se connecter</h2>

            <form action="#" method="POST" class="space-y-5">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email :</label>
                    <input type="email" id="email" name="email" placeholder="Votre email"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe :</label>
                    <input type="password" id="password" name="mdp" placeholder="Votre mot de passe"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-gray-700 font-medium mb-2">Rôle :</label>
                    <select id="role" name="role" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                        <option value="">Sélectionnez votre rôle</option>
                        <option value="client">Client</option>
                        <option value="proprietaire">Propriétaire</option>
                    </select>
                </div>

                <!-- Bouton connexion -->
                <button type="submit" name="valider" class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition">
                    Se connecter
                </button>
            </form>

            <p class="text-sm text-gray-500 text-center mt-4">
                Pas encore de compte ? 
                <a href="/s'incristion_client.html" class="text-blue-600 hover:underline">Inscrivez-vous ici</a>
            </p>
        </div>
    </section>



</body>
</html>
