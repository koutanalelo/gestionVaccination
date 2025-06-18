<?php


require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

try {
    $pdo = Singleton::getInstance()->getBdd();

    // Requête pour récupérer les vaccins avec le nom complet des bébés
    $sql = "
        SELECT 
            v.id_vaccin,
            v.nom AS nom_vaccin,
            v.description,
            v.age_recommande,
            v.date_renouvellement,
            v.obligatoire,
            CONCAT(b.nom, ' ', b.prenom) AS bebe_nom_complet
        FROM 
            vaccin v
        JOIN 
            Bebe b ON v.id_bebe = b.id_bebe
    ";
    $stmt = $pdo->query($sql);
    $listeVaccins = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<p class='text-danger'>Erreur : " . $e->getMessage() . "</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Liste des Vaccins</title>
    <style>
        /* Couleurs pour les lignes */
        tr:nth-child(odd) {
            background-color: #f2f2f2; /* Gris clair */
        }
        tr:nth-child(even) {
            background-color: #e6f7ff; /* Bleu très pâle */
        }
        tr:hover {
            background-color: #d1e7dd; /* Vert clair au survol */
        }
        /* Couleurs pour les cellules */
        td {
            color: #333; /* Texte sombre */
        }
        th {
            background-color: #007bff; /* Bleu Bootstrap */
            color: white; /* Texte blanc */
        }
        .btn-modifier {
            background-color: #ffc107; /* Jaune Bootstrap */
            color: black;
            margin-right: 5px;
        }
        .btn-supprimer {
            background-color: #dc3545; /* Rouge Bootstrap */
            color: white;
        }
        td.actions {
            text-align: center; /* Centrer les boutons Modifier et Supprimer */
            white-space: nowrap; /* Empêcher le retour à la ligne */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Liste des Vaccins</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom du Vaccin</th>
                    <th>Description</th>
                    <th>Âge recommandé</th>
                    <th>Date de renouvellement</th>
                    <th>Obligatoire</th>
                    <th>Bébé (Nom complet)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listeVaccins)): ?>
                    <?php foreach ($listeVaccins as $vaccin): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($vaccin['nom_vaccin'] ?? 'Inconnu'); ?></td>
                            <td><?php echo htmlspecialchars($vaccin['description'] ?? 'Inconnu'); ?></td>
                            <td><?php echo htmlspecialchars($vaccin['age_recommande'] ?? 'Inconnu'); ?> mois</td>
                            <td><?php echo htmlspecialchars($vaccin['date_renouvellement'] ?? 'Inconnu'); ?></td>
                            <td><?php echo htmlspecialchars($vaccin['obligatoire'] ?? 'Inconnu'); ?></td>
                            <td><?php echo htmlspecialchars($vaccin['bebe_nom_complet'] ?? 'Inconnu'); ?></td>
                            <td class="actions">
                                <a href="vue_modifier_vaccin.php?id=<?= htmlspecialchars($vaccin['id_vaccin']); ?>" class="btn btn-modifier btn-sm">Modifier</a>
                                <a href="vue_supprimer_vaccin.php?id=<?= htmlspecialchars($vaccin['id_vaccin']); ?>" class="btn btn-supprimer btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce vaccin ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun vaccin trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="/gestionvaccin/accueil.php" class="btn btn-primary">Retour à la page d'accueil</a>
        </div>
    </div>
</body>
</html>
