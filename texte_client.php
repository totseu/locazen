  <?php
//connexion a la base de donnee
require 'database.php';  // connexion PDO ($bdd)
  // require 'securiteAction.php';
 
?>
<?php
if(!isset($_SESSION['auth'])){
    header('location: connexion.php');
    exit();
}





// Récupérer tous les biens

// $stmt = $bdd->query("SELECT * FROM biens ORDER BY date_pub DESC");
// $biens = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="src/css/output.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Client - Locazen</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .hidden { display: none; }
    .fade-in { animation: fadeIn 0.4s ease-in-out; }
    @keyframes fadeIn { 
      from {opacity:0; transform:translateY(10px);} 
      to {opacity:1; transform:translateY(0);} 
    }
  </style>
</head>
<body class="bg-gray-50 font-sans">
 



<div class="flex ">

  <!-- Sidebar -->
<!-- Sidebar -->
<aside id="sidebar" class="w-64 border-b bg-blue-600 text-white h-screen flex-col fixed hidden md:block">
      <!-- Profil utilisateur -->
    <div class="p-6 border-b bg-blue-600 flex items-center gap-4">
        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="client" class="w-14 h-14 rounded-full object-cover border-2 border-white">
        <div>
          <h2 class="text-lg font-bold">  <?php  if(isset($_SESSION['Nom'])){ echo $_SESSION['Nom']; } ?> </h2> 
          <p class="text-sm text-white/80">client</p>
        </div>
      </div>

      

    
    <!-- Menu de navigation -->

    <nav class="flex-1 p-4 space-y-3  bg-blue-600">
      <button  onclick="showSection('home')" class=" menu-btn w-full text-left px-4 py-2 rounded-lg  bg-blue-600 hover:bg-blue-700"><i class="fa-solid fa-house"></i> Accueil</button>
      <button onclick="showSection('mesReservations')" class=" menu-btn w-full text-left px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700">📦 Mes Réservations</button>
      <button onclick="showSection('profil')" class=" menu-btn w-full text-left px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700"><i class="fa-solid fa-user"></i> Mon Profil</button>
      <button onclick="showSection('transactions')" class=" menu-btn w-full text-left px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700">💳 Transactions</button>
    </nav>



    <!-- Bouton de déconnexion -->
    <div class="p-4 border-t bg-blue-600 ">
      <a href="/tailwind css/deconnecteSession.php"><button class="w-full bg-red-500 py-2 rounded-lg hover:bg-red-600">Déconnexion</button></a>
    </div>
  </aside>

  <!-- Overlay -->
<div id="overlay" class="hidden fixed inset-0 bg-black/40 z-40"></div>


  <!-- Contenu principal -->
  <main class="flex-1 p-6 md:ml-64  overflow-y-auto absolute md:relative">
     

    <!-- Accueil / Liste des biens -->
    <section id="home" class="section fade-in">
      <div class= "flex justify-between items-center mr-14 ">
         <button id="amberger" class="md:hidden text-4xl mr-5"><i class="fa-solid fa-bars"></i></button>
      <h1 class="text-2xl font-bold mb-6 text-gray-700 mt-5">Découvrez nos biens</h1>
      </div>

     <script>
  const amberger = document.getElementById("amberger");
  const sidebar = document.getElementById("sidebar"); // fonctionne car on a mis id="sidebar"
  const overlay = document.getElementById("overlay");
  const menuBtns = document.querySelectorAll(".menu-btn");

  // ouvrir
  amberger.addEventListener("click", () => {
    sidebar.classList.remove("hidden");
    sidebar.classList.add("fixed", "z-50", "bg-blue-600");
    overlay.classList.remove("hidden");
  });

  // fermer (clic en dehors)
  overlay.addEventListener("click", () => {
    sidebar.classList.add("hidden");
    overlay.classList.add("hidden");
  });

  // fermer (clic sur un bouton du menu)
  menuBtns.forEach(btn => {
    btn.addEventListener("click", () => {
      sidebar.classList.add("hidden");
      overlay.classList.add("hidden");
    });
  });
</script>


     

      <!-- Recherche -->
      <div class="flex mb-6 space-x-4">
        <input type="text" placeholder="Rechercher un bien..." class="flex-1 p-2 border rounded-lg">
        <button class="bg-gray-500 text-white py-1 px-1 md:px-4 md:py-2  rounded-lg"> <i class="fa-solid fa-magnifying-glass"></i> Rechercher</button>
      </div>

      <!-- Catégories -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 mb-6">
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Bien le mieux situé</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1  rounded-lg">Bien le plus grand</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Bien le plus récent</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Studios</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Chambre moderne</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white  px-1 py-1 rounded-lg">Appartements</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white  px-1 py-1 rounded-lg">Bureaux</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Boutiques</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Boutiques</button>
        <button class="bg-blue-500 hover:bg-blue-700  text-white px-1 py-1 rounded-lg">Boutiques</button>
      </div>

      <!-- Liste des biens -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Exemple de carte bien -->
        <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         
    

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
         <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
          <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
             <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
           <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img  src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
           <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>

         <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col">
          <img  src="/tailwind css/src/assets/images/immeuble1.jpg" alt="Appartement Yaoundé" class="rounded-xl mb-4">
          <h2 class="font-bold text-gray-900 text-lg mb-2">Appartement Yaoundé</h2>
          <p class="text-gray-500 mb-1"> <i class="fa-solid fa-location-dot"></i> Yaoundé</p>
          <p class="text-gray-800 font-semibold mb-2">1 500 000 FCFA</p>
          <div class="mt-auto flex justify-between">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Réserver</button>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded-lg">voir details</button>
          </div>
        </div>
        <!-- Dupliquer cette carte pour chaque bien -->
      </div>
              
<!-- Footer -->
<footer class="bg-gray-900 text-gray-300 py-12 mt-12 ">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <h3 class="text-white text-2xl font-bold mb-4">Locazen</h3>
            <p class="text-gray-400 text-sm">
                La plateforme de location de logements simple, sécurisée et rapide.
            </p>
        </div>
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
        <div>
            <h4 class="text-white font-semibold mb-4">Support</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:text-white">Aide & Support</a></li>
                <li><a href="#" class="hover:text-white">Politique de confidentialité</a></li>
                <li><a href="#" class="hover:text-white">Conditions d’utilisation</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white font-semibold mb-4">Contactez-nous</h4>
            <p class="text-sm mb-2"> <i class="fa-solid fa-location-dot"></i>  123 Rue de l’Immobilier, Douala, Yaoundé</p>
            <p class="text-sm mb-2"><i class="fa-solid fa-phone-volume"></i> +237 6 91 72 73 82</p>
            <p class="text-sm mb-2"> <i class="fa-solid fa-envelope"></i> contact@locazen.com</p>
            <div class="flex space-x-4 mt-4">
                <a href="#" aria-label="Facebook" class="hover:text-white"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" aria-label="Twitter" class=""><i class="fa-brands fa-twitter"></i></a>
                <a href="#" aria-label="Instagram" class="hover:text-white"><i class="fa-brands fa-telegram"></i></a>
                 <a href="#" aria-label="whatssap" class="hover:text-white"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
        © 2025 Locazen. Tous droits réservés.
    </div>
</footer>
    </section>

    <!-- Mes Réservations -->
    <section id="mesReservations" class="section hidden">
       <div class=" text-3xl md:hidden" ><a href="/texte_client.php"><i class="fa-solid fa-arrow-left"></i></a> </div>
      <h2 class="text-xl font-bold mb-4 w-80">Mes Réservations</h2>
      <ul class="bg-white rounded-2xl shadow-lg divide-y">
        <li class="py-3 px-4 flex justify-between">
          <span>Appartement Yaoundé</span>
          <span class="text-green-600 font-semibold">Réservé</span>
        </li>
        <li class="py-3 px-4 flex justify-between">
          <span>Villa Douala</span>
          <span class="text-green-600 font-semibold">Réservé</span>
        </li>
      </ul>
    </section>

    <!-- Profil -->
    <section id="profil" class="section hidden w-80 md:w-full">
     <div class=" text-3xl md:hidden" ><a href="/texte_client.php"><i class="fa-solid fa-arrow-left"></i></a> </div>
      <h2 class="text-xl font-bold mb-4">Mon Profil</h2>
      <form class="bg-white p-6 rounded-2xl shadow-lg space-y-4 ">
        <div>
          <label class="block text-gray-600">Nom</label>
          <input type="text" class="w-full border rounded-lg p-2" value="Jean Client">
        </div>
        <div>
          <label class="block text-gray-600">Email</label>
          <input type="email" class="w-full border rounded-lg p-2" value="client@mail.com">
        </div>
        <div>
          <label class="block text-gray-600">Mot de passe</label>
          <input type="password" class="w-full border rounded-lg p-2" value="********">
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
      </form>
    </section>

    <!-- Transactions -->
    <section id="transactions" class="section hidden w-82 md:w-full">
      <div class=" text-3xl md:hidden" ><a href="/texte_client.php"><i class="fa-solid fa-arrow-left"></i></a> </div>
      <h2 class="text-xl font-bold mb-4">Mes Transactions</h2>
      <ul class="bg-white rounded-2xl shadow-lg divide-y">
        <li class="py-3 px-4 flex justify-between">
          <span>Réservation Appartement Yaoundé</span>
          <span class="text-green-600 font-semibold">1 500 000 FCFA</span>
        </li>
        <li class="py-3 px-4 flex justify-between">
          <span>Réservation Villa Douala</span>
          <span class="text-green-600 font-semibold">3 500 000 FCFA</span>
        </li>
      </ul>
    </section>

  </main>
</div>

<script>
  function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(sec => sec.classList.add('hidden'));
    const section = document.getElementById(sectionId);
    section.classList.remove('hidden');
    section.classList.add('fade-in');
    setTimeout(() => section.classList.remove('fade-in'), 500);
  }






          

        


</script>

</body>
</html>
