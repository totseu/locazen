<?php
require 'inscription_client_action.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/output.css">
    <title>Inscription Client - Locazen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

   

<!-- Header / Nav -->
<header class=" fixed w-screen z-50">
    <div class="flex justify-between items-center py-4 px-6 md:px-20 -mt-0">
        <a href="/index.html"><img src="/tailwind css/src/assets/images/Logo moderne de Locazen avec maison (1).png" alt="Locazen" class="h-[70px] w-[90px] rounded-2xl"></a>
          <?php
    if (isset($erroMsg)){
        echo '<p class="bg-red-500 text-white p-3 rounded-lg text-center absolute top-20 ml-7 md:ml-[35%]">'.$erroMsg.'</p>';
    }

    if(isset($succeMsg)){
        echo '<p class="bg-green-500 text-white p-3 rounded-lg text-center absolute top-20 ml-7 md:ml-[35%]">'.$succeMsg.'</p>';
    }
    ?>
       
</header>

<section class=" relative top-20 ">
      

<!-- Formulaire inscription Client -->
<div class="min-h-screen flex items-center justify-center px-4 md:px-20 ">
 
    <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-2xl">
        <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Inscription Client</h2>
        <p class="text-gray-600 mb-6 text-center">
            Remplissez ce formulaire pour créer votre compte client sur Locazen.
        </p>

        <form action="#" method="POST" class="space-y-4">

            <div>
                <label for="nom" class="block text-gray-700 font-medium mb-1">Nom complet</label>
                <input type="text" name="nom" id="nom" placeholder="Ex: Jean Dupont"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="exemple@mail.com"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

             <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Tel</label>
                <input type="tel" name="Tel" id="Tel" placeholder="+237"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>


            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe</label>
                <input type="password" name="mdp" id="password" placeholder="••••••••"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <div class="text-sm text-gray-500">
                En vous inscrivant, vous acceptez la <a href="#" class="text-blue-600 hover:underline">politique d’utilisation</a> de Locazen.
            </div>

            <div>
                <button type="submit" name="valider" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                    S’inscrire
                </button>
            </div>

        </form>
    </div>
</div>
</section>

</body>
</html>
