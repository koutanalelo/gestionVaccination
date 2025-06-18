<?php

require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $mdp = $_POST['mdp'];

    Utilisateur::ModifierUtilisateur($id_user, $nom, $prenom, $email, $role, $mdp);

    // Redirection après modification
    header("Location: vue_afficher_user.php");
    exit();
}
?>
