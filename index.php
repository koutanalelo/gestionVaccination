<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion Vaccination</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>


/* Style global */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

header {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

header .logo h1 {
    margin: 0;
}

nav {
    text-align: right;
}

.menu-right {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-end;
}

.menu-right > li {
    position: relative;
    margin-right: 20px;
}

.menu-right a {
    color: white;
    text-decoration: none;
    padding: 10px;
    display: block;
}

.menu-right a:hover {
    background-color: #45a049;
    border-radius: 5px;
}

.submenu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #3e8e41;
    list-style: none;
    padding: 0;
    width: 200px;
    border-radius: 5px;
}

.submenu li {
    text-align: left;
    padding: 0;
}

.submenu a {
    padding: 10px;
    color: white;
    text-decoration: none;
}

.submenu a:hover {
    background-color: #45a049;
}

.menu-right > li:hover .submenu {
    display: block;
}

.hero {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #f4f4f4;
    margin: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.hero-image {
    max-width: 40%;
    margin-right: 20px;
    border-radius: 5px;
}

.hero-text h2 {
    color: #4CAF50;
    margin: 0 0 10px;
}

.hero-text p {
    margin: 10px 0;
}

.hero-text .cta {
    text-decoration: none;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 15px;
}

.hero-text .cta:hover {
    background-color: #45a049;
}

/* HTML et Body doivent prendre toute la hauteur de la page */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column; /* Structure verticale (header, main, footer) */
}

/* Le contenu principal prend tout l'espace disponible */
main {
    flex: 1; /* Permet au main de s'étendre pour pousser le footer en bas */
    padding: 20px;
    text-align: center;
    background-color: #f4f4f4;
}

/* Footer stylisé toujours en bas */
footer {
    background-color: #4CAF50;
    color: white;
    padding: 20px 10px;
    text-align: center;
    border-top: 2px solid #3e8e41;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px;
}

.footer-links, .footer-contact, .footer-social {
    flex: 1;
    min-width: 200px;
    margin: 10px;
}

.footer-links h3, .footer-contact h3, .footer-social h3 {
    margin-bottom: 10px;
    text-transform: uppercase;
    color: #ffffff;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin: 5px 0;
}

.footer-links a {
    text-decoration: none;
    color: white;
    transition: color 0.3s;
}

.footer-links a:hover {
    color: #ddd;
}

.footer-contact p {
    margin: 5px 0;
}

.footer-contact a {
    text-decoration: none;
    color: white;
}

.footer-contact a:hover {
    text-decoration: underline;
}

.footer-social a {
    margin: 0 5px;
    display: inline-block;
}

.footer-social img {
    width: 30px;
    height: 30px;
    transition: transform 0.3s;
}

.footer-social img:hover {
    transform: scale(1.1);
}

.footer-bottom {
    margin-top: 20px;
    border-top: 1px solid #3e8e41;
    padding-top: 10px;
}

.footer-bottom span {
    font-weight: bold;
}






</style>






<body>
    <header>
        <div class="logo">
            <h1>Gestion Vaccination</h1>
        </div>
        <nav>
            <ul class="menu-right">
                <li><a href="index.php">Accueil</a></li>
                <li>
                    <a href="medecin.php">Médecin</a>
                    <ul class="submenu">
                        <li><a href="http://localhost/gestionvaccin/vue/vue_afficher_medecin.php">Liste des Médecins</a>
                        </li>
                        <li><a href="http://localhost/gestionvaccin/vue/vue_ajouter_Medecin.php">Ajouter un Médecin</a></li>
                    </ul>
                </li>
                <li>
                <a href="#">Vaccin</a>
                <ul class="submenu">
                <li><a href="http://localhost/gestionvaccin/vue/vaccin/vue_afficher_vaccin.php">Liste vaccin</a></li>
                        <li><a href="http://localhost/gestionvaccin/vue/vaccin/vue_ajouter_vaccin.php">Ajouter un Vaccin</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">Carnet de vaccinations</a>
                    <ul class="submenu">
                       
                        <li><a href="http://localhost/gestionvaccin/vue/carnet/vue_ajouter_carnet.php">Ajouter un carnet </a></li>
                        <li><a href="http://localhost/gestionvaccin/vue/carnet/vue_afficher_carnet.php">Liste des carnet</a>
                        </li>
                    </ul>
                </li>



                <li>
                    <a href="#">Utilisateur</a>
                    <ul class="submenu">
                       
                        <li><a href="http://localhost/gestionvaccin/vue/utilisateur/vue_ajouter_user.php">Ajouter un Utilisateur</a></li>
                        <li><a href="http://localhost/gestionvaccin/vue/utilisateur/vue_afficher_user.php">Liste des Utilisateurs</a>
                        </li>
                    </ul>
                </li>
              
                <li>
                    <a href="#">Contact</a>
                    <ul class="submenu">
                        <li><a href="articles.php">Articles & Vidéos</a></li>

                        <li>
                            <a href="#">FAQ</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Les bébés</a>
                    <ul class="submenu">
                        <li><a href="http://localhost/gestionvaccin/vue/child/list.php">Liste des Bébés</a></li>
                        <li><a href="http://localhost/gestionvaccin/vue/child/add.php">Ajouter un Bébé</a></li>
                    </ul>
                </li>


                <li>
                    <a href="http://localhost/gestionvaccin/vue/utilisateur/profil_admin_medecin.php">Profil</a>
                    <ul class="submenu">
                        <li><a href="http://localhost/gestionvaccin/vue/utilisateur/profile.php">Voir mes informations</a></li>
                        <li><a href="http://localhost/gestionvaccin/vue/utilisateur/modifier_profil_admin_medecin.php">Modifier mes informations</a></li>
                        <li><a href="http://localhost/gestionvaccin/vue/utilisateur/logout.php">Déconnexion</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <img src="data:image/jpeg;base64,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" alt="Un médecin avec un bébé" class="hero-image">
            <div class="hero-text">
                <h2>Bienvenue sur la plateforme de gestion des vaccinations</h2>
                <p>Facilitez la gestion des vaccinations grâce à notre solution tout-en-un. Gérez les profils des médecins, suivez les bébés et gardez un œil sur les vaccins essentiels.</p>
                <a href="vue_select_Bebe.php" class="cta">Voir les dossiers des bébés</a>
            </div>
        </section>
    </main>
    <footer>
    <div class="footer-container">
        <div class="footer-links">
            <h3>Liens utiles</h3>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="vue_select_Bebe.php">Dossiers Bébés</a></li>
                <li><a href="vue_select_Vaccin.php">Vaccins</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h3>Contact</h3>
            <p>Email : <a href="mailto:support@gestionvaccin.com">gestionvaccin@gmail.com</a></p>
            <p>Téléphone : +33 1 23 45 67 89</p>
        </div>
        <div class="footer-social">
            <h3>Suivez-nous</h3>
            <a href="#" class="social-icon"><img src="https://img.icons8.com/?size=128&id=mALwz43zNFpF&format=gif"
 alt="Facebook"></a>
            <a href="#" class="social-icon"><img src="https://img.icons8.com/?size=96&id=ULM26f07x6SD&format=gif" alt="Twitter"></a>
            <a href="#" class="social-icon"><img src=" https://img.icons8.com/?size=128&id=Lr4D9lVxxZdR&format=gif"
 alt="Instagram"></a>
        </div>
    </div>
  

</body>
</html>
