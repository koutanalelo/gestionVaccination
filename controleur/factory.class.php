<?php
	require_once ("Utilisateur.class.php"); 
	require_once ("Medecin.class.php"); 
	require_once ("Vaccin.class.php"); 
    require_once ("Bebe.class.php"); 
	require_once ("CarnetVaccination.class.php"); 
class Factory {
    public static function getInstance($type) {
        switch ($type) {
            case "Utilisateur":
                return new Utilisateur();
            case "Medecin":
                return new Medecin();
            case "Bebe":
                return new Bebe();
            case "Vaccin":
                return new Vaccin();
            case "CarnetVaccination":
                return new CarnetVaccination();
            default:
                throw new Exception("Type d'entité non reconnu !");
        }
    }
}
?>
