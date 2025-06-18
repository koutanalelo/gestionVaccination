<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Nettoyage de l'email
    $mdp = htmlspecialchars($_POST['mdp']); // Sécurisation du mot de passe
    $role = htmlspecialchars($_POST['role']); // Sécurisation du rôle
    $num_ref = null;

    // Vérification du numéro de référence si le rôle est "médecin"
    if ($role == 'medecin' && !empty($_POST['num_ref'])) {
        $num_ref = htmlspecialchars($_POST['num_ref']); // Sécurisation du numéro de référence
    }

    try {
        // Connexion à la base de données
        $pdo = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Construire la requête en fonction du rôle
        if ($role == 'medecin') {
            $requete = "SELECT * FROM utilisateur INNER JOIN medecin ON utilisateur.id_user = medecin.id_user WHERE email = ? AND num_ref = ?";
            $stmt = $pdo->prepare($requete);
            $stmt->execute([$email, $num_ref]);
        } else {
            $requete = "SELECT * FROM utilisateur WHERE email = ?";
            $stmt = $pdo->prepare($requete);
            $stmt->execute([$email]);
        }

        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            // Vérifie le mot de passe
            if ($mdp === $utilisateur['mdp']) {
                // Enregistrer les données utilisateur dans la session
                $_SESSION['user_id'] = $utilisateur['id_user'];
                $_SESSION['user_name'] = $utilisateur['nom']; // Ajout du nom pour l'affichage sur d'autres pages
                $_SESSION['user_role'] = $utilisateur['role'];

                // Redirection basée sur le rôle
                switch ($_SESSION['user_role']) {
                    case 'admin':
                        header("Location: dashboard_admin.php");
                        break;
                    case 'medecin':
                        header("Location: dashboard_medecin.php");
                        break;
                    case 'parent':
                        header("Location: dashboard_parent.php");
                        break;
                    default:
                        $erreur = "Rôle inconnu. Impossible de rediriger.";
                }
                exit();
            } else {
                $erreur = "Mot de passe incorrect.";
            }
        } else {
            $erreur = "Aucun utilisateur trouvé avec cet email ou numéro de référence incorrect.";
        }
    } catch (PDOException $e) {
        $erreur = "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Se connecter</h2>

        <!-- Affichage des erreurs -->
        <?php if (isset($erreur)) { echo "<div class='alert alert-danger'>$erreur</div>"; } ?>

        <!-- Formulaire de connexion -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="mdp" name="mdp" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rôle :</label>
                <select class="form-select" name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="medecin">Médecin</option>
                    <option value="parent">Parent</option>
                </select>
            </div>

            <!-- Champ pour numéro de référence (affiché seulement si le rôle est "médecin") -->
            <div class="mb-3" id="num_ref_container" style="display:none;">
                <label for="num_ref" class="form-label">Numéro de référence (Médecin) :</label>
                <input type="text" class="form-control" id="num_ref" name="num_ref">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
        </form>
    </div>

    <!-- JavaScript pour afficher/masquer le champ numéro de référence en fonction du rôle -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roleSelect = document.getElementById('role');
            const numRefContainer = document.getElementById('num_ref_container');

            roleSelect.addEventListener('change', function() {
                numRefContainer.style.display = (this.value === 'medecin') ? 'block' : 'none';
            });
        });
    </script>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
