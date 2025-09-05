<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil Propriétaire</title>
   <link rel="stylesheet" href="src/css/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
      <!-- Logo -->
      <h1 class="text-2xl font-bold text-blue-600">LocaZen</h1>
      <!-- Menu -->
      <div class="hidden md:flex space-x-8">
        <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Accueil</a>
        <a href="#tarifs" class="text-gray-700 hover:text-blue-600 font-medium">Tarifs</a>
        <a href="#publier" class="text-gray-700 hover:text-blue-600 font-medium">Publier</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="bg-blue-600 text-white py-16 text-center">
    <h2 class="text-4xl font-bold mb-4">Bienvenue dans votre espace propriétaire 👋</h2>
    <p class="text-lg text-blue-100 mb-6">Pour accéder à votre tableau de bord, choisissez une formule d’abonnement adaptée à vos besoins.</p>
    <a href="#tarifs" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
      Voir les abonnements
    </a>
  </header>

  <!-- Section Tarifs -->
  <section id="tarifs" class="max-w-6xl mx-auto py-12 px-6">
    <h3 class="text-3xl font-bold text-center text-gray-800 mb-10">Nos formules d’abonnement</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Carte 1 -->
      <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
        <h4 class="text-xl font-semibold mb-2">Pack Basic</h4>
        <p class="text-gray-600 mb-4">Idéal pour commencer</p>
        <p class="text-3xl font-bold text-blue-600 mb-6">5 000 FCFA <span class="text-sm">/mois</span></p>
        <ul class="text-gray-600 mb-6 space-y-2">
          <li>✅ Publier jusqu’à 3 biens</li>
          <li>✅ Assistance par email</li>
        </ul>
        <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">S’abonner</a>
      </div>

      <!-- Carte 2 -->
      <div class="bg-white shadow-lg rounded-2xl p-6 text-center border-2 border-blue-600">
        <h4 class="text-xl font-semibold mb-2">Pack Pro</h4>
        <p class="text-gray-600 mb-4">Le plus populaire</p>
        <p class="text-3xl font-bold text-blue-600 mb-6">10 000 FCFA <span class="text-sm">/mois</span></p>
        <ul class="text-gray-600 mb-6 space-y-2">
          <li>✅ Publier jusqu’à 10 biens</li>
          <li>✅ Mise en avant de vos annonces</li>
          <li>✅ Support prioritaire</li>
        </ul>
        <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">S’abonner</a>
      </div>

      <!-- Carte 3 -->
      <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-xl transition">
        <h4 class="text-xl font-semibold mb-2">Pack Premium</h4>
        <p class="text-gray-600 mb-4">Pour les grands propriétaires</p>
        <p class="text-3xl font-bold text-blue-600 mb-6">20 000 FCFA <span class="text-sm">/mois</span></p>
        <ul class="text-gray-600 mb-6 space-y-2">
          <li>✅ Biens illimités</li>
          <li>✅ Annonces boostées</li>
          <li>✅ Assistance 24/7</li>
        </ul>
        <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">S’abonner</a>
      </div>

    </div>
  </section>

  <!-- Section Publier -->
  <section id="publier" class="bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h3 class="text-2xl font-bold text-gray-800 mb-4">📢 Publier vos biens</h3>
      <p class="text-gray-600 mb-6">L’abonnement vous donne accès à l’espace publication pour gérer vos annonces facilement.</p>
      <a href="#tarifs" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">Je m’abonne pour publier</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white shadow-inner py-6">
    <div class="max-w-6xl mx-auto text-center text-gray-500 text-sm">
      © 2025 LocaZen - Espace Propriétaire. Tous droits réservés.
    </div>
  </footer>

</body>
</html>
