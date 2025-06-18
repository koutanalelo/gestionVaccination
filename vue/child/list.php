<?php
session_start();


require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");

// Récupérer tous les bébés avec les informations du parent
$bebes = Bebe::LireBebes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Bébés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function confirmerSuppression(id_bebe) {
            if (confirm("Voulez-vous vraiment supprimer ce bébé ?")) {
                window.location.href = "supprimer_bebe.php?id_bebe=" + id_bebe;
            }
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Liste des Bébés</h2>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nom et Prénom du Bébé</th>
                <th>Date de Naissance</th>
                <th>Poids (kg)</th>
                <th>Taille (cm)</th>
                <th>Nom et Prénom du Parent</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bebes as $bebe): ?>
                <tr>
                    <td><?= htmlspecialchars($bebe['nom']) . " " . htmlspecialchars($bebe['prenom']) ?></td>
                    <td><?= htmlspecialchars($bebe['date_naissance']) ?></td>
                    <td><?= htmlspecialchars($bebe['poid']) ?></td>
                    <td><?= htmlspecialchars($bebe['taille']) ?></td>
                    <td><?= htmlspecialchars($bebe['parent_nom']) . " " . htmlspecialchars($bebe['parent_prenom']) ?></td>
                    <td>
                        <a href="modifier_bebe.php?id_bebe=<?= $bebe['id_bebe'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <button onclick="confirmerSuppression(<?= $bebe['id_bebe'] ?>)" class="btn btn-danger btn-sm">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../gestionvaccin/vue/child/ajouter_bebe.php" class="btn btn-success">Ajouter un Bébé</a>
    <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>

</div>
</body>
</html>
