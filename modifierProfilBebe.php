<?php
header('Content-Type: application/json');

// Inclure les fichiers nécessaires
require_once("modele/Modele.class.php");
require_once("controleur/Bebe.class.php");

// Récupérer les données envoyées en POST
$data = json_decode(file_get_contents("php://input"), true);

// Vérifier si toutes les données sont présentes
if (
    isset($data['id_bebe']) &&
    isset($data['nom']) &&
    isset($data['prenom']) &&
    isset($data['date_naissance']) &&
    isset($data['poid']) &&
    isset($data['taille']) &&
    isset($data['id_user'])
) {
    try {
        // Nettoyer les données si nécessaire (ici juste trim)
        $id_bebe = intval($data['id_bebe']);
        $nom = trim($data['nom']);
        $prenom = trim($data['prenom']);
        $date_naissance = $data['date_naissance'];
        $poid = floatval($data['poid']);
        $taille = floatval($data['taille']);
        $id_user = intval($data['id_user']);

        // Appel de la fonction de mise à jour
        Bebe::ModifierBebe($id_bebe, $nom, $prenom, $date_naissance, $poid, $taille, $id_user);

        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Profil du bébé modifié avec succès.'
        ]);

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Données manquantes pour la modification.'
    ]);
}
?>
