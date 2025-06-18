
<?php
session_start();
require_once("C:/xampp/htdocs/gestionvaccin/modele/modele.class.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/utilisateur.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];  // Ici, tu vas prendre le mot de passe saisi par l'utilisateur

    // Récupérer l'utilisateur depuis la base de données
    $user = Utilisateur::LireUtilisateurParEmail($email);  // Ici, Utilisateur::LireUtilisateurParEmail récupère l'utilisateur

    if ($user && $mdp == $user['mdp']) {  // Vérifie que le mot de passe correspond (en clair)
        // Connexion réussie
        $_SESSION['user'] = $user;
        header("Location: page_protegee.php"); // Redirige vers la page protégée (par exemple dashboard)

        exit;
    } else {
        // Échec de la connexion
        $_SESSION['message'] = "Mot de passe incorrect ou utilisateur non trouvé.";
        header("Location: ../connexion.php"); // Redirige vers la page de connexion
        exit;
    }
}
?>
