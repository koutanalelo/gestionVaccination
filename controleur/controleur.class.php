<?php
require_once("C:/xampp/htdocs/gestionvaccin/modele/modele.class.php");
require_once("Medecin.class.php");
require_once("Utilisateur.class.php");
require_once("Vaccin.class.php");
require_once("CarnetVaccination.class.php");
require_once("Bebe.class.php");


class Controleur {
  
    public static function ajouterUtilisateur($nom, $prenom, $email, $role, $mdp) {
        // Validation des données
        if (empty($nom) || empty($prenom) || empty($email) || empty($mdp)) {
            throw new Exception("Tous les champs doivent être remplis.");
        }
        
        // Sécurisation de l'email et du mot de passe
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        
        // Ajout de l'utilisateur
        try {
            Utilisateur::ajouter($nom, $prenom, $email, $role, $mdp);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function lireTousLesUtilisateurs() {
        try {
            return Utilisateur::lireTous();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture des utilisateurs : " . $e->getMessage());
        }
    }

    public static function modifierUtilisateur($id_user, $nom, $prenom, $email, $role, $mdp) {
        try {
            Utilisateur::modifier($id_user, $nom, $prenom, $email, $role, $mdp);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification de l'utilisateur : " . $e->getMessage());
        }
    }

    public static function supprimerUtilisateur($id_user) {
        try {
            Utilisateur::supprimer($id_user);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }

    // Gestion des Bébés
    public static function ajouterBebe($nom, $prenom, $date_naissance, $poid, $taille, $id_user) {
        try {
            Bebe::ajouter($nom, $prenom, $date_naissance, $poid, $taille, $id_user);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du bébé : " . $e->getMessage());
        }
    }

    public static function lireTousLesBebes() {
        try {
            return Bebe::lireTous();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture des bébés : " . $e->getMessage());
        }
    }

    public static function modifierBebe($id_bebe, $nom, $prenom, $date_naissance, $poid, $taille) {
        try {
            Bebe::modifier($id_bebe, $nom, $prenom, $date_naissance, $poid, $taille);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification du bébé : " . $e->getMessage());
        }
    }

    public static function supprimerBebe($id_bebe) {
        try {
            Bebe::supprimer($id_bebe);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du bébé : " . $e->getMessage());
        }
    }

    // Gestion des Médecins
    public static function ajouterMedecin($id_user, $num_ref) {
        try {
            Medecin::ajouter($id_user, $num_ref);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du médecin : " . $e->getMessage());
        }
    }

    public static function lireTousLesMedecins() {
        try {
            return Medecin::lireTous();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture des médecins : " . $e->getMessage());
        }
    }

    public static function modifierMedecin($id_medecin, $num_ref) {
        try {
            Medecin::modifier($id_medecin, $num_ref);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification du médecin : " . $e->getMessage());
        }
    }

    public static function supprimerMedecin($id_medecin) {
        try {
            Medecin::supprimer($id_medecin);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du médecin : " . $e->getMessage());
        }
    }

    // Gestion des Vaccins
    public static function ajouterVaccin($nom, $description, $age_recommande, $id_bebe, $date_renouvellement, $obligatoire) {
        try {
            Vaccin::ajouter($nom, $description, $age_recommande, $id_bebe, $date_renouvellement, $obligatoire);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du vaccin : " . $e->getMessage());
        }
    }

    public static function lireTousLesVaccins() {
        try {
            return Vaccin::lireTous();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture des vaccins : " . $e->getMessage());
        }
    }

    public static function modifierVaccin($id_vaccin, $nom, $description, $age_recommande, $date_renouvellement, $obligatoire) {
        try {
            Vaccin::modifier($id_vaccin, $nom, $description, $age_recommande, $date_renouvellement, $obligatoire);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification du vaccin : " . $e->getMessage());
        }
    }

    public static function supprimerVaccin($id_vaccin) {
        try {
            Vaccin::supprimer($id_vaccin);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du vaccin : " . $e->getMessage());
        }
    }

    // Gestion du Carnet de Vaccination
    public static function ajouterCarnet($date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel) {
        try {
            CarnetVaccination::ajouter($date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'ajout du carnet : " . $e->getMessage());
        }
    }

    public static function lireTousLesCarnets() {
        try {
            return CarnetVaccination::lireTous();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture des carnets : " . $e->getMessage());
        }
    }

    public static function lireCarnetParBebe($id_bebe) {
        try {
            return CarnetVaccination::lireParBebe($id_bebe);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture du carnet par bébé : " . $e->getMessage());
        }
    }

    public static function lireCarnetParMedecin($id_medecin) {
        try {
            return CarnetVaccination::lireParMedecin($id_medecin);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la lecture du carnet par médecin : " . $e->getMessage());
        }
    }

    public static function modifierCarnet($id_c, $date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel) {
        try {
            CarnetVaccination::modifier($id_c, $date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la modification du carnet : " . $e->getMessage());
        }
    }

    public static function supprimerCarnet($id_c) {
        try {
            CarnetVaccination::supprimer($id_c);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression du carnet : " . $e->getMessage());
        }
    }
  
    public static function verifConnexion($email, $mdp) {
        return Modele ::  verifConnexion($email,$mdp);
        
        }
        
    




}