<?php
// texte_propri.php
require 'database.php'; // connexion PDO ($bdd)

if (isset($_POST['valider'])) {
    //Sécuriser les données reçues
    $type        = htmlspecialchars($_POST['type']);
    $titre       = htmlspecialchars($_POST['titre']);
    $adresse     = htmlspecialchars($_POST['adresse']);
    $prix        = (int) $_POST['prix'];
    $superficie  = (int) $_POST['superficie'];
    $description = htmlspecialchars($_POST['description']);

    //Insérer le bien dans la table "biens"
    $stmt = $bdd->prepare("INSERT INTO biens (type, titre, adresse, prix, superficie, description, date_pub) 
                           VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$type, $titre, $adresse, $prix, $superficie, $description]);

    $id_bien = $bdd->lastInsertId(); // ID du bien inséré

    //Créer les dossiers d’upload si nécessaire
    if (!is_dir("uploads/images")) mkdir("uploads/images", 0777, true);
    if (!is_dir("uploads/videos")) mkdir("uploads/videos", 0777, true);

    //Gestion des photos
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === 0) {
                $ext = strtolower(pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION));
                $nomFichier = uniqid("img_") . "." . $ext;
                $chemin = "uploads/images/" . $nomFichier;

                if (move_uploaded_file($tmp_name, $chemin)) {
                    $stmt = $bdd->prepare("INSERT INTO medias (bien_id, type, chemin) VALUES (?, 'image', ?)");
                    $stmt->execute([$id_bien, $chemin]);
                }
            }
        }
    }

    // Gestion des vidéos
    if (!empty($_FILES['videos']['name'][0])) {
        foreach ($_FILES['videos']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['videos']['error'][$key] === 0) {
                $ext = strtolower(pathinfo($_FILES['videos']['name'][$key], PATHINFO_EXTENSION));
                $nomFichier = uniqid("vid_") . "." . $ext;
                $chemin = "uploads/videos/" . $nomFichier;

                if (move_uploaded_file($tmp_name, $chemin)) {
                    $stmt = $bdd->prepare("INSERT INTO medias (bien_id, type, chemin) VALUES (?, 'video', ?)");
                    $stmt->execute([$id_bien, $chemin]);
                }
            }
        }
    }
   


    // Message de confirmation
    echo "<p style='color:green;font-weight:bold;'> Bien publié avec succès !</p>";
}




?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Propriétaire</title>
  <link rel="stylesheet" href="src/css/output.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>



  <style>
    .hidden { display: none; }
    .fade-in { animation: fadeIn 0.4s ease-in-out; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="bg-gray-50 font-sans">

  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-blue-700 to-indigo-800 text-white bg-blue-600 flex-col shadow-xl">
      <div class="p-6 border-b border-white/20 flex items-center gap-4">
        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Propriétaire" class="w-14 h-14 rounded-full object-cover border-2 border-white">
        <div>
          <h2 class="text-lg font-bold">Nathan Totseu</h2>
          <p class="text-sm text-white/80">Propriétaire</p>
        </div>
      </div>

      <nav class="flex-1 p-4 space-y-2">
        <button onclick="showSection('dashboard')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">🏠 Tableau de bord</button>
        <button onclick="showSection('biens')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">📦 Mes Biens</button>
        <button onclick="showSection('profil')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">👤 Mon Profil</button>
        <button onclick="showSection('transactions')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">💳 Transactions</button>
      </nav>

      <div class="p-4 border-t border-white/20">
        <button class="w-full bg-red-500 py-2 rounded-lg font-semibold hover:bg-red-600">🚪 Déconnexion</button>
      </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-8 overflow-y-auto">

      <!-- Dashboard -->
      <section id="dashboard" class="section fade-in">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Bienvenue <i class="fa-solid fa-door-open"></i></h1>

        <!-- Carte infos -->
        <div class="bg-white shadow-md rounded-2xl p-6 mb-6">
          <h2 class="text-lg font-semibold mb-4">📋 Informations personnelles</h2>
          <ul class="space-y-2 text-gray-700">
            <li><strong>Nom :</strong> Nathan Totseu</li>
            <li><strong>Email :</strong> proprietaire@mail.com</li>
            <li><strong>Abonnement :</strong> Mensuel (5 000 FCFA)</li>
            <li><strong>Biens publiés :</strong> 12</li>
          </ul>
        </div>

        <!-- Cartes statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-blue-50 shadow-md rounded-2xl p-6 text-center hover:shadow-lg transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-600">Biens publiés</h2>
            <p class="text-4xl font-bold text-blue-600">12</p>
          </div>
          <div class="bg-green-50 shadow-md rounded-2xl p-6 text-center hover:shadow-lg transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-600">Transactions</h2>
            <p class="text-4xl font-bold text-green-600">25</p>
          </div>
          <div class="bg-purple-50 shadow-md rounded-2xl p-6 text-center hover:shadow-lg transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-600">Profil complet</h2>
            <p class="text-4xl font-bold text-purple-600">90%</p>
          </div>
        </div>
        <!-- Graphique -->
        <h2 class="text-lg font-semibold my-6 text-gray-600">📈 Statistiques des ventes</h2>
      <div id="container" style="height: 400px; width: 100%;"></div>

       <footer class="bg-gray-800 text-gray-400 mt-5">
  <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between">
    
    <!-- Copyright -->
    <p class="text-sm">&copy; 2025 MonSite. Tous droits réservés.</p>
    
    <!-- Liens rapides -->
    <div class="flex space-x-6 mt-3 md:mt-0">
      <a href="#" class="hover:text-blue-400 text-sm">Conditions</a>
      <a href="#" class="hover:text-blue-400 text-sm">Confidentialité</a>
      <a href="#" class="hover:text-blue-400 text-sm">Aide</a>
    </div>
  </div>
</footer>
      </section>

     


      <!-- Gestion des biens -->
      <section id="biens" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">📦 Mes Biens</h2>
        <button id="btn_publier" class="mb-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">➕ Publier un bien</button>
        <table class="w-full border-collapse bg-white shadow-md rounded-2xl overflow-hidden">
          <thead class="bg-blue-50">
            <tr class="text-left text-gray-600">
              <th class="p-3">Nom du Bien</th>
              <th class="p-3">Statut</th>
              <th class="p-3">Prix</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">Appartement Yaoundé</td>
              <td class="p-3 text-green-600 font-semibold">Publié</td>
              <td class="p-3 font-medium">30 000 FCFA / mois</td>
              <td class="p-3 space-x-2">
                <button class="bg-yellow-500 px-3 py-1 rounded text-white hover:bg-yellow-600">Renommer</button>
                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Supprimer</button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="p-3">Villa Douala</td>
              <td class="p-3 text-yellow-600 font-semibold">En attente</td>
              <td class="p-3 font-medium">35 000 FCFA / mois</td>
              <td class="p-3 space-x-2">
                <button class="bg-blue-500 px-3 py-1 rounded text-white hover:bg-blue-600">Publier</button>
                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>

      

        <!-- formulaire publication bien -->
        <div id="formul_publier" class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-ls mt-2 hidden ">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">📌 Publier un Bien Immobilier</h2>

    <form action="publier_bien.php" method="POST" enctype="multipart/form-data">
     

      <!-- Type de bien -->
      <div>
        <label name="type" class="block text-gray-700 mb-2 font-medium">Type de bien</label>
        <select name="type" class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300">
          <option value="">-- Sélectionner --</option>
          <option value="appartement">Appartement</option>
          <option value="maison">Maison</option>
          <option value="local">Local commercial</option>
          <option value="bureau">Bureau</option>
        </select>
      </div>

      <!-- Titre de l’annonce -->
      <div>
        <label name="titre" class="block text-gray-700 mb-2 font-medium">Titre de l’annonce</label>
        <input type="text" name="titre" placeholder="Ex: Appartement T3 centre-ville"
               class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300">
      </div>

      <!-- Adresse -->
      <div>
        <label name="adresse" class="block text-gray-700 mb-2 font-medium">Adresse</label>
        <input type="text" name="adresse" placeholder="Ville, quartier, rue..."
               class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300">
      </div>

      <!-- Prix -->
      <div>
        <label name="prix" class="block text-gray-700 mb-2 font-medium">Prix (€)</label>
        <input type="number" name="prix" placeholder="Ex: 45000fcfa"
               class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300">
      </div>

      <!-- Superficie -->
      <div>
        <label name="superficie" class="block text-gray-700 mb-2 font-medium">Superficie (m²)</label>
        <input type="number" name="superficie" placeholder="Ex: 120"
               class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300">
      </div>

      <!-- Description -->
      <div>
        <label name="description" class="block text-gray-700 mb-2 font-medium">Description</label>
        <textarea name="description" rows="4" placeholder="Décrivez les caractéristiques du bien... les avantages "
                  class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-300 "></textarea>
      </div>

      <!-- Photos -->
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Photos du bien</label>
        <input type="file"  name="images[]" accept="image/*" multiple
               class="w-full border rounded-lg p-3 bg-gray-50 focus:ring focus:ring-blue-300">
      </div>

      <!-- video -->
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Photos du bien</label>
        <input type="file"name="videos[]" accept="video/*" multiple
               class="w-full border rounded-lg p-3 bg-gray-50 focus:ring focus:ring-blue-300">
              
      </div>

      <!-- Bouton -->
      <button name="valider" id="publier" type="submit"
              class="w-1/2 text-center bg-blue-600 text-white p-3 rounded-xl font-semibold hover:bg-blue-700 transition relative left-1/4">
        ✅ Publier le bien
      </button>

    </form>
  </div>
      </section>

      <!-- Profil -->
      <section id="profil" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">👤 Mon Profil</h2>
        <form class="bg-white p-6 rounded-2xl shadow-lg space-y-4">
          <div>
            <label class="block text-gray-600 font-medium">Nom</label>
            <input type="text" class="w-full border rounded-lg p-2 mt-1" value="Nathan Totseu">
          </div>
          <div>
            <label class="block text-gray-600 font-medium">Email</label>
            <input type="email" class="w-full border rounded-lg p-2 mt-1" value="nathaTotseu@mail.com">
          </div>
          <div>
            <label class="block text-gray-600 font-medium">Mot de passe</label>
            <input type="password" class="w-full border rounded-lg p-2 mt-1" value="********">
          </div>
          <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">💾 Mettre à jour</button>
        </form>
      </section>

      <!-- Transactions -->
      <section id="transactions" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">💳 Mes Transactions</h2>
        <ul class="bg-white rounded-2xl shadow-md divide-y">
          <li class="py-3 px-4 flex justify-between hover:bg-gray-50">
            <span>Abonnement mensuel</span>
            <span class="text-green-600 font-semibold">5 000 FCFA</span>
          </li>
          <li class="py-3 px-4 flex justify-between hover:bg-gray-50">
            <span>Publication bien</span>
            <span class="text-green-600 font-semibold">2 000 FCFA</span>
          </li>
        </ul>
      </section>

    </main>
  </div>

  <!-- Script -->
  <script>
    function showSection(sectionId) {
      document.querySelectorAll('.section').forEach(sec => sec.classList.add('hidden'));
      const section = document.getElementById(sectionId);
      section.classList.remove('hidden');
      section.classList.add('fade-in');
      setTimeout(() => section.classList.remove('fade-in'), 500);
    }

     
          const btn_publier= document.getElementById("btn_publier");
          const formul_publier = document.getElementById("formul_publier");
          const publier = document.getElementById("publier");
          btn_publier.addEventListener("click", ()=>{
            formul_publier.classList.toggle("hidden");
            btn_publier.classList.toggle("bg-gray-300");
            btn_publier.classList.toggle("hover:bg-green-700");
          });
          publier.addEventListener("click", ()=>{
            formul_publier.classList.add("hidden");
            btn_publier.classList.toggle("bg-green-600");
            btn_publier.classList.toggle("hover:bg-green-700");
          })

          //graphe
Highcharts.chart('container', {
    chart: { type: 'line' },
    title: { text: 'Évolution des Ventes' },
    xAxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May'] },
    yAxis: { title: { text: 'Ventes' } },
    series: [{
        name: 'Produit A',
        data: [29, 71, 106, 129, 144]
    }, {
        name: 'Produit B',
        data: [34, 78, 92, 140, 160]
    }]
});
       
  </script>
</body>
</html>
