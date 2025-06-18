<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige si non connecté
    exit();
}

$user_id = $_SESSION['user_id'];
$success = $error = "";

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des informations du parent
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        die("Utilisateur introuvable.");
    }

    // Récupération des informations du bébé si le parent a un bébé associé
    $stmt = $pdo->prepare("SELECT * FROM bebe WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $bebe = $stmt->fetch(PDO::FETCH_ASSOC);

    // Mise à jour des données après soumission du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        // Champs du bébé (si présents)
        $bebe_nom = htmlspecialchars($_POST['bebe_nom']);
        $bebe_prenom = htmlspecialchars($_POST['bebe_prenom']);
        $bebe_date_naissance = $_POST['bebe_date_naissance'];
        $bebe_poid = htmlspecialchars($_POST['bebe_poid']);
        $bebe_taille = htmlspecialchars($_POST['bebe_taille']);

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'adresse email est invalide.";
        } else {
            // Mise à jour des informations du parent
            $stmt = $pdo->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ? WHERE id_user = ?");
            $stmt->execute([$nom, $prenom, $email, $user_id]);

            // Mise à jour ou insertion des informations du bébé
            if ($bebe) {
                $stmt = $pdo->prepare("UPDATE bebe SET nom = ?, prenom = ?, date_naissance = ?, poid = ?, taille = ? WHERE id_bebe = ?");
                $stmt->execute([$bebe_nom, $bebe_prenom, $bebe_date_naissance, $bebe_poid, $bebe_taille, $bebe['id_bebe']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO bebe (nom, prenom, date_naissance, poid, taille, id_user) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$bebe_nom, $bebe_prenom, $bebe_date_naissance, $bebe_poid, $bebe_taille, $user_id]);
            }

            $success = "Profil et informations du bébé mis à jour avec succès.";
        }
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
            max-width: 700px;
        }
        .btn-custom {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Modifier votre profil et celui de votre bébé</h2>

        <!-- Affichage des messages -->
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulaire de modification -->
        <form method="POST" action="">
            <h4>Informations du parent</h4>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur['prenom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($utilisateur['email']); ?>" required>
            </div>

            <?php if ($bebe): ?>
                <h4 class="mt-4">Informations du bébé</h4>
                <div class="mb-3">
                    <label for="bebe_nom" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="bebe_nom" name="bebe_nom" value="<?php echo htmlspecialchars($bebe['nom']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bebe_prenom" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" id="bebe_prenom" name="bebe_prenom" value="<?php echo htmlspecialchars($bebe['prenom']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bebe_date_naissance" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" id="bebe_date_naissance" name="bebe_date_naissance" value="<?php echo htmlspecialchars($bebe['date_naissance']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bebe_poid" class="form-label">Poids :</label>
                    <input type="number" step="0.01" class="form-control" id="bebe_poid" name="bebe_poid" value="<?php echo htmlspecialchars($bebe['poid']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="bebe_taille" class="form-label">Taille :</label>
                    <input type="number" step="0.01" class="form-control" id="bebe_taille" name="bebe_taille" value="<?php echo htmlspecialchars($bebe['taille']); ?>" required>
                </div>
            <?php else: ?>
                <p class="text-warning">Aucun bébé trouvé pour cet utilisateur. Vous pouvez ajouter les informations de votre bébé ci-dessous.</p>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary btn-custom">Mettre à jour</button>
            <a href="../utilisateur/profile.php" class="btn btn-secondary btn-custom">Retour au Profil</a>
        </form>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
