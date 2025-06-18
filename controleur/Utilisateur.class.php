<?php

class Utilisateur {
    public static function AjouterUtilisateur($nom, $prenom, $email, $role, $mdp) {
        $requete = "CALL AjouterUtilisateur(?, ?, ?, ?, ?)";
        Modele::executerRequete($requete, [$nom, $prenom, $email, $role, $mdp]);
    }

    public static function  LireUtilisateurs() {
        $requete = "CALL LireUtilisateurs()";
        return Modele::executerRequete($requete);
    }

    public static function  ModifierUtilisateur($id_user, $nom, $prenom, $email, $role, $mdp) {
        $requete = "CALL ModifierUtilisateur(?, ?, ?, ?, ?, ?)";
        Modele::executerRequete($requete, [$id_user, $nom, $prenom, $email, $role, $mdp]);
    }

    public static function SupprimerUtilisateur($id_user) {
        $requete = "CALL SupprimerUtilisateur(?)";
        Modele::executerRequete($requete, [$id_user]);
    }
    public static function LireUtilisateurParId($id_user) {
        $requete = "SELECT id_user, nom, prenom, email, role 
                    FROM utilisateur
                    WHERE id_user = ?";
        
        // Exécuter la requête en utilisant l'ID de l'utilisateur
        $resultat = Modele::executerRequete($requete, [$id_user]);
        
        // Vérifie si un utilisateur a été trouvé
        if ($resultat && count($resultat) > 0) {
            return $resultat[0];  // Retourne le premier (et unique) résultat
        }
        
        return null;  // Aucun utilisateur trouvé avec cet ID
    }
  
    
    
    public static function LireParents() {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=gestionvaccin', 'root', '');

        // Requête pour récupérer les parents
        $sql = "SELECT id_user, nom, prenom FROM utilisateur WHERE role = 'parent'";

        // Exécuter la requête
        $stmt = $pdo->query($sql);

        // Vérifier si la requête a réussi et renvoyer les résultats sous forme de tableau associatif
        if ($stmt === false) {
            return [];
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Ceci retournera un tableau avec des clés 'id_user', 'nom', 'prenom'
    }
    
    
    


    public static function LireUtilisateurParEmail($email) {
        $requete = "SELECT id_user, nom, prenom, email, mdp FROM utilisateur WHERE email = ?";
        $resultat = Modele::executerRequete($requete, [$email]);
        
        if ($resultat && count($resultat) > 0) {
            return $resultat[0]; // Retourne l'utilisateur trouvé
        }
        
        return null; // Aucun utilisateur trouvé
    }

   

}
?>
