<?php
require_once("C:/xampp/htdocs/gestionvaccin/modele/modele.class.php");

class Bebe {

    public static function AjouterBebe($nom, $prenom, $date_naissance, $poid, $taille, $id_user) {
        $requete = "CALL AjouterBebe(?, ?, ?, ?, ?, ?)";
        Modele::executerRequete($requete, [$nom, $prenom, $date_naissance, $poid, $taille, $id_user]);
    }

    public static function LireBebes() {
        $requete = "SELECT bebe.*, utilisateur.nom AS parent_nom, utilisateur.prenom AS parent_prenom 
                    FROM bebe
                    JOIN utilisateur ON bebe.id_user = utilisateur.id_user"; // Jointure avec la table utilisateur
        
        $resultat = Modele::executerRequete($requete);
    
        return $resultat ?: []; // Retourne un tableau vide si aucun bébé trouvé
    }
    
    /* Exemple de méthode LireBebes()
    public static function LireBebes() {
        // Requête SQL pour récupérer les bébés
        $requete = "SELECT * FROM bebe"; // Vérifie que le nom de la table et les champs sont corrects

        // Exécuter la requête et récupérer les résultats
        $resultat = Modele::executerRequete($requete);

        // Vérifier si des résultats ont été trouvés
        if ($resultat && count($resultat) > 0) {
            return $resultat;
        }

        // Retourner un tableau vide si aucun bébé trouvé
        return [];
    }

    */
    public static function ModifierBebe($id_bebe, $nom, $prenom, $date_naissance, $poid, $taille, $id_user) {
        $requete = "UPDATE bebe SET nom = ?, prenom = ?, date_naissance = ?, poid = ?, taille = ?, id_user = ? WHERE id_bebe = ?";
        
        // Exécuter la requête avec les nouveaux paramètres
        Modele::executerRequete($requete, [$nom, $prenom, $date_naissance, $poid, $taille, $id_user, $id_bebe]);
    }

    public static function SupprimerBebe($id_bebe) {
        $requete = "CALL SupprimerBebe(?)";
        Modele::executerRequete($requete, [$id_bebe]);
    }

     // Vérifier l'existence d'un bébé par ID
     public static function verifierBebeParId() {
        if (isset($_GET['id_bebe']) && is_numeric($_GET['id_bebe'])) {
            $id_bebe = $_GET['id_bebe'];
            $bebe = Bebe::LireBebeParId($id_bebe);
            
            if ($bebe) {
                echo "Bébé trouvé : " . htmlspecialchars($bebe['nom']) . " " . htmlspecialchars($bebe['prenom']);
            } else {
                echo "Aucune donnée trouvée pour l'ID : " . htmlspecialchars($id_bebe);
            }
        } else {
            echo "Aucun ID de bébé passé dans l'URL ou l'ID n'est pas valide.";
        }
    }

    /* Lire un bébé par son ID
    public static function LireBebeParId($id_bebe) {
        try {
            $pdo = modele::getConnexion();
            $sql = "SELECT * FROM bebe WHERE id_bebe = :id_bebe";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_bebe', $id_bebe, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Exception $e) {
            echo "Erreur lors de la récupération du bébé : " . $e->getMessage();
            return null;
        }
    }
  */
  public static function LireTousLesBebes() {
    $pdo = Modele::getConnexion();
    $stmt = $pdo->prepare("SELECT id_bebe, nom,prenom FROM bebe");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/*
cette methode marche
public static function LireBebesParParent($id_user) {
    $pdo = Modele::getConnexion();
    $sql = "SELECT bebe.*, utilisateur.nom AS nom_parent, utilisateur.prenom AS prenom_parent
            FROM bebe
            JOIN utilisateur ON bebe.id_user = utilisateur.id_user
            WHERE bebe.id_user = :id_user";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
*/
public static function LireBebesParParent($id_user) {
    $pdo = Modele::getConnexion();
    $sql = "SELECT bebe.*, utilisateur.nom AS nom_parent, utilisateur.prenom AS prenom_parent, utilisateur.email
            FROM bebe
            JOIN utilisateur ON bebe.id_user = utilisateur.id_user
            WHERE utilisateur.id_user = :id_user";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}












    public static function LireBebeParId($id_bebe) {
        $pdo = Modele::getConnexion();
        $sql = "SELECT bebe.*, utilisateur.nom AS nom_parent, utilisateur.prenom AS prenom_parent
                FROM bebe
                JOIN utilisateur ON bebe.id_user = utilisateur.id_user
                WHERE bebe.id_bebe = :id_bebe";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_bebe', $id_bebe, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null; // Retourne les données du bébé avec celles du parent
    }
    

    public static function getAllBebes() {
        $requete = "SELECT id_bebe, nom FROM bebe";
        return Modele::executerRequete($requete);
    }
 





    public static function getBebeById($id) {
        // Connexion à la base de données
        $db = Modele::getConnexion();

        // Préparer la requête SQL
        $query = "SELECT id, nom, prenom, date_naissance, poid, taille FROM bebe WHERE id = :id";
        $stmt = $db->prepare($query);

        // Lier l'ID du bébé
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        // Vérifier si un bébé a été trouvé
        if ($stmt->rowCount() > 0) {
            // Récupérer les résultats sous forme de tableau associatif
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Si aucun bébé n'est trouvé, retourner false
        return false;
    }







    
}
?>
