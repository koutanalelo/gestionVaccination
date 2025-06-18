
<?php
session_start();

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
// Récupération de l'ID de l'utilisateur à modifier
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 0;

// Récupérer les informations de l'utilisateur
$utilisateur = Utilisateur::LireUtilisateurParId($id_user);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Utilisateur</title>
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
    <h2 class="text-center mb-4">Modifier un Utilisateur</h2>

    <!-- Formulaire de modification -->
    <form action="traitement_modifier_user.php" method="post">
        <input type="hidden" name="id_user" value="<?php echo $utilisateur['id_user']; ?>">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur['prenom']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" <?php echo $utilisateur['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="medecin" <?php echo $utilisateur['role'] == 'medecin' ? 'selected' : ''; ?>>Médecin</option>
                <option value="parent" <?php echo $utilisateur['role'] == 'parent' ? 'selected' : ''; ?>>Parent</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Laisser vide pour ne pas modifier">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
