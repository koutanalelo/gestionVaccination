<?php
header('Content-Type: application/json');

// Inclure les fichiers nécessaires
require_once("modele/Modele.class.php");
require_once("controleur/Vaccin.class.php");

try {
    // Appel de la méthode pour récupérer les vaccins futurs
    $vaccinsFuturs = Vaccin::LireVaccinsFuturs();

    // Vérifier si des vaccins sont retournés
    if (!empty($vaccinsFuturs)) {
        echo json_encode($vaccinsFuturs);  // Retourner les vaccins sous forme de JSON
    } else {
        echo json_encode(['message' => 'Aucun vaccin futur trouvé']);
    }
} catch (Exception $e) {
    // Gestion des erreurs
    echo json_encode(['error' => $e->getMessage()]);
}
?>
