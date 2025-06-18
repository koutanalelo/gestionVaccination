<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'parent') {
    // Redirection si l'utilisateur n'est pas connecté ou n'est pas un parent
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Parent</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestion Vaccination</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard_parent.php">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Mon profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal du dashboard -->
    <div class="container mt-5">
        <h2>Bienvenue, <?php echo $_SESSION['user_name']; ?> !</h2>
        <div class="row">
            <!-- Section Vaccins -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Vaccins disponibles
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Liste des vaccins</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Vaccin 1 - Détails</li>
                            <li class="list-group-item">Vaccin 2 - Détails</li>
                            <li class="list-group-item">Vaccin 3 - Détails</li>
                        </ul>
                        <a href="/vue/vaccin/vue_afficher_vaccin.php" class="btn btn-primary mt-3">Voir plus</a>
                    </div>
                </div>
            </div>

            <!-- Section Carnet de vaccination -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Carnet de vaccination
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Historique des vaccinations</h5>
                        <p class="card-text">Voir les informations sur les vaccinations passées de votre enfant.</p>
                        <a href="carnet_vaccination.php" class="btn btn-success mt-3">Voir le carnet</a>
                    </div>
                </div>
            </div>

            <!-- Section Bébé -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Informations sur votre bébé
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Détails sur votre bébé</h5>
                        <p>Prénom : <strong>Lucie</strong></p>
                        <p>Âge : <strong>1 an</strong></p>
                        <p>Vaccination : <strong>Complète</strong></p>
                        <a href="bebe_info.php" class="btn btn-info mt-3">Voir les détails</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Utilisateur (modifier profil) -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Mon Profil
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Modifier mon profil</h5>
                        <p>Vous pouvez mettre à jour vos informations personnelles ici.</p>
                        <a href="modifier_profil.php" class="btn btn-warning mt-3">Modifier mon profil</a>
                    </div>
                </div>
            </div>

            <!-- Section Contact -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Contactez l'administration
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">En cas de besoin, contactez-nous</h5>
                        <p>Pour toute question, contactez l'administration ou le médecin via ce formulaire.</p>
                        <a href="contact_admin.php" class="btn btn-danger mt-3">Contacter l'administration</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
