<?php
require_once("verifier_session.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/CarnetVaccination.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Utilisateur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Medecin.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

// Récupérer tous les carnets de vaccination
$carnets = CarnetVaccination::LireTousLesCarnets();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Liste des Carnets de Vaccination</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Liste des Carnets de Vaccination</h2>
        
        <!-- Table pour afficher les carnets de vaccination -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Date d'administration</th>
                    <th>Bébé (Nom et Prénom)</th>
                    <th>Vaccin</th>
                    <th>Médecin (Nom et Prénom)</th>
                    <th>Statut</th>
                    <th>Rappel</th>
                    <th>Action</th> <!-- Nouvelle colonne Action -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($carnets) && is_array($carnets)): ?>
                    <?php foreach ($carnets as $carnet): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($carnet['date_administration'] ?? 'Non disponible'); ?></td>
                            <td><?php echo htmlspecialchars($carnet['nom_bebe'] . ' ' . $carnet['prenom_bebe'] ?? 'Non disponible'); ?></td> <!-- Nom et Prénom du bébé -->
                            <td><?php echo htmlspecialchars($carnet['nom_vaccin'] ?? 'Non disponible'); ?></td>
                            <td><?php echo htmlspecialchars($carnet['nom_medecin'] . ' ' . $carnet['prenom_medecin'] ?? 'Non disponible'); ?></td> <!-- Nom et Prénom du médecin -->
                            <td><?php echo htmlspecialchars($carnet['statut'] ?? 'Non disponible'); ?></td>
                            <td><?php echo htmlspecialchars($carnet['rappel'] ?? 'Non disponible'); ?></td>
                            <td>
                                <!-- Boutons pour modifier et supprimer -->
                                <a href="vue_modifier_carnet.php?id=<?php echo $carnet['id_c']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="vue_supprimer_carnet.php?id=<?php echo $carnet['id_c']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun carnet de vaccination trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Lien pour ajouter un carnet de vaccination -->
        <div class="mt-4 text-center">
            <a href="vue_ajouter_carnet.php" class="btn btn-primary">Ajouter un Carnet de Vaccination</a>
        </div>
    </div>
    <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>

</body>
</html>
