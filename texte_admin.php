<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Locazen - Dashboard Admin</title>
   <link rel="stylesheet" href="src/css/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <aside class="w-72 bg-gradient-to-b from-blue-700 to-indigo-800 text-white flex flex-col shadow-xl">
      <div class="p-6 text-2xl font-bold border-b border-white/20 flex items-center gap-2">
        🏠 Locazen Admin
      </div>
      <nav class="flex-1 p-4 space-y-2">
        <button onclick="showSection('dashboard')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">📊 Tableau de bord</button>
        <button onclick="showSection('biens')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">📦 Gérer Biens</button>
        <button onclick="showSection('proprietaires')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">👤 Propriétaires</button>
        <button onclick="showSection('clients')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">🧑‍💼 Clients</button>
        <button onclick="showSection('transactions')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">💳 Transactions</button>
        <button onclick="showSection('parametres')" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">⚙️ Paramètres</button>
      </nav>
      <div class="p-4 border-t border-white/20">
        <button class="w-full bg-red-500 py-2 rounded-lg font-semibold hover:bg-red-600">🚪 Déconnexion</button>
      </div>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-8 overflow-y-auto">

      <!-- Dashboard -->
      <section id="dashboard" class="section fade-in">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Tableau de bord</h1>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
          <div class="bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-500">Propriétaires</h2>
            <p class="text-4xl font-bold text-blue-600">128</p>
          </div>
          <div class="bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-500">Clients</h2>
            <p class="text-4xl font-bold text-green-600">542</p>
          </div>
          <div class="bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-500">Biens en attente</h2>
            <p class="text-4xl font-bold text-yellow-500">23</p>
          </div>
          <div class="bg-white shadow-md rounded-2xl p-6 text-center hover:shadow-xl transition">
            <h2 class="text-lg font-semibold mb-2 text-gray-500">Transactions</h2>
            <p class="text-4xl font-bold text-purple-600">327</p>
          </div>
        </div>

        <!-- Graphiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white shadow-md rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-700">📈 Biens publiés par mois</h2>
            <canvas id="barChart"></canvas>
          </div>
          <div class="bg-white shadow-md rounded-2xl p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-700">💳 Répartition des paiements</h2>
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </section>

      <!-- Biens -->
      <section id="biens" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">📦 Gérer les Biens</h2>
        <table class="w-full border-collapse bg-white shadow-lg rounded-2xl overflow-hidden">
          <thead class="bg-blue-50">
            <tr class="text-left text-gray-600">
              <th class="p-3">Nom du Bien</th>
              <th class="p-3">Propriétaire</th>
              <th class="p-3">Statut</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">Villa Yaoundé</td>
              <td class="p-3">Nathan Totseu</td>
              <td class="p-3 text-yellow-600 font-semibold">En attente</td>
              <td class="p-3 space-x-2">
                <button class="bg-green-500 px-3 py-1 rounded text-white hover:bg-green-600">Valider</button>
                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Propriétaires -->
      <section id="proprietaires" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">👤 Gestion des Propriétaires</h2>
        <table class="w-full border-collapse bg-white shadow-lg rounded-2xl overflow-hidden">
          <thead class="bg-blue-50">
            <tr class="text-left text-gray-600">
              <th class="p-3">Nom</th>
              <th class="p-3">Email</th>
              <th class="p-3">Statut</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">Nathan Totseu</td>
              <td class="p-3">proprio@mail.com</td>
              <td class="p-3 text-green-600 font-semibold">Actif</td>
              <td class="p-3 space-x-2">
                <button class="bg-yellow-500 px-3 py-1 rounded text-white hover:bg-yellow-600">Suspendre</button>
                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Clients -->
      <section id="clients" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">🧑‍💼 Gestion des Clients</h2>
        <table class="w-full border-collapse bg-white shadow-lg rounded-2xl overflow-hidden">
          <thead class="bg-blue-50">
            <tr class="text-left text-gray-600">
              <th class="p-3">Nom</th>
              <th class="p-3">Email</th>
              <th class="p-3">Statut</th>
              <th class="p-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">Jean Client</td>
              <td class="p-3">client@mail.com</td>
              <td class="p-3 text-green-600 font-semibold">Actif</td>
              <td class="p-3 space-x-2">
                <button class="bg-yellow-500 px-3 py-1 rounded text-white hover:bg-yellow-600">Bloquer</button>
                <button class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Transactions -->
      <section id="transactions" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">💳 Transactions récentes</h2>
        <ul class="bg-white rounded-2xl shadow-lg divide-y">
          <li class="py-3 px-4 flex justify-between hover:bg-gray-50">
            <span>Abonnement Propriétaire (Nathan)</span>
            <span class="text-green-600 font-semibold">5 000 FCFA</span>
          </li>
          <li class="py-3 px-4 flex justify-between hover:bg-gray-50">
            <span>Publication Villa (John Doe)</span>
            <span class="text-green-600 font-semibold">2 000 FCFA</span>
          </li>
        </ul>
      </section>

      <!-- Paramètres -->
      <section id="parametres" class="section hidden">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">⚙️ Paramètres Généraux</h2>
        <form class="bg-white p-6 rounded-2xl shadow-lg space-y-4">
          <div>
            <label class="block text-gray-600 font-medium">Nom de la plateforme</label>
            <input type="text" class="w-full border rounded-lg p-2 mt-1" value="Locazen">
          </div>
          <div>
            <label class="block text-gray-600 font-medium">Email de support</label>
            <input type="email" class="w-full border rounded-lg p-2 mt-1" value="support@locazen.com">
          </div>
          <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Enregistrer</button>
        </form>
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

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
        datasets: [{
          label: 'Biens publiés',
          data: [30, 45, 28, 50, 40, 60],
          backgroundColor: 'rgba(59, 130, 246, 0.7)',
          borderColor: 'rgba(59, 130, 246, 1)',
          borderWidth: 1
        }]
      }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: ['Orange Money', 'MTN Money', 'Carte Bancaire'],
        datasets: [{
          label: 'Transactions',
          data: [500, 400, 300],
          backgroundColor: [
            'rgba(59, 130, 246, 0.7)',
            'rgba(16, 185, 129, 0.7)',
            'rgba(245, 158, 11, 0.7)'
          ]
        }]
      }
    });
  </script>
</body>
</html>
