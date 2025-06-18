<?php 
header('Content-Type: application/json');

// Inclure les classes nécessaires
require_once("modele/Modele.class.php");
require_once("controleur/CarnetVaccination.class.php");

try {
    // Appeler la méthode pour récupérer tous les carnets de vaccination
    $carnets = CarnetVaccination::LireTousLesCarnets();

    // Vérifier si les carnets existent
    if (empty($carnets)) {
        echo json_encode(['error' => 'Aucun carnet de vaccination trouvé']);
        exit();
    }

    // Retourner les carnets en format JSON
    echo json_encode($carnets);
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
