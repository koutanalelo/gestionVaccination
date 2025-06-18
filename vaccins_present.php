<?php
header('Content-Type: application/json');

// Inclure les fichiers nécessaires avec des chemins relatifs
require_once("modele/Modele.class.php");

if (file_exists("controleur/Vaccin.class.php")) {
    require_once("controleur/Vaccin.class.php");
} else {
    echo json_encode(['error' => 'Fichier Vaccin.class.php non trouvé']);
    exit();
}

try {
    // Lecture des vaccins présents
    $vaccinsPresent = Vaccin::LireTousLesVaccins();
    echo json_encode($vaccinsPresent); // Retourner la liste des vaccins présents sous forme de JSON
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
