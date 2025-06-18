

<?php


require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

// Récupérer l'ID de l'utilisateur à supprimer
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 0;

// Récupérer les informations de l'utilisateur
$utilisateur = Utilisateur::LireUtilisateurParId($id_user);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supprimer Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Confirmer la suppression de l'utilisateur</h2>

    <p>Êtes-vous sûr de vouloir supprimer l'utilisateur suivant ?</p>

    <div class="mb-3">
        <strong>Nom :</strong> <?php echo htmlspecialchars($utilisateur['nom']); ?>
    </div>

    <div class="mb-3">
        <strong>Prénom :</strong> <?php echo htmlspecialchars($utilisateur['prenom']); ?>
    </div>

    <div class="mb-3">
        <strong>Email :</strong> <?php echo htmlspecialchars($utilisateur['email']); ?>
    </div>

    <div class="text-center">
        <a href="traiter_supprimer_utilisateur.php?id_user=<?php echo $utilisateur['id_user']; ?>" class="btn btn-danger">Supprimer</a>
        <a href="afficher_utilisateurs.php" class="btn btn-secondary">Annuler</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
