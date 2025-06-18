<?php
require_once("../controleur/Medecin.class.php");

// Récupérer tous les médecins via le contrôleur
$medecins = Medecin::lireTous();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médecins</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Lien vers le CSS si applicable -->
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    color: #4CAF50;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table, th, td {
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 8px;
}

td {
    padding: 8px;
    text-align: left;
}

a {
    display: inline-block;
    margin: 10px 0;
    color: #4CAF50;
    text-decoration: none;
    font-weight: bold;
}

</style>


<body>
    <h1>Liste des Médecins</h1>
    
    <?php if (!empty($medecins)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Médecin</th>
                    <th>ID Utilisateur</th>
                    <th>Numéro de Référence</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medecins as $medecin): ?>
                    <tr>
                        <td><?= htmlspecialchars($medecin['id_medecin']) ?></td>
                        <td><?= htmlspecialchars($medecin['id_user']) ?></td>
                        <td><?= htmlspecialchars($medecin['num_ref']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun médecin trouvé.</p>
    <?php endif; ?>

    <a href="vue_ajouter_Medecin.php">Ajouter un Médecin</a> <!-- Exemple de lien pour ajouter un médecin -->
</body>
</html>
