<?php


require_once("C:/xampp/htdocs/gestionvaccin/controleur/Vaccin.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p class='text-danger'>Erreur : ID de vaccin invalide ou non transmis.</p>";
    exit;
}

$id_vaccin = $_GET['id'];

try {
    $pdo = Singleton::getInstance()->getBdd();

    // Récupérer les informations actuelles du vaccin
    $sql = "SELECT * FROM vaccin WHERE id_vaccin = :id_vaccin";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_vaccin', $id_vaccin, PDO::PARAM_INT);
    $stmt->execute();
    $vaccin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vaccin) {
        echo "<p class='text-danger'>Erreur : Aucun vaccin trouvé avec cet ID.</p>";
        exit;
    }

    // Récupérer la liste des bébés
    $sql_bebes = "SELECT id_bebe, nom, prenom FROM bebe";
    $stmt_bebes = $pdo->query($sql_bebes);
    $listeBebes = $stmt_bebes->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "<p class='text-danger'>Erreur : " . $e->getMessage() . "</p>";
    exit;
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $description = $_POST['description'] ?? null;
    $age_recommande = $_POST['age_recommande'] ?? null;
    $date_renouvellement = $_POST['date_renouvellement'] ?? null;
    $obligatoire = $_POST['obligatoire'] ?? null;
    $id_bebe = $_POST['id_bebe'] ?? null;

    try {
        Vaccin::ModifierVaccin($id_vaccin, $nom, $description, $age_recommande, $date_renouvellement, $obligatoire, $id_bebe);
        echo "<p class='text-success'>Le vaccin a été modifié avec succès.</p>";
        echo "<a href='vue_afficher_vaccin.php' class='btn btn-primary'>Retour à la liste des vaccins</a>";
        exit;
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erreur lors de la modification : " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifier un Vaccin</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Modifier le Vaccin</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du vaccin</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?= htmlspecialchars($vaccin['nom'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($vaccin['description'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="age_recommande" class="form-label">Âge recommandé (en mois)</label>
                <input type="number" id="age_recommande" name="age_recommande" class="form-control" value="<?= htmlspecialchars($vaccin['age_recommande'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_renouvellement" class="form-label">Date de renouvellement</label>
                <input type="date" id="date_renouvellement" name="date_renouvellement" class="form-control" value="<?= htmlspecialchars($vaccin['date_renouvellement'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="obligatoire" class="form-label">Obligatoire</label>
                <select id="obligatoire" name="obligatoire" class="form-select" required>
                    <option value="oui" <?= ($vaccin['obligatoire'] === 'oui') ? 'selected' : '' ?>>Oui</option>
                    <option value="non" <?= ($vaccin['obligatoire'] === 'non') ? 'selected' : '' ?>>Non</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_bebe" class="form-label">Sélectionnez un bébé</label>
                <select id="id_bebe" name="id_bebe" class="form-select" required>
                    <option value="">-- Sélectionnez un bébé --</option>
                    <?php foreach ($listeBebes as $bebe): ?>
                        <option value="<?= htmlspecialchars($bebe['id_bebe']) ?>" <?= ($bebe['id_bebe'] == $vaccin['id_bebe']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($bebe['nom']) . " " . htmlspecialchars($bebe['prenom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Modifier</button>
            <a href="vue_afficher_vaccin.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
