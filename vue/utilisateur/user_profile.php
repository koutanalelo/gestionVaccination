<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header("Location: login.php");
    exit();
}

// Affiche un message de bienvenue pour l'utilisateur
echo "<h1>Bienvenue sur votre profil, " . $_SESSION['user_role'] . " !</h1>";
echo "<p>Ceci est votre page de profil.</p>";
?>

<!-- Ajouter ici des informations spécifiques au profil de l'utilisateur -->
<a href="edit_profile.php">Modifier mon profil</a>
<a href="logout.php">Se déconnecter</a>
