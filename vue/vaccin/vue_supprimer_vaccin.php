<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/Vaccin.class.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p class='text-danger'>Erreur : ID de vaccin invalide ou non transmis.</p>";
    exit;
}

$id_vaccin = $_GET['id'];

try {
    Vaccin::SupprimerVaccin($id_vaccin);
    echo "<p class='text-success'>Le vaccin a été supprimé avec succès.</p>";
    echo "<a href='vue_afficher_vaccin.php' class='btn btn-primary'>Retour à la liste des vaccins</a>";
    exit;
} catch (Exception $e) {
    echo "<p class='text-danger'>Erreur lors de la suppression : " . $e->getMessage() . "</p>";
}
?>
