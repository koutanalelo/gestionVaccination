<?php
require_once("verifier_session.php");

require_once("C:/xampp/htdocs/gestionvaccin/controleur/CarnetVaccination.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Utilisateur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Medecin.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Bebe.class.php");  
require_once("C:/xampp/htdocs/gestionvaccin/controleur/Vaccin.class.php"); 
require_once("C:/xampp/htdocs/gestionvaccin/controleur/factory.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/controleur/controleur.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/modele/singleton.class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug : Vérifier les données envoyées
  

    // Récupération des données du formulaire
    $date_administration = isset($_POST['date_administration']) ? $_POST['date_administration'] : null;
    $id_bebe = isset($_POST['id_bebe']) ? $_POST['id_bebe'] : null;
    $id_vaccin = isset($_POST['id_vaccin']) ? $_POST['id_vaccin'] : null;
    $id_medecin = isset($_POST['id_medecin']) ? $_POST['id_medecin'] : null;
    $statut = isset($_POST['statut']) ? $_POST['statut'] : null;
    $rappel = isset($_POST['rappel']) ? $_POST['rappel'] : null;

    // Vérifications strictes des données
    if (empty($date_administration)) {
        echo "Erreur : La date d'administration est manquante.<br>";
    }
    if (empty($id_bebe)) {
        echo "Erreur : L'ID du bébé est manquant.<br>";
    }
    if (empty($id_vaccin)) {
        echo "Erreur : L'ID du vaccin est manquant.<br>";
    }
    if (empty($id_medecin)) {
        echo "Erreur : L'ID du médecin est manquant.<br>";
    }
    if (empty($statut)) {
        echo "Erreur : Le statut est manquant.<br>";
    }
    if (empty($rappel)) {
        echo "Erreur : La date de rappel est manquante.<br>";
    }

    // Si tous les champs sont remplis, procéder
    if (!empty($date_administration) && !empty($id_bebe) && !empty($id_vaccin) && !empty($id_medecin) && !empty($statut) && !empty($rappel)) {
        // Validation des types de données
        if (!is_numeric($id_bebe) || !is_numeric($id_vaccin) || !is_numeric($id_medecin)) {
            echo "Erreur : Les ID doivent être numériques.<br>";
        } elseif (!in_array($statut, ['prévu', 'effectué'])) {
            echo "Erreur : Le statut doit être 'prévu' ou 'effectué'.<br>";
        } elseif (!validateDate($date_administration)) {
            echo "Erreur : La date d'administration est invalide.<br>";
        } elseif (!validateDate($rappel)) {
            echo "Erreur : La date de rappel est invalide.<br>";
        } else {
            // Appel à la méthode pour ajouter le carnet de vaccination
            try {
                CarnetVaccination::AjouterCarnetVaccination($date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel);
                // Redirection vers la page d'affichage des carnets après ajout
               
               
                header("Location: vue_afficher_carnet.php");
             //   exit;
            } catch (Exception $e) {
                echo "Erreur lors de l'ajout : " . $e->getMessage();
            }
        }
    }
}

/**
 * Fonction pour valider si une date est valide au format YYYY-MM-DD
 */
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$medecins = Medecin::LireMedecins();
$bebes = Bebe::LireTousLesBebes();
$vaccins = Vaccin::LireTousLesVaccins();
?>
