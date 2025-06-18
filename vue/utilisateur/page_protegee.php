<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header("Location: vue/connexion/connexion.php");
    exit;
}

// Si l'utilisateur est connecté, affiche la page protégée
echo "<h1>Bienvenue sur la page protégée</h1>";
echo "<p>Vous êtes connecté en tant que " . $_SESSION['user']['nom']  . "</p>";
?>
