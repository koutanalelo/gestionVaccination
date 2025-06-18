<?php
class Singleton {
    private static $unSingleton = null; 
    private $unPDO; 

    // Le constructeur est privé : pas d'instance en dehors de la classe
    private function __construct() {
        try {
            $this->unPDO = new PDO("mysql:host=localhost;dbname=gestionvaccin", "root", "");
            $this->unPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$unSingleton == null) {
            self::$unSingleton = new Singleton(); 
        }
        return self::$unSingleton; 
    }

    // Ajout de la méthode getBdd()
    public function getBdd() {
        return $this->unPDO;
    }

    public function prepare($requete) {
        return $this->unPDO->prepare($requete); 
    }
}
?>
