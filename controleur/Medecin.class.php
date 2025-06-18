<?php
require_once("C:/xampp/htdocs/gestionvaccin/modele/modele.class.php");

class Medecin {
    public static function  AjouterMedecin($id_user, $num_ref) {
        $requete = "CALL AjouterMedecin(?, ?)";
        Modele::executerRequete($requete, [$id_user, $num_ref]);
    }



    public static function ModifierMedecin($id_medecin, $num_ref, $nom, $prenom) {
        // Requête SQL pour modifier le médecin, y compris le nom, prénom et le numéro de référence
        $requete = "UPDATE medecin
                    JOIN utilisateur ON medecin.id_user = utilisateur.id_user
                    SET medecin.num_ref = ?, utilisateur.nom = ?, utilisateur.prenom = ?
                    WHERE medecin.id_medecin = ?";
    
        // Exécution de la requête avec les nouveaux paramètres
        Modele::executerRequete($requete, [$num_ref, $nom, $prenom, $id_medecin]);
    }
    
    

    public static function  SupprimerMedecin($id_medecin) {
        $requete = "CALL SupprimerMedecin(?)";
        Modele::executerRequete($requete, [$id_medecin]);
    }
       

    public static function LireMedecins() {
        try {
            $requete = "SELECT medecin.id_medecin, medecin.id_user, medecin.num_ref, utilisateur.nom, utilisateur.prenom
                        FROM medecin
                        JOIN utilisateur ON medecin.id_user = utilisateur.id_user";
    
            $medecins = Modele::executerRequete($requete);
    
            // Débogage : Afficher les résultats
    
            return $medecins;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    

// Méthode pour récupérer un médecin par son ID
public static function LireMedecinParId($id_medecin) {
    // Requête SQL pour récupérer les informations d'un médecin par son ID
    $requete = "SELECT medecin.id_medecin, medecin.id_user, medecin.num_ref, utilisateur.nom, utilisateur.prenom
                FROM medecin
                JOIN utilisateur ON medecin.id_user = utilisateur.id_user
                WHERE medecin.id_medecin = ?";
    
    // Exécution de la requête avec l'ID du médecin
    $resultat = Modele::executerRequete($requete, [$id_medecin]);
    
    // Vérifie si un médecin a été trouvé
    if ($resultat && count($resultat) > 0) {
        return $resultat[0];  // Retourne le premier (et unique) résultat
    }
    
    return null;  // Aucun médecin trouvé avec cet ID
}













    
}
?>
