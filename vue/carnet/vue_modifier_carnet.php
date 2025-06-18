<?php
require_once("verifier_session.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/CarnetVaccination.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Medecin.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Vaccin.class.php");

// Vérifier si l'ID est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p class='text-danger text-center'>Erreur : ID invalide ou non transmis dans l'URL.</p>";
    exit;
}

$id_c = $_GET['id']; // ID du carnet à modifier

// Récupérer les informations du carnet
$carnet = CarnetVaccination::LireCarnetParId($id_c);

if (!$carnet) {
    echo "<p class='text-danger text-center'>Aucune entrée trouvée pour cet ID.</p>";
    exit;
}

// Récupérer les listes de bébés, médecins et vaccins
$medecins = Medecin::LireMedecins();
$bebes = Bebe::LireTousLesBebes();
$vaccins = Vaccin::LireVaccinsParBebe($carnet['id_bebe']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une entrée du Carnet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Modifier une entrée du Carnet</h2>

    <form method="post" action="traitement_modifier_carnet.php">
        <input type="hidden" name="id_c" value="<?= htmlspecialchars($carnet['id_c']) ?>">

        <div class="mb-3">
            <label class="form-label">Date d'administration</label>
            <input type="date" class="form-control" name="date_administration" value="<?= htmlspecialchars($carnet['date_administration']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Médecin</label>
            <select name="id_medecin" class="form-select" required>
                <?php foreach ($medecins as $medecin): ?>
                    <option value="<?= $medecin['id_medecin'] ?>" <?= ($carnet['id_medecin'] == $medecin['id_medecin']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($medecin['nom'] . ' ' . $medecin['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Bébé</label>
            <select name="id_bebe" class="form-select" required>
                <?php foreach ($bebes as $bebe): ?>
                    <option value="<?= $bebe['id_bebe'] ?>" <?= ($carnet['id_bebe'] == $bebe['id_bebe']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($bebe['nom'] . ' ' . $bebe['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Vaccin</label>
            <select name="id_vaccin" class="form-select" required>
                <?php if (empty($vaccins)): ?>
                    <option value="" disabled selected>Aucun vaccin disponible</option>
                <?php else: ?>
                    <?php foreach ($vaccins as $vaccin): ?>
                        <option value="<?= $vaccin['id_vaccin'] ?>" <?= ($carnet['id_vaccin'] == $vaccin['id_vaccin']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($vaccin['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select" required>
                <option value="prévu" <?= ($carnet['statut'] == 'prévu') ? 'selected' : '' ?>>Prévu</option>
                <option value="effectué" <?= ($carnet['statut'] == 'effectué') ? 'selected' : '' ?>>Effectué</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de Rappel</label>
            <input type="date" class="form-control" name="rappel" value="<?= htmlspecialchars($carnet['rappel']) ?>">
        </div>

        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="vue_afficher_carnet.php" class="btn btn-secondary">Retour</a>
    </form>
</div>
</body>
</html>
