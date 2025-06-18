<?php
session_start();  // Démarrer la session

require_once("C:/xampp/htdocs/gestionvaccin/modele/modele.class.php");

if (isset($_SESSION['id_user'])) {  // Vérifier si l'utilisateur est connecté
    $id_user = $_SESSION['id_user'];  // Utiliser id_user au lieu de id_parent

    // On suppose que tu as une méthode pour récupérer le bébé lié à un utilisateur
    $bebe = Bebe::LireBebeParUser($id_user);  // Modifie la méthode pour qu'elle prenne l'id_user

    if ($bebe) {
        echo json_encode($bebe);  // Si un bébé est trouvé, on retourne les données en JSON
    } else {
        echo json_encode(["message" => "Aucun bébé trouvé pour cet utilisateur"]);
    }
} else {
    echo json_encode(["message" => "Utilisateur non connecté"]);
}
?>
