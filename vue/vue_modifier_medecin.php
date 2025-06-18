<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

// Assure-toi de récupérer l'ID du médecin à partir de l'URL (ou d'un autre moyen)
$id_medecin = $_GET['id_medecin'] ?? null;  // Si l'ID du médecin est passé dans l'URL (par exemple: ?id_medecin=1)

if ($id_medecin) {
    // Récupère les informations du médecin à modifier
    $medecin = Medecin::LireMedecinParId($id_medecin);

    if ($medecin === null) {
        echo "Médecin introuvable.";
        exit;  // Arrête l'exécution si le médecin n'a pas été trouvé
    }
} else {
    echo "Aucun ID de médecin fourni.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Médecin</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            color: #4CAF50;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Modifier le Médecin</h1>

    <?php if (isset($error_message)): ?>
        <div class="error"><?= $error_message ?></div>
    <?php endif; ?>

    <form action="traitement_modifier_medecin.php" method="POST">
        <input type="hidden" name="id_medecin" value="<?= htmlspecialchars($medecin['id_medecin']) ?>">

        <label for="num_ref">Numéro de Référence :</label>
        <input type="text" id="num_ref" name="num_ref" value="<?= htmlspecialchars($medecin['num_ref']) ?>" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($medecin['nom']) ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($medecin['prenom']) ?>" required>

        <input type="submit" value="Modifier">
    </form>

</body>
</html>
