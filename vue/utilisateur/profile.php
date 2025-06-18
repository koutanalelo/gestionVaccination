<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
    header("Location: login.php"); // Redirige si non connecté
    exit();
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_role === 'parent') {
        $stmt = $pdo->prepare("SELECT * FROM bebe WHERE id_user = ?");
        $stmt->execute([$user_id]);
        $bebe = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            margin-top: 50px;
        }
        .profile-wrapper {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
        }
        .profile-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            padding: 30px;
            width: 350px;
            text-align: center;
            transition: none; /* plus de mouvement */
        }
        .profile-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #dee2e6;
        }
        .profile-card h4 {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .profile-card p {
            margin: 5px 0;
            color: #555;
        }
        .buttons {
            text-align: center;
            margin-top: 40px;
        }
        .btn-custom {
            margin: 0 10px;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-5">Profil</h2>

    <div class="profile-wrapper">
        <!-- Carte du parent -->
        <div class="profile-card">
            <img src="https://th.bing.com/th/id/OIP.x7ZJAaew-ynda5A33wejjgAAAA?w=181&h=181&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Photo du parent">
            <h4><?php echo htmlspecialchars($utilisateur['nom'] . " " . $utilisateur['prenom']); ?></h4>
            <p>Email : <?php echo htmlspecialchars($utilisateur['email']); ?></p>
            <p>Rôle : <?php echo ucfirst($user_role); ?></p>
        </div>

        <!-- Carte du bébé si parent -->
        <?php if ($user_role === 'parent' && isset($bebe)): ?>
            <div class="profile-card">
                <img src="https://th.bing.com/th/id/OIP.p1L0dSP6RHI2x8QxoNKvNgHaEo?w=281&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Photo du bébé">
                <h4><?php echo htmlspecialchars($bebe['nom'] . " " . $bebe['prenom']); ?></h4>
                <p>Date de naissance : <?php echo htmlspecialchars($bebe['date_naissance']); ?></p>
                <p>Poids : <?php echo htmlspecialchars($bebe['poid']) . " kg"; ?></p>
                <p>Taille : <?php echo htmlspecialchars($bebe['taille']) . " cm"; ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Boutons -->
    <div class="buttons">
        <a href="../utilisateur/modifier_profil.php" class="btn btn-primary btn-custom">Modifier Profil</a>
        <a href="dashboard_parent.php" class="btn btn-secondary btn-custom">Retour</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
