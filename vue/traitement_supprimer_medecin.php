<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

if (isset($_GET['id_medecin'])) {
    $id_medecin = $_GET['id_medecin'];

    // Supprimer le médecin en utilisant la méthode de la classe Medecin
    Medecin::SupprimerMedecin($id_medecin);

    // Rediriger vers la liste des médecins après la suppression
    header('Location: vue_afficher_medecin.php');
    exit; // Toujours ajouter un exit après un header pour arrêter le script
} else {
    echo "Aucun ID de médecin fourni.";
    exit;
}
