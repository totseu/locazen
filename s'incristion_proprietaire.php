 <?php
 require 'database.php';
 
 require 'inscription_proprietaireAction.php'
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
<header class=" fixed w-screen z-50 -mt-24">
    <div class="flex justify-between items-center py-4 px-6 md:px-20">
        <a href="/tailwind css/index.php"><img src="/tailwind css/src/assets/images/Logo moderne de Locazen avec maison (1).png" alt="Locazen" class="h-[70px] w-[90px] rounded-2xl"></a>
       
</header>
<section class="mt-20">
     <!-- <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center mt-10 ">Remplissez ce formulaire pour créer votre compte proprietaire sur Locazen </h2> -->

     <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
   
  <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <!-- <h1 class="text-2xl font-bold text-gray-800 mb-6">Vérification du Propriétaire</h1> -->
    <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Inscription Propriétaire</h2>
    
    <form class="space-y-6" method="POST" action="inscription_proprietaireAction.php" ebctype="multipart/form-data">

      <!-- Informations personnelles -->
      <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2">Informations personnelles</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input name="nomComple" type="text" placeholder="Nom complet" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        
        <input name="numeroPieceIdentite" type="text" placeholder="Numéro de pièce d'identité" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <input name="AdressePersonnelle" type="text" placeholder="Adresse personnelle" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <input name="numeroTel" type="tel" placeholder="Numéro de téléphone" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <input name="adresseEmail" type="email" placeholder="Adresse e-mail" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500l" required>

        <label class="block mt-1">
          photo de vous tenant la piece d'identite bien lisible (image):
          <input name="imageIdentite" type="file" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </label> <!-- premiere image  -->
      </div>

      <!-- Informations sur le bien -->
      <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2">Informations sur le ou les biens</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input name="adresseCompleBien" type="text" placeholder="Adresse complète du bien" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <select name="typeBien" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          <option>Type de bien</option>
          <option>Maison</option>
          <option>Appartement</option>
          <option>Terrain</option>
          <option>Immeuble</option>
        </select>

        <input name="Superficie" type="text" placeholder="Superficie" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <input name="NombrePieces" type="number" placeholder="Nombre de pièces" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 ">

        <input name="AnneeConstruction" type="number" placeholder="Année de construction" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Preuves de propriété -->
      <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2">Preuves de propriété</h2>
      <div class="space-y-3">
        <label class="block">
          Avez-vous un titre foncier à votre nom ?  
          <select name="reponsePropri" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option>Oui</option>
            <option>Non</option>
          </select>

        </label>
        <input name="numeroTitreFoncier" type="text" placeholder="Numéro du titre foncier ou acte de propriété" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <input name="dateDelivrance" type="date" placeholder="Date de délivrance" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <input name="nomIndiqueDocument" type="text" placeholder="Nom indiqué sur le document" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <label class="block">
          
          Joindre le document (PDF ou image) :
          <input name="imageDocument" type="file" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </label> <!-- deuxieme image  -->

        <label class="block relative top-5">
          Avez-vous le certificat de propriete à votre nom ?  
          <select name="reponsePropriCertificat" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" required>
            <option>Oui</option>
            <option>Non</option>
          </select>

        </label>
        <input name="numeroTitreFoncier" type="text" placeholder="Numéro du titre foncier ou acte de propriété" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 " required>

        <input name="dateDelivranceCertificat" type="date" placeholder="Date de délivrance" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

        <input name="nomIndiqueDocumentCertificat" type="text" placeholder="Nom indiqué sur le document" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <label class="block">
          Joindre le document (PDF ou image) :
          <input name="imagePDF" type="file" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 " required>
        </label> <!-- troisieme image  -->
        
      </div>

      <!-- Situation légale -->
      <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2">Situation légale</h2>
      <div class="space-y-3">
        <label class="block">
          Le bien est-il en indivision ?  
          <select  name="reposeSignature" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option>Oui</option>
            <option>Non</option>
          </select>
        </label>
        <label class="block">
          Y a-t-il une hypothèque ou un litige ?  
          <select name="reposeSignatureHypothes" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option>Oui</option>
            <option>Non</option>
          </select>
        </label>
        <textarea name="description" placeholder="Si oui, précisez..." class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>

      <!-- Déclaration -->
      <div class="mt-6">
        <label class="flex items-center space-x-3">
          <input type="checkbox" class="h-5 w-5 text-blue-600" required>
          <span>Je certifie sur l’honneur que les informations fournies sont exactes et que je suis le propriétaire légal du bien.</span>
        </label>
        <div name="Signature_proprietaire" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
          <input type="text" placeholder="Signature" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          <input type="date" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
      </div>

      <label class="flex items-center space-x-3">
          
          <span>merci de bien vouloir patiente la verification de vos informations qui prendra une duree de 4h de temps pour analyse de votre authenticipe afin de vous envoyer les odalite de payement</span>
        </label>

      <!-- Bouton -->
      <div name="valider" class="text-center mt-6">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700" required>
          Envoyer la demande
        </button>
      </div>

    </form>
  </div>

  </section>

  <!-- Footer -->
<footer class="w-full bg-gray-100 py-4 mt-8">
  <div class="max-w-7xl mx-auto text-center text-gray-600 text-sm">
    &copy; 2025 Locazen. Tous droits réservés. | 
    <a href="#" class="text-blue-500 hover:underline">Politique de confidentialité</a> | 
    <a href="#" class="text-blue-500 hover:underline">Contact</a>
  </div>
</footer>




    
</body>
</html>