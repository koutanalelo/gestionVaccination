
<?php
session_start();
require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

// Récupérer les utilisateurs depuis la base de données
$utilisateurs = Utilisateur::LireUtilisateurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Utilisateurs</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Liste des Utilisateurs</h2>

    <!-- Affichage du message de succès ou d'erreur -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>

    <!-- Table des utilisateurs -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($utilisateurs): ?>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?php echo $utilisateur['id_user']; ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                        <td><?php echo ucfirst($utilisateur['role']); ?></td>
                        <td>
                            <a href="vue_modifier_user.php?id_user=<?php echo $utilisateur['id_user']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="vue_supprimer_user.php?id_user=<?php echo $utilisateur['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Aucun utilisateur trouvé</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Lien vers la page d'ajout -->
    <div class="text-center mt-4">
        <a href="../utilisateur/vue_ajouter_user.php" class="btn btn-success">Ajouter un Utilisateur</a>
        <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>
    
    <a href="../vue/vue_afficher_medecin.php" class="btn-retour">Retour à la liste</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
