<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tarifs Propriétaire - Locazen</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Header -->
<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="index.php" class="text-2xl font-bold text-blue-600">Locazen</a>
        <nav class="space-x-6">
            <a href="index.php" class="text-gray-700 hover:text-blue-600">Accueil</a>
            <a href="tarifs_proprietaire.php" class="text-blue-600 font-semibold">Tarifs</a>
            <a href="contact.php" class="text-gray-700 hover:text-blue-600">Contact</a>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="text-center py-16 bg-blue-50">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Tarifs pour Propriétaires</h1>
    <p class="text-gray-700 max-w-xl mx-auto">Choisissez le plan qui vous permet de gérer vos biens efficacement et d’optimiser vos revenus.</p>
</section>

<!-- Tarifs Section -->
<section class="max-w-7xl mx-auto px-6 py-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
    
    <!-- Carte Tarif Standard -->
    <div class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transform transition">
        <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">Standard</h2>
        <p class="text-gray-600 mb-6 text-center">Pour les propriétaires débutants qui souhaitent publier quelques biens.</p>
        <div class="text-center mb-6">
            <span class="text-4xl font-bold">10 000 FCFA</span>
            <span class="text-gray-500 block text-sm">/ mois</span>
        </div>
        <ul class="mb-6 space-y-2">
            <li>✅ Publication jusqu’à 5 biens</li>
            <li>✅ Gestion des réservations</li>
            <li>✅ Support standard</li>
        </ul>
        <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
            Souscrire
        </button>
    </div>

    <!-- Carte Tarif Pro -->
    <div class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transform transition border-2 border-blue-600">
        <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">Pro</h2>
        <p class="text-gray-600 mb-6 text-center">Pour les propriétaires actifs souhaitant gérer plusieurs biens facilement.</p>
        <div class="text-center mb-6">
            <span class="text-4xl font-bold">20 000 FCFA</span>
            <span class="text-gray-500 block text-sm">/ mois</span>
        </div>
        <ul class="mb-6 space-y-2">
            <li>✅ Publication illimitée de biens</li>
            <li>✅ Gestion avancée des réservations</li>
            <li>✅ Statistiques détaillées</li>
            <li>✅ Support prioritaire</li>
        </ul>
        <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
            Souscrire
        </button>
    </div>

    <!-- Carte Tarif Premium -->
    <div class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transform transition">
        <h2 class="text-2xl font-bold mb-4 text-blue-600 text-center">Premium</h2>
        <p class="text-gray-600 mb-6 text-center">Pour les propriétaires qui veulent maximiser leurs revenus avec tous les outils professionnels.</p>
        <div class="text-center mb-6">
            <span class="text-4xl font-bold">30 000 FCFA</span>
            <span class="text-gray-500 block text-sm">/ mois</span>
        </div>
        <ul class="mb-6 space-y-2">
            <li>✅ Tout ce qui est inclus dans Pro</li>
            <li>✅ Outils marketing avancés</li>
            <li>✅ Assistance personnalisée 24/7</li>
            <li>✅ Mise en avant prioritaire des biens</li>
        </ul>
        <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
            Souscrire
        </button>
    </div>

</section>

<!-- Footer -->
<footer class="bg-white py-6 mt-10 shadow-inner">
    <div class="max-w-7xl mx-auto text-center text-gray-600 text-sm">
        &copy; 2025 Locazen. Tous droits réservés. | 
        <a href="#" class="text-blue-500 hover:underline">Politique de confidentialité</a> | 
        <a href="#" class="text-blue-500 hover:underline">Contact</a>
    </div>
</footer>

</body>
</html>
