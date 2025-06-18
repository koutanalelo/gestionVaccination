<?php
require_once("verifier_session.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/CarnetVaccination.class.php");

// Vérifier si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par le formulaire
    $id_c = $_POST['id_c'] ?? null;
    $date_administration = $_POST['date_administration'] ?? null;
    $id_medecin = $_POST['id_medecin'] ?? null;
    $statut = $_POST['statut'] ?? null;
    $id_bebe = $_POST['id_bebe'] ?? null;
    $id_vaccin = $_POST['id_vaccin'] ?? null;
    $rappel = $_POST['rappel'] ?? null;

    // Vérifier que tous les champs obligatoires sont présents
    if (!$id_c || !$date_administration || !$id_medecin || !$statut || !$id_bebe || !$id_vaccin) {
        echo "<p class='text-danger'>Erreur : Tous les champs sont obligatoires.</p>";
        exit;
    }

    try {
        // Modifier le carnet de vaccination
        CarnetVaccination::ModifierCarnetVaccination(
            $id_c,
            $date_administration,
            $id_medecin,
            $statut,
            $id_bebe,
            $id_vaccin,
            $rappel
        );

        // Redirection après modification
        header("Location: vue_afficher_carnet.php?message=Modification réussie");
        exit;
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erreur lors de la modification : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='text-danger'>Erreur : Le formulaire n'a pas été soumis correctement.</p>";
    exit;
}
