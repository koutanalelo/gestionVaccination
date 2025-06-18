<?php
require_once("../gestionvaccin/vue/connexion/verifier_session.php");
echo "<h1>Bienvenue, Admin " . $_SESSION['nom'] . "</h1>";
?>
<a href="deconnexion.php">Déconnexion</a>
