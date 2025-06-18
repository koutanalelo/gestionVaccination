<?php
	require_once("controleur/controleur.class.php");

	if (isset($_REQUEST['email']) && isset($_REQUEST['mdp'])) {
		$email = $_REQUEST['email']; 
		$mdp = $_REQUEST['mdp']; 

		$unUtilisateur = Controleur::verifConnexion($email, $mdp);
		
		if ($unUtilisateur) { 
			$tab = array(); 
			$tab['id_user'] = $unUtilisateur['id_user']; 
			$tab['nom'] = $unUtilisateur['nom']; 
			$tab['prenom'] = $unUtilisateur['prenom']; 
			$tab['email'] = $unUtilisateur['email']; 
			$tab['role'] = $unUtilisateur['role']; 
			$tab['mdp'] = $unUtilisateur['mdp']; 

			
			print("[" . json_encode($tab) . "]"); 
		} else {
			print("[]"); 
		}
	} else {
		print("[]"); 
	}
?>
