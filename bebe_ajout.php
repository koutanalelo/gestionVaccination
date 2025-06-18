<?php
header('Content-Type: application/json');

// Inclure les classes nécessaires
require_once("modele/Modele.class.php");
require_once("controleur/Bebe.class.php");

// Vérifier si la méthode est POST et que le corps de la requête contient des données JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Lire les données JSON envoyées
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Décode le JSON en tableau associatif

    // Vérifier si les données ont été correctement décodées
    if ($data === null) {
        echo json_encode(['error' => 'Données JSON invalides']);
        exit();
    }

    // Récupérer les données envoyées dans le JSON
    $nom = isset($data['nom']) ? $data['nom'] : null;
    $prenom = isset($data['prenom']) ? $data['prenom'] : null;
    $date_naissance = isset($data['date_naissance']) ? $data['date_naissance'] : null;
    $poid = isset($data['poid']) ? $data['poid'] : null;
    $taille = isset($data['taille']) ? $data['taille'] : null;
    $id_user = isset($data['id_user']) ? $data['id_user'] : null;

    // Vérifier que toutes les données sont présentes
    if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($poid) || empty($taille) || empty($id_user)) {
        echo json_encode(['error' => 'Tous les champs doivent être remplis']);
        exit();
    }

    try {
        // Appeler la méthode pour ajouter le bébé à la base de données
        Bebe::AjouterBebe($nom, $prenom, $date_naissance, $poid, $taille, $id_user);

        // Retourner une réponse de succès
        echo json_encode(['success' => 'Bébé ajouté avec succès']);
    } catch (Exception $e) {
        // En cas d'erreur, retourner un message d'erreur
        echo json_encode(['error' => $e->getMessage()]);
    }

} else {
    // Si ce n'est pas une requête POST, afficher une erreur
    echo json_encode(['error' => 'Méthode non autorisée']);
}
?>
