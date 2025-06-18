<?php
require_once("verifier_session.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/CarnetVaccination.class.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p class='text-danger'>Erreur : ID de carnet invalide.</p>";
    exit;
}

$id_c = $_GET['id'];

try {
    CarnetVaccination::SupprimerCarnet($id_c);
    // Redirection vers la page d'affichage des carnets après ajout
    header("Location: vue_afficher_carnet.php");
} catch (Exception $e) {
    echo "<p class='text-danger'>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
}
?>
