<?php
require_once("C:/xampp/htdocs/gestionvaccin/modele/modele.class.php");
require_once("C:/xampp/htdocs/gestionvaccin/modele/singleton.class.php");


class CarnetVaccination {
        public static function AjouterCarnetVaccination($date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel) {
            // Récupérer l'instance PDO
            $pdo = Singleton::getInstance()->getBdd();
    
            // Vérifier si la connexion fonctionne
            if (!$pdo) {
                throw new Exception("Erreur de connexion à la base de données.");
            }
    
            // Préparer la requête d'insertion
            $sql = "INSERT INTO carnetvaccination (date_administration, id_medecin, statut, id_bebe, id_vaccin, rappel) 
                    VALUES (:date_administration, :id_medecin, :statut, :id_bebe, :id_vaccin, :rappel)";
            
            try {
                // Préparer et exécuter la requête
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':date_administration', $date_administration);
                $stmt->bindParam(':id_medecin', $id_medecin);
                $stmt->bindParam(':statut', $statut);
                $stmt->bindParam(':id_bebe', $id_bebe);
                $stmt->bindParam(':id_vaccin', $id_vaccin);
                $stmt->bindParam(':rappel', $rappel);
                $stmt->execute();
                echo $date_administration;
                echo $id_medecin;
                echo $statut;
                echo $id_bebe;
                echo $id_vaccin;
                echo $rappel;

    
                echo "Carnet de vaccination ajouté avec succès.";
            } catch (PDOException $e) {
                echo "Erreur lors de l'ajout du carnet de vaccination : " . $e->getMessage();
            }
        }
    
    
    
   
    
    

    public static function LireTousLesCarnets() {
        $requete = "CALL LireTousLesCarnets()";
        $resultat = Modele::executerRequete($requete);
        
        if (!is_array($resultat)) {
            die("Erreur: LireTousLesCarnets() ne retourne pas un tableau !");
        }
    
        return $resultat;
    }
    

    public static function LireCarnetParBebe($id_bebe) {
        $requete = "CALL LireCarnetParBebe(?)";
        return Modele::executerRequete($requete, [$id_bebe]);
    }

    public static function LireCarnetParMedecin($id_medecin) {
        $requete = "CALL LireCarnetParMedecin(?)";
        return Modele::executerRequete($requete, [$id_medecin]);
    }

    public static function ModifierCarnetVaccination($id_c, $date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel) {
        $requete = "CALL ModifierCarnetVaccination(?, ?, ?, ?, ?, ?, ?)";
        Modele::executerRequete($requete, [$id_c, $date_administration, $id_medecin, $statut, $id_bebe, $id_vaccin, $rappel]);
    }

  
    public static function SupprimerCarnet($id_c) {
        $pdo = Singleton::getInstance()->getBdd();
    
        try {
            $sql = "DELETE FROM carnetvaccination WHERE id_c = :id_c";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_c', $id_c, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() === 0) {
                throw new Exception("Aucun carnet trouvé avec cet ID.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression : " . $e->getMessage());
        }
    }
    
    





    public static function LireCarnetParId($id_c) {
        $pdo = Singleton::getInstance()->getBdd(); // Connexion à la base de données
    
        if (!$pdo) {
            throw new Exception("Erreur de connexion à la base de données.");
        }
    
        try {
            $stmt = $pdo->prepare("SELECT * FROM carnetvaccination WHERE id_c = :id_c"); // Préparer la requête
            $stmt->bindParam(':id_c', $id_c, PDO::PARAM_INT); // Lier les paramètres
            $stmt->execute(); // Exécuter la requête
    
            return $stmt->fetch(PDO::FETCH_ASSOC); // Récupérer le résultat comme un tableau associatif
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des données : " . $e->getMessage());
        }
    }
    
  
    
    






    
}
?>
