<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises dans le formulaire
    $id_medecin = $_POST['id_medecin'];
    $num_ref = $_POST['num_ref'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Appeler la méthode ModifierMedecin pour modifier les données dans la base
    Medecin::ModifierMedecin($id_medecin, $num_ref, $nom, $prenom);

    // Rediriger vers la page de la liste des médecins après la modification
    header("Location: vue_afficher_medecin.php");
    exit;
}
?>
