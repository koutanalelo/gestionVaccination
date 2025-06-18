<?php
require_once('../../controleur/factory.class.php');

// chemin relatif

require_once('../../controleur/controleur.class.php');
// chemin relatif;

if (isset($_GET['id_user'])) {
    $id_user= $_GET['id_user'];

    // Supprimer le médecin
    Utilisateur::SupprimerUtilisateur($id_user);

    // Rediriger vers la page des médecins après suppression
    header('Location: vue_afficher_user.php');
    exit;
} else {
    echo "Aucun ID de l'utilisateur fourni.";
    exit;
}
?>
