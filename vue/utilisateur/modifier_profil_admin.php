<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'medecin')) {
    header("Location: login.php"); // Redirige si non connecté ou si le rôle est incorrect
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];
$success = $error = "";

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        die("Utilisateur introuvable.");
    }

    // Récupération spécifique pour les médecins
    if ($user_role === 'medecin') {
        $stmt = $pdo->prepare("SELECT * FROM medecin WHERE id_user = ?");
        $stmt->execute([$user_id]);
        $medecin = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mise à jour des données après soumission du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        // Champs spécifiques au médecin
        $num_ref = null;
        if ($user_role === 'medecin') {
            $num_ref = htmlspecialchars($_POST['num_ref']);
        }

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'adresse email est invalide.";
        } else {
            // Mise à jour des informations générales
            $stmt = $pdo->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ? WHERE id_user = ?");
            $stmt->execute([$nom, $prenom, $email, $user_id]);

            // Mise à jour spécifique pour les médecins
            if ($user_role === 'medecin') {
                $stmt = $pdo->prepare("UPDATE medecin SET num_ref = ? WHERE id_user = ?");
                $stmt->execute([$num_ref, $user_id]);
            }

            $success = "Profil mis à jour avec succès.";
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
            max-width: 600px;
        }
        .btn-custom {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Modifier votre profil</h2>

        <!-- Affichage des messages -->
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulaire de modification -->
        <form method="POST" action="">
            <h4>Informations générales</h4>
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

            <?php if ($user_role === 'medecin'): ?>
                <h4 class="mt-4">Informations spécifiques au médecin</h4>
                <div class="mb-3">
                    <label for="num_ref" class="form-label">Numéro de Référence :</label>
                    <input type="text" class="form-control" id="num_ref" name="num_ref" value="<?php echo isset($medecin['num_ref']) ? htmlspecialchars($medecin['num_ref']) : ''; ?>" required>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary btn-custom">Mettre à jour</button>
            <a href="../utilisateur/profile.php" class="btn btn-secondary btn-custom">Retour au Profil</a>
            <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>

        </form>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
