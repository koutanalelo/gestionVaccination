<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

// Récupérer tous les médecins via le contrôleur
$medecins = Medecin::LireMedecins();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Médecins</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #4CAF50; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        table, th, td { border: 1px solid #ddd; padding: 5px; }
        th { background-color: #f2f2f2; text-align: left;  background-color: #E1C3AC}
        td { text-align: left; }
        a { display: inline-block; margin: 0 5px; text-decoration: none; font-weight: bold; padding: 5px 10px; border-radius: 4px; }
        .btn-modifier { background-color: #861088; color: white; }
        .btn-supprimer { background-color: #861088; color: white; }
        .btn-retour {
    display: block;
    width: 200px;
    margin: 20px auto;
    padding: 10px;
    background-color: #f6d9d7;
    color: black;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
}

.btn-retour:hover {
    background-color: #e6c1bf;
}

    </style>
</head>
<body>

    <h1>Liste des Médecins</h1>

    <?php
    // Vérifie si $medecins est un tableau valide et non vide
    if (is_array($medecins) && !empty($medecins)) : 
    ?>
        <table>
            <thead>
                <tr>
                    <th>ID Médecin</th>
                    <th>Nom et Prenom </th>
                    <th>ID Utilisateur</th>
                    <th>Numéro de Référence</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medecins as $medecin): ?>
                    <tr>
                        <td><?= htmlspecialchars($medecin['id_medecin']) ?></td>
                        <td><?= htmlspecialchars($medecin['nom']) ?> <?= htmlspecialchars($medecin['prenom']) ?></td>
                        <td><?= htmlspecialchars($medecin['id_user']) ?></td>
                        <td><?= htmlspecialchars($medecin['num_ref']) ?></td>
                        <td>
                            <!-- Lien de modification -->
                            <a href="vue_modifier_medecin.php?id_medecin=<?= htmlspecialchars($medecin['id_medecin']) ?>" class="btn-modifier">Modifier</a>
                            <!-- Lien de suppression -->
                            <a href="vue_supprimer_medecin.php?id_medecin=<?= htmlspecialchars($medecin['id_medecin']) ?>" class="btn-supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médecin ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php 
    else: 
        // Si aucun médecin n'est trouvé
        echo "<p>Aucun médecin trouvé ou erreur dans la récupération des données.</p>";
    endif; 
    ?>
<a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>

</body>
</html>
