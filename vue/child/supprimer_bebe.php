<?php


require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");

if (isset($_GET['id_bebe']) && is_numeric($_GET['id_bebe'])) {
    Bebe::SupprimerBebe($_GET['id_bebe']);
    session_start();
    $_SESSION['message'] = "Bébé supprimé avec succès.";
}

header("Location: list.php");
exit();
?>
