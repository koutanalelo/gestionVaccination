<?php
require_once("modele/Modele.class.php");









if (isset($_REQUEST['id_user'])) {
    $id_user = $_REQUEST['id_user'];

    // Requête pour récupérer les informations du bébé
    $query = "SELECT * FROM bebe WHERE id_user = :id_user";
    $params = [":id_user" => $id_user];
    
    $bebes = Modele::executerRequete($query, $params);
    
    if ($bebes) {
        echo json_encode(['bebes' => $bebes]);
    } else {
        echo json_encode(['error' => 'Aucun bébé trouvé pour cet utilisateur']);
    }
} else {
    echo json_encode(['error' => 'Utilisateur non connecté']);
}
?>
