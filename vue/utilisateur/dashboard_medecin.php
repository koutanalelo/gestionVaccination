<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'medecin') {
    // Redirection si l'utilisateur n'est pas connecté ou n'est pas un médecin
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Médecin</title>
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
                        <a class="nav-link active" href="dashboard_medecin.php">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../utilisateur/profil_admin_medecin.php">Mon profil</a>
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
        <h2>Bienvenue, Dr. <?php echo $_SESSION['user_name']; ?> !</h2>
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
                            <li class="list-group-item">Vaccin 4 - Détails</li>
                        </ul>
                        <a href="/gestionvaccin/vue/vaccin/vaccin_list_medecin.php" class="btn btn-primary mt-3">Voir plus</a>
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
                        <p class="card-text">Voir les informations sur les vaccinations précédentes de vos patients.</p>
                        <a href="carnet_vaccination.php" class="btn btn-success mt-3">Voir le carnet</a>
                    </div>
                </div>
            </div>

            <!-- Section Suivi des patients -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Suivi des patients
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Patients en attente</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Patient 1 - En attente de vaccination</li>
                            <li class="list-group-item">Patient 2 - Vaccination prévue</li>
                            <li class="list-group-item">Patient 3 - En consultation</li>
                        </ul>
                        <a href="patients.php" class="btn btn-info mt-3">Voir les patients</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Notifications / Messages -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Notifications
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Messages récents</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Message de l'administration: Nouvelle mise à jour de la vaccination.</li>
                            <li class="list-group-item">Message de votre collègue: Demande de consultation pour un patient.</li>
                        </ul>
                        <a href="notifications.php" class="btn btn-warning mt-3">Voir toutes les notifications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
