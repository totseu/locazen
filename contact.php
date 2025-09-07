<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/css/output.css">
  <title>Contactez-nous</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<section class="bg-gray-100 min-h-screen">
  <!-- Header -->
   
  <div class="bg-blue-600 text-white py-16 text-center">
     <div class="">
                <a href="/tailwind css/index.php"><img src="/tailwind css/src/assets/images/Logo moderne de Locazen avec maison (1).png" alt="locazen" class="h-[70px] w-[90px] rounded-2xl -mt-10 md:ml-20"></a>
            </div>
    <h1 class="text-5xl font-bold mb-4">Contactez-nous</h1>
    <p class="text-lg max-w-2xl mx-auto">Nous sommes disponibles pour répondre à toutes vos questions. Remplissez le formulaire ou utilisez nos coordonnées ci-dessous.</p>
  </div>

  <!-- Contenu principal -->
  <div class="container mx-auto py-16 px-6 md:px-0 flex flex-col md:flex-row gap-12">
    
    <!-- Formulaire -->
    <div class="md:w-1/2 bg-white p-10 rounded-xl shadow-lg">
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Envoyez-nous un message</h2>
      <form class="space-y-6">
        <div>
          <label class="block text-gray-700 mb-1">Nom complet</label>
          <input type="text" placeholder="Votre nom" class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"/>
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Email</label>
          <input type="email" placeholder="Votre email" class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"/>
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Sujet</label>
          <input type="text" placeholder="Sujet" class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"/>
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Message</label>
          <textarea placeholder="Votre message" class="w-full px-5 py-3 border border-gray-300 rounded-lg h-32 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Envoyer</button>
      </form>

      <!-- Coordonnées détaillées -->
      <div class="mt-10 text-gray-700">
        <h3 class="text-2xl font-semibold mb-4">Nos coordonnées</h3>
        <p class="mb-2"><strong>Adresse :</strong> Douala, Cameroun</p>
        <p class="mb-2"><strong>Téléphone :</strong> +237 6 91 72 73 82</p>
        <p class="mb-2"><strong>Email :</strong> contact@locazen.com</p>
        <p class="mb-2"><strong>Horaires :</strong> Lundi - Vendredi, 9h - 18h</p>

        <div class="mt-4 flex space-x-4">
          <a href="#" class="text-blue-600 hover:text-blue-800">Facebook</a>
          <a href="#" class="text-blue-400 hover:text-blue-600">Twitter</a>
         
          <a href="#" class="text-blue-700 hover:text-blue-900">LinkedIn</a>
        </div>
      </div>
    </div>

    <!-- Image + Google Maps -->
    <div class="md:w-1/2 flex flex-col gap-8">
      <!-- Image ou illustration -->
      <div class="rounded-xl overflow-hidden shadow-lg">
        <img src="/tailwind%20css/src/assets/images/ville%20de%20douala.jpg" alt="Illustration contact" class="w-full h-64 object-cover"/>
      </div>

      <!-- Google Maps -->
      <div class="rounded-xl overflow-hidden shadow-lg">
        <iframe class="w-full h-64 md:h-80" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.153316328773!2d9.70909021535088!3d4.04841989697412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10610f4f3c8b9b09%3A0x6e6b6f7a2d2c4d0!2sDouala%2C%20Cameroun!5e0!3m2!1sfr!2s!4v1693566789530!5m2!1sfr!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

  </div>

  <!-- Newsletter / Suivez-nous -->
  <div class="bg-blue-50 py-16 mt-12 text-center">
    <h3 class="text-3xl font-bold text-gray-800 mb-4">Restez informé</h3>
    <p class="text-gray-600 mb-6">Abonnez-vous à notre newsletter pour recevoir toutes nos actualités.</p>
    <div class="max-w-xl mx-auto flex flex-col sm:flex-row gap-4 justify-center">
      <input type="email" placeholder="Votre email" class="w-full sm:flex-1 px-5 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"/>
      <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">S'abonner</button>
    </div>
  </div>
</section>



  





<!--footer-->

<footer class="bg-gray-900 text-gray-300 py-12">
  <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
    
    <!-- Logo & Description -->
    <div>
      <h3 class="text-white text-2xl font-bold mb-4 ">Locazen</h3>
      <p class="text-gray-400 text-sm">
        La plateforme de location de logements simple, sécurisée et rapide.
      </p>
    </div>
    
    <!-- Liens Utiles -->
    <div>
      <h4 class="text-white font-semibold mb-4">Liens utiles</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-white">Accueil</a></li>
        <li><a href="#" class="hover:text-white">Catégories</a></li>
        <li><a href="#" class="hover:text-white">À propos</a></li>
        <li><a href="#" class="hover:text-white">Contact</a></li>
        <li><a href="#" class="hover:text-white">FAQ</a></li>
      </ul>
    </div>
    
    <!-- Support -->
    <div>
      <h4 class="text-white font-semibold mb-4">Support</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-white">Aide & Support</a></li>
        <li><a href="#" class="hover:text-white">Politique de confidentialité</a></li>
        <li><a href="#" class="hover:text-white">Conditions d’utilisation</a></li>
      </ul>
    </div>
    
    <!-- Contact -->
    <div>
      <h4 class="text-white font-semibold mb-4">Contactez-nous</h4>
      <p class="text-sm mb-2"> <i class="fa-solid fa-location-dot"></i> 123 Rue de l’Immobilier, douala ,yaounde</p>
      <p class="text-sm mb-2"> <i class="fa-solid fa-phone-volume"></i>+237 6 91 72 73 82</p>
      <p class="text-sm mb-2"> <i class="fa-solid fa-envelope"></i> contact@locazen.com</p>
      <div class="flex space-x-4 mt-4">
        <a href="#" aria-label="Facebook" class="hover:text-white"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" aria-label="Twitter" class="hover:text-white"><i class="fa-brands fa-twitter"></i></a>
        <a href="#" aria-label="telegrame" class="hover:text-white"><i class="fa-brands fa-telegram"></i></a>
         <a href="#" aria-label="whatssap" class="hover:text-white"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </div>
    
  </div>

  <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
    © 2025 Locazen. Tous droits réservés.
  </div>
</footer>

</body>
</html>
