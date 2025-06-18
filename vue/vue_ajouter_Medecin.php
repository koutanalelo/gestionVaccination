<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Medecin.class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST["id_user"] ?? "";
    $num_ref = $_POST["num_ref"] ?? "";

    if (!empty($id_user) && !empty($num_ref)) {
        Medecin::ajouterMedecin($id_user, $num_ref); // Assure-toi que la méthode existe
        header("Location: ../index.php"); // Redirection après l'ajout
        exit();
    } else {
        $erreur = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Médecin</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Vérifie le chemin du CSS -->
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #4CAF50; text-align: center; }
        form { max-width: 400px; margin: auto; background: #f2f2f2; padding: 20px; border-radius: 10px; }
        label, input { display: block; width: 100%; margin-bottom: 10px; }
        input { padding: 8px; }
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

    <h1>Ajouter un Médecin</h1>

    <?php if (!empty($erreur)): ?>
        <p class="error"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="id_user">ID Utilisateur :</label>
        <input type="number" name="id_user" id="id_user" required>

        <label for="num_ref">Numéro de Référence :</label>
        <input type="text" name="num_ref" id="num_ref" required>

        <button type="submit">Ajouter</button>
    </form>

    <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>
    
    <a href="../vue/vue_afficher_medecin.php" class="btn-retour">Retour à la liste</a>


</body>
</html>
