<?php
session_start();


require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Utilisateur.class.php");

// Vérifier si l'ID du bébé est présent dans l'URL
if (!isset($_GET['id_bebe']) || !is_numeric($_GET['id_bebe'])) {
    echo "Erreur : ID bébé manquant ou invalide.";
    exit;
}

// Récupérer les informations du bébé
$id_bebe = $_GET['id_bebe'];
$bebe = Bebe::LireBebeParId($id_bebe);

// Vérifier si le bébé existe
if (!$bebe) {
    echo "Erreur : Aucun bébé trouvé avec cet ID.";
    exit;
}

// Récupérer la liste des parents pour le menu déroulant
$parents = Utilisateur::LireParents();

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $poid = $_POST['poid'];
    $taille = $_POST['taille'];
    $id_user = $_POST['id_user'];

    // Vérifier que tous les champs sont remplis
    if (!$nom || !$prenom || !$date_naissance || !$poid || !$taille || !$id_user) {
        echo "Erreur : Tous les champs sont obligatoires.";
        exit;
    }

    // Mettre à jour les informations du bébé
    Bebe::ModifierBebe($id_bebe, $nom, $prenom, $date_naissance, $poid, $taille, $id_user);

    // Redirection avec un message de succès
    $_SESSION['message'] = "Bébé modifié avec succès !";
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Bébé</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Modifier un Bébé</h2>
    <form method="post">
        <input type="hidden" name="id_bebe" value="<?= htmlspecialchars($bebe['id_bebe']) ?>">

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($bebe['nom']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($bebe['prenom']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de Naissance</label>
            <input type="date" class="form-control" name="date_naissance" value="<?= htmlspecialchars($bebe['date_naissance']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Poids (kg)</label>
            <input type="number" step="0.1" class="form-control" name="poid" value="<?= htmlspecialchars($bebe['poid']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Taille (cm)</label>
            <input type="number" step="0.1" class="form-control" name="taille" value="<?= htmlspecialchars($bebe['taille']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Parent</label>
            <select name="id_user" class="form-control" required>
                <?php foreach ($parents as $parent): ?>
                    <option value="<?= htmlspecialchars($parent['id_user']) ?>" 
                        <?= ($bebe['id_user'] == $parent['id_user']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($parent['nom'] . ' ' . $parent['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-warning btn-lg w-100">Enregistrer les modifications</button>
    </form>
    <a href="list.php" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
</body>
</html>
