<?php

require_once("../controleur/factory.class.php");
require_once("../controleur/controleur.class.php");

if (isset($_GET['id_medecin'])) {
    $id_medecin = $_GET['id_medecin'];

    // Supprimer le médecin
    Medecin::SupprimerMedecin($id_medecin);

    // Rediriger vers la page des médecins après suppression
    header('Location: vue_afficher_medecin.php');
    exit;
} else {
    echo "Aucun ID de médecin fourni.";
    exit;
}
?>
