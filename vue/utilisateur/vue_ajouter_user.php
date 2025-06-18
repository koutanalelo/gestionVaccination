
<?php
session_start();

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Utilisateur.class.php");

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $role = $_POST["role"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT); 

    try {
        Utilisateur::AjouterUtilisateur($nom, $prenom, $email, $role, $mdp);
        $_SESSION['message'] = "Utilisateur ajouté avec succès !";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Utilisateur</title>

    <!-- Bootstrap CSS -->
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
        button { background: #4CAF50; color: white; padding: 10px; border: none; width: 100%; cursor: pointer; }
        button:hover { background: #45a049; }
        .error { color: red; text-align: center; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #4CAF50; text-decoration: none; }
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

<div class="container">
    <h2 class="text-center mb-4">Ajouter un Utilisateur</h2>

    <!-- Affichage du message de succès ou d'erreur -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select id="role" name="role" class="form-select" required>
            <option value="admin">Administrateur</option>
                <option value="medecin">medecin</option>
                <option value="parent">parent</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ajouter</button>

    </form>
   
</div>
<a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>
    
<a href="http://localhost/gestionvaccin/vue/utilisateur/vue_afficher_user.php" class="btn-retour">Retour à la liste</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
