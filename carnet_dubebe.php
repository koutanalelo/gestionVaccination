<?php 
header('Content-Type: application/json');

// Inclure les classes nécessaires
require_once("modele/Modele.class.php");
require_once("controleur/CarnetVaccination.class.php");

// Simuler la session utilisateur (à adapter selon ta gestion de la session)
session_start();
$id_user = $_SESSION['id_user'];  // L'ID de l'utilisateur connecté
$role = $_SESSION['role'];        // Le rôle de l'utilisateur ('parent' ou 'medecin')

// Vérifier si l'ID de l'utilisateur est défini
if (!isset($id_user)) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit();
}

try {
    // Appeler la méthode pour récupérer les carnets de vaccination de l'utilisateur connecté
    $carnets = CarnetVaccination::LireCarnetParBebe($id_user, $role);

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
