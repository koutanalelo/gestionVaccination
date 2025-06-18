<?php
// Inclure la classe Bebe
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");

// Retourner les données au format JSON
header('Content-Type: application/json');

// Récupérer les données des bébés
$bebes = Bebe::LireBebes();

// Retourner les données JSON
echo json_encode($bebes);
?>
