<!-- index.php 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue sur notre site</h1>
    <p>Cette page est accessible à tous.</p>

    <p><a href="../gestionvaccin/vue/utilisateur/login.php">Se connecter</a></p>
    <p><a href="../gestionvaccin/vue/utilisateur/register.php">S'inscrire</a></p>
</body>
</html>
-->
<!-- index.php -->
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
                        header("Location: /gestionvaccin/vue/utilisateur/dashboard_admin.php");
                        break;
                    case 'medecin':
                        header("Location: /gestionvaccin/vue/utilisateur/dashboard_medecin.php");
                        break;
                    case 'parent':
                        header("Location: /gestionvaccin/vue/utilisateur/dashboard_parent.php");
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accueil - Gestion des Vaccins</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .hero {
      background: #007bff;
      color: white;
      padding: 60px 20px;
      text-align: center;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }
    .dropdown-menu-large {
      width: 600px;
    }
    .account-card {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    .btn-custom {
      margin-top: 20px;
    }
    @media (max-width: 768px) {
      .dropdown-menu-large {
        width: 100%;
      }
    }


    /**footer */
    .footer-bs {
    background-color: #009688;
    padding: 60px 40px;
    color: rgba(255, 255, 255, 1.00);
    margin: 0; /* Supprime toute marge */
    width: 100%; /* Fait en sorte que le footer occupe toute la largeur */
    box-sizing: border-box; /* Inclut padding et bordures dans la largeur */
}

.footer-bs .row {
    margin: 0; /* Supprime les marges entre les colonnes */
}

.footer-bs .footer-brand,
.footer-bs .footer-nav,
.footer-bs .footer-social,
.footer-bs .footer-ns {
    padding: 10px 25px;
}

.footer-bs .footer-nav h4,
.footer-bs .footer-social h4,
.footer-bs .footer-ns h4 {
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 2px;
    margin-bottom: 10px;
    color: rgba(255, 255, 255, 0.8);
}

.footer-bs p,
.footer-bs ul {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7);
}

.footer-bs ul {
    list-style: none;
    padding: 0;
}

.footer-bs ul li {
    padding: 5px 0;
}

.footer-bs ul li a {
    color: rgba(255, 255, 255, 1.00);
    text-decoration: none;
}

.footer-bs ul li a:hover {
    color: rgba(255, 255, 255, 0.8);
}

.footer-bs .input-group {
    margin-top: 10px;
}

.footer-bs .input-group .form-control {
    border: none;
    border-radius: 4px;
    box-shadow: none;
}

.footer-bs .input-group .btn {
    background-color: #fff;
    color: #009688;
    border: none;
    border-radius: 4px;
}

.footer-bs .input-group .btn:hover {
    background-color: #e0e0e0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .footer-bs .footer-brand,
    .footer-bs .footer-nav,
    .footer-bs .footer-social,
    .footer-bs .footer-ns {
        text-align: center;
        margin-bottom: 20px;
    }
}

  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">GestionVaccin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Médecin</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="contactDropdown" role="button" data-bs-toggle="dropdown">
            Contact
          </a>
          <ul class="dropdown-menu" aria-labelledby="contactDropdown">
            <li><a class="dropdown-item" href="#">Blog & Vidéo</a></li>
            <li><a class="dropdown-item" href="#">FAQ</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="compteDropdown" role="button" data-bs-toggle="dropdown">
            Compte
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-large p-4">
            <div class="row">
              <!-- Connexion -->
              <div class="col-md-6">
                <div class="account-card">
                  <h5 class="mb-3">Connexion</h5>
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
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                  </form>
                  <?php if (isset($erreur)) { echo "<div class='alert alert-danger mt-3'>$erreur</div>"; } ?>
                </div>
              </div>

              <!-- Créer un compte -->
              <div class="col-md-6">
                <div class="account-card d-flex flex-column justify-content-center align-items-center h-100">
                  <h5 class="mb-3">Créer un compte</h5>
                  <p>Vous êtes nouveau ? Rejoignez-nous !</p>
                  <a href="/gestionvaccin/vue/utilisateur/register.php" class="btn btn-outline-primary w-100">Créer un compte</a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="hero">
  <div class="container">
    <h1>Bienvenue sur la plateforme de Gestion des Vaccins</h1>
    <p>Gérez vos vaccinations, carnets de santé et plus encore en toute simplicité.</p>
  </div>
</section>

<!-- Footer -->
<footer class="text-center py-4 bg-light mt-5">
<div class="container">
    <section style="height:80px;"></section>
	<div class="row" style="text-align:center;">
		<h2>Bootstrap Gestion Vaccination</h2>
	</div>
    <!----------- Footer ------------>
    <footer class="footer-bs">
        <div class="row">
        	<div class="col-md-3 footer-brand animated fadeInLeft">
            	<h2>Logo</h2>
                <p>Notre mission est de veiller sur vous et l'ineteret de vos enfants .</p>
                <p>© 2025 tout edition</p>
            </div>
        	<div class="col-md-4 footer-nav animated fadeInUp">
            	<h4>Menu —</h4>
            	<div class="col-md-6">
                    <ul class="pages">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Medecin</a></li>
                        <li><a href="#">Vaccin</a></li>
                        <li><a href="#">Carnet de vaccination</a></li>
                        <li><a href="#">Carnet</a></li>
                    </ul>
                </div>
            	<div class="col-md-6">
                    <ul class="list">
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">A propos de nous </a></li>
                        <li><a href="#">Terme & Condition</a></li>
                        <li><a href="#">Faq & Videos</a></li>
                    </ul>
                </div>
            </div>
        	<div class="col-md-2 footer-social animated fadeInDown">
            	<h4>Reseaux Sociaux</h4>
            	<ul>
                	<li><a href="#">Facebook</a></li>
                	<li><a href="#">Twitter</a></li>
                	<li><a href="#">Instagram</a></li>
                	<li><a href="#">Linkedin</a></li>
                </ul>
            </div>
        	<div class="col-md-3 footer-ns animated fadeInRight">
            	<h4>Boite Au Lettre</h4>
                <p>La vaccination pour le bien etre de vos enfants</p>
                <p>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
                      </span>
                    </div><!-- /input-group -->
                 </p>
            </div>
        </div>
    </footer>
    <section style="text-align:center; margin:10px auto;"><p>Realiser par<a href="http://princesargbah.me">WEB DEVELOPPEUR</a></p></section>

</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const roleSelect = document.getElementById('role');
    const numRefContainer = document.getElementById('num_ref_container');

    roleSelect.addEventListener('change', function() {
      numRefContainer.style.display = (this.value === 'medecin') ? 'block' : 'none';
    });
  });
</script>
</body>
</html>

