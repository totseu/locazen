<?php
// admin_validation.php
require 'database.php';

// Récupérer les pré-comptes en attente
$req = $bdd->query("SELECT * FROM proprietaire WHERE statut='en attente'");
$proprietaires = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Email</th>
    <th>Téléphone</th>
    <th>Statut</th>
    <th>Action</th>
</tr>

<?php foreach($proprietaires as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= htmlspecialchars($p['Nom']) ?></td>
    <td><?= htmlspecialchars($p['Email']) ?></td>
    <td><?= htmlspecialchars($p['Tel']) ?></td>
    <td><?= $p['statut'] ?></td>
    <td>
        <form method="POST" action="valider_proprietaire.php">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button type="submit">Valider</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
