<?php
require_once("singleton.class.php");

class Modele {
    // Déclarer une propriété statique pour la connexion
    private static $connexion = null;

    // Méthode pour obtenir la connexion PDO
    public static function getConnexion() {
        if (self::$connexion === null) {
            try {
                // Remplace ces valeurs par les informations correctes pour ta base de données
                $hote = 'localhost';  // hôte de la base de données
                $dbname = 'gestionvaccin';  // nom de la base de données
                $user = 'root';  // utilisateur de la base de données
                $pass = '';  // mot de passe de l'utilisateur

                // Connexion à la base de données avec PDO
                self::$connexion = new PDO("mysql:host=$hote;dbname=$dbname", $user, $pass);
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pour afficher les erreurs SQL
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$connexion;
    }

    // Méthode pour exécuter une requête SQL
    public static function executerRequete($sql, $params = []) {
        $connexion = self::getConnexion(); // Utilise la méthode getConnexion pour obtenir la connexion
        try {
            $stmt = $connexion->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne les résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            echo "Erreur SQL: " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour vérifier la connexion de l'utilisateur
	public static function verifConnexion ($email, $mdp){

        $requete = "select * from utilisateur where email = :email and mdp = :mdp ;";

        $donnees = array(":email"=>$email, ":mdp"=>$mdp);

        $exec = Singleton::getInstance () -> prepare($requete);

        $exec->execute ($donnees);

        return $exec->fetch();  

    }


}
?>
