<?php
session_start();
$erreur = '';
$succes = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mdp = htmlspecialchars($_POST['mdp']);
    $role = htmlspecialchars($_POST['role']);
    $num_ref = isset($_POST['num_ref']) ? htmlspecialchars($_POST['num_ref']) : null;

    $roles_autorises = ['parent', 'medecin'];
    if (!in_array($role, $roles_autorises)) {
        $erreur = "Rôle non autorisé.";
    } else {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si l'email existe déjà
            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $erreur = "Cet email est déjà utilisé.";
            } else {
                // Insérer l'utilisateur
                $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, role) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$nom, $prenom, $email, $mdp, $role]);
                $user_id = $pdo->lastInsertId();

                if ($role === "medecin" && $num_ref) {
                    $stmt = $pdo->prepare("INSERT INTO medecin (id_user, num_ref) VALUES (?, ?)");
                    $stmt->execute([$user_id, $num_ref]);
                }

                $succes = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            }
        } catch (PDOException $e) {
            $erreur = "Erreur de base de données : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Créer un compte</h2>

    <?php if ($erreur): ?>
        <div class="alert alert-danger"><?= $erreur ?></div>
    <?php endif; ?>

    <?php if ($succes): ?>
        <div class="alert alert-success"><?= $succes ?></div>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rôle</label>
                <select class="form-select" name="role" id="role" required>
                    <option value="">-- Choisir un rôle --</option>
                    <option value="parent">Parent</option>
                    <option value="medecin">Médecin</option>
                </select>
            </div>
            <div class="mb-3" id="num_ref_container" style="display: none;">
                <label class="form-label">Numéro de Référence (Médecin)</label>
                <input type="text" class="form-control" name="num_ref" id="num_ref">
            </div>
            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>
    </div>

    <div class="text-center mt-3">
        <a href="login.php">Déjà inscrit ? Connexion</a>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function () {
        const numRef = document.getElementById('num_ref_container');
        numRef.style.display = this.value === 'medecin' ? 'block' : 'none';
    });
</script>

</body>
</html>
