<?php
require_once("verifier_session.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/CarnetVaccination.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Utilisateur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Medecin.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");  
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Vaccin.class.php"); 
require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");


// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug : vérifier si les données sont envoyées
    // Récupération des données du formulaire
    $date_administration = $_POST['date_administration'];
    $id_bebe = $_POST['id_bebe'];
    $id_vaccin = $_POST['id_vaccin'];
    $id_medecin = $_POST['id_medecin'];
    $statut = $_POST['statut'];
    $rappel = $_POST['rappel'];

    // Appel à la méthode pour ajouter le carnet de vaccination
    CarnetVaccination::AjouterCarnetVaccination($date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel);

    // Redirection vers la page d'affichage des carnets après ajout
    header("Location: vue_afficher_carnet.php");
   // exit;
}


$medecins = Medecin::LireMedecins();
$bebes = Bebe::LireTousLesBebes();
$vaccins = Vaccin::LireTousLesVaccins();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ajouter un Carnet de Vaccination</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Ajouter un Carnet de Vaccination</h2>
        
        <!-- Formulaire pour ajouter un carnet de vaccination -->
        <form method="POST" action="traitement_ajout_carnet.php">

            <div class="mb-3">
                <label for="date_administration" class="form-label">Date d'administration</label>
                <input type="date" class="form-control" id="date_administration" name="date_administration" required>
            </div>

            <div class="mb-3">
                <label for="id_bebe" class="form-label">Sélectionner le Bébé</label>
                <select class="form-control" id="id_bebe" name="id_bebe" required>
                    <option value="">Sélectionnez un bébé</option>
                    <?php foreach ($bebes as $bebe): ?>
                        <option value="<?php echo $bebe['id_bebe']; ?>"><?php echo $bebe['nom'] . ' ' . $bebe['prenom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_vaccin" class="form-label">Sélectionner le Vaccin</label>
                <select class="form-control" id="id_vaccin" name="id_vaccin" required>
                    <option value="">Sélectionnez un vaccin</option>
                    <?php foreach ($vaccins as $vaccin): ?>
                        <option value="<?php echo $vaccin['id_vaccin']; ?>"><?php echo $vaccin['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_medecin" class="form-label">Sélectionner le Médecin</label>
                <select class="form-control" id="id_medecin" name="id_medecin" required>
                    <option value="">Sélectionnez un médecin</option>
                    <?php foreach ($medecins as $medecin): ?>
                        <option value="<?php echo $medecin['id_medecin']; ?>"><?php echo $medecin['nom'] . ' ' . $medecin['prenom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <input type="text" class="form-control" id="statut" name="statut" required>
            </div>

            <div class="mb-3">
                <label for="rappel" class="form-label">Date de Rappel</label>
                <input type="date" class="form-control" id="rappel" name="rappel" required>
            </div>

            <button type="submit" class="btn btn-success">Ajouter le Carnet de Vaccination</button>
        </form>
    </div>
    <a href="/gestionvaccin/index.php" class="btn-retour">Retour à la page d'accueil</a>
    
    <a href="/gestionvaccin/vue/carnet/vue_afficher_carnet.php" class="btn-retour">Retour à la liste</a>
</body>
</html>
