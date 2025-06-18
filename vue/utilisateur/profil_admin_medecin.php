<?php
session_start();

// Vérification de la connexion et du rôle
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'medecin')) {
    header("Location: login.php"); // Redirige si non connecté ou si le rôle est incorrect
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des informations générales
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        die("Utilisateur introuvable.");
    }

    // Informations spécifiques au médecin
    $medecin = null;
    if ($user_role === 'medecin') {
        $stmt = $pdo->prepare("SELECT * FROM medecin WHERE id_user = ?");
        $stmt->execute([$user_id]);
        $medecin = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Profil</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
            object-fit: cover;
        }
        .profile-card h4 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .profile-card p {
            margin: 5px 0;
            color: #666;
        }
        .btn-custom {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card">
            <img src="https://th.bing.com/th/id/OIP.toZPd_bUxV4c-miIeOodVQHaGp?w=207&h=186&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Photo de profil"> <!-- Remplacez par une vraie image -->
            <h4><?php echo htmlspecialchars($utilisateur['nom'] . " " . $utilisateur['prenom']); ?></h4>
            <p>Email : <?php echo htmlspecialchars($utilisateur['email']); ?></p>
            <p>Rôle : <?php echo ucfirst($user_role); ?></p>

            <?php if ($user_role === 'medecin' && $medecin): ?>
                <p>Numéro de Référence : <?php echo htmlspecialchars($medecin['num_ref']); ?></p>
            <?php endif; ?>

            <a href="modifier_profil_medecin.php" class="btn btn-primary btn-custom">Modifier le Profil</a>
            <a href="dashboard_<?php echo $user_role; ?>.php" class="btn btn-secondary btn-custom">Retour au Tableau de Bord</a>
        </div>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
