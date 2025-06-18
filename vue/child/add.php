
<?php


require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date'];
    $poid = $_POST['poid'];
    $taille = $_POST['taille'];
    $id_user = $_POST['id_user']; 

   
    try {
        Bebe::AjouterBebe($nom, $prenom,   $date_naissance,  $poid, $taille,  $id_user);
        $_SESSION['message'] = "Bébé ajouté avec succès !";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
    }
}


?>
    

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Bébé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Ajouter un Bébé</h2>
    <form method="post">
        <div class="mb-3"><label class="form-label">Nom</label><input type="text" class="form-control" name="nom" required></div>
        <div class="mb-3"><label class="form-label">Prénom</label><input type="text" class="form-control" name="prenom" required></div>
        <div class="mb-3"><label class="form-label">Date de naissance</label><input type="date" class="form-control" name="date" required></div>
        <div class="mb-3"><label class="form-label">Poids (kg)</label><input type="number" step="0.1" class="form-control" name="poid" required></div>
        <div class="mb-3"><label class="form-label">Taille (cm)</label><input type="number" step="0.1" class="form-control" name="taille" required></div>
          <!-- Sélectionner l'utilisateur (parent) -->
    <div class="form-group">
        <label for="id_user">Sélectionner le parent</label>
        <select name="id_user" id="id_user" class="form-control" required>
            <option value="">Sélectionnez un parent</option>
            <?php
            // Récupérer tous les utilisateurs de type "parent" (en supposant qu'il y ait un champ "role" dans ta base de données)
            $utilisateurs = Modele::executerRequete("SELECT id_user, nom, prenom FROM utilisateur WHERE role = 'parent'");
            foreach ($utilisateurs as $utilisateur) {
                echo "<option value='" . $utilisateur['id_user'] . "'>" . $utilisateur['nom'] . " " . $utilisateur['prenom'] . "</option>";
            }
            ?>
        </select>
    </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
    <a href="/gestionvaccin/vue/child/list.php" class="btn-retour">Retour à la liste</a>

</div>
</body>
</html>
