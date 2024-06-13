<?php
//****************Fonctions utilisées*****************************************************************
	function authentification($email,$pass){
		$retour = false ;
		$madb = new PDO('sqlite:bdd/comptes.sqlite'); 
		$email= $madb->quote($email);
		$pass = $madb->quote($pass);
		$requete = "SELECT EMAIL,PASS FROM utilisateurs WHERE EMAIL = ".$email." AND PASS = ".$pass ;
		//var_dump($requete);echo "<br/>";  	
		$resultat = $madb->query($requete);
		$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($tableau_assoc)!=0) $retour = true;	
		return $retour;
	}
	
//***************************************************************************************************
	function isAdmin($email){
		$retour = false ;
		try {
			$madb = new PDO('sqlite:bdd/comptes.sqlite'); 
			$email= $madb->quote($email);
			$requete = "SELECT STATUT FROM utilisateurs WHERE EMAIL = $email" ;
			$resultat = $madb->query($requete);
			$tableau_assoc = $resultat->fetch(PDO::FETCH_ASSOC);
			if ($tableau_assoc != null) {
				if ($tableau_assoc["STATUT"] == "admin") {
					$retour = true;
				}
				
			}
		}
		catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $retour;	
	}

//*****************************************************VIN Mohamed**********************************************
	function listervin(){
		$retour = false ;
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.db'); 
			$requete = "SELECT * FROM Vin";
			$resultat = $madb->query($requete);
			$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
			if ($tableau_assoc != null) {
				$retour = $tableau_assoc;
			}
		}
		catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $retour;	
	}

//*****************************************************Stock Mohamed**********************************************
	function listerstock(){
		$retour = false ;
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.db'); 
			$requete = "SELECT * FROM Stock_cave";
			$resultat = $madb->query($requete);
			$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
			if ($tableau_assoc != null) {
				$retour = $tableau_assoc;
			}
		}
		catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $retour;	
	}

//*****************************************************AFFICHER UN TABLEAU Mohamed**********************************************
function afficheTableau($tab){
    echo '<table>';    
    echo '<tr>'; // Les entêtes des colonnes qu'on lit dans le premier tableau par exemple
    foreach($tab[0] as $colonne => $valeur){
        echo "<th>$colonne</th>";
    }
    echo "</tr>\n";
    // Le corps de la table
    foreach($tab as $ligne){
        echo '<tr>';
        foreach($ligne as $colonne => $cellule){
            if ($colonne == 'image') {
                echo '<td><img src="' . htmlspecialchars($cellule) . '" alt="Image" style="width:100px;height:100px;"></td>';
            } else {
                echo "<td>" . htmlspecialchars($cellule) . "</td>";
            }
        }
        echo "</tr>\n";
    }
    echo '</table>';
}


//*****************************************************Filtrer la region en fontion de la couleur Mohamed**********************************************
	function filtrerVin($Couleur, $Region){
		
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.db');
			$Couleur = $madb->quote($Couleur);
			$Region = $madb->quote($Region); 
			$requete = "SELECT DISTINCT * FROM Vin WHERE Couleur = $Couleur and Region = $Region";
			$resultat = $madb->query($requete);
			
			if ($resultat) {
				return $resultat->fetchAll(PDO::FETCH_ASSOC);//Retourne les resultats de la requete
			}else{
				return [];
			}
		}
		catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
			return [];//Retourner un tableau vide en cas d'erreur	
		}
		
	}

//******************************************Ajout dans la table de vin Mohamed***********************************************************
	function ajouterVin($Producteur,$Annee,$Couleur, $Region, $NomVin){
		/* on récupère directement le code de la ville qui a été transmis dans l'attribut value de la balise <option> du formulaire
		Il n'est donc pas nécessaire de rechercher le code INSEE de la ville*/
		$retour=0;
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.db'); 
			$Producteur = $madb->quote($Producteur);
			$Annee = $madb->quote($Annee);
			$Couleur = $madb->quote($Couleur);
			$Region = $madb->quote($Region);
			$NomVin = $madb->quote($NomVin);

			// Construire l'URL de l'image
			$imageURL = 'image/' . $Couleur . '_' . $Region . '.png';
			$imageURL = $madb->quote($imageURL);

			$requete = "INSERT INTO Vin (Producteur, Annee, Couleur, Region, NomVin, image) VALUES ($Producteur, $Annee, $Couleur, $Region, $NomVin, $imageURL)";
			$resultat = $madb->exec($requete);
			if ($resultat) {
				$retour = 1;
			}
		}
		catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $retour;
	}

//******************************************Ajout dans la table stock Mohamed***********************************************************
	function ajouterstock($Quantite, $Producteur, $Annee, $NomVin) {
		$retour = 0;
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.db'); 
			$madb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// Utiliser quote pour sécuriser les entrées
			$ProducteurQuoted = $madb->quote($Producteur);
			$NomVinQuoted = $madb->quote($NomVin);
			$QuantiteQuoted = $madb->quote($Quantite);
			$AnneeQuoted = $madb->quote($Annee);
			
			// Requête pour obtenir NoVin
			$requeteNoVin = "SELECT NoVin FROM Vin WHERE Producteur = $ProducteurQuoted AND NomVin = $NomVinQuoted AND Annee = $AnneeQuoted";
			$resultatNoVin = $madb->query($requeteNoVin);
			$resultNoVin = $resultatNoVin->fetch(PDO::FETCH_ASSOC);
	
			if ($resultNoVin) {
				$NoVin = $resultNoVin['NoVin'];
				$NoVinQuoted = $madb->quote($NoVin);
				
				// Vérifier si NoVin existe déjà dans la table Stock_Cave
				$requeteCheck = "SELECT Quantite FROM Stock_Cave WHERE NoVin = $NoVinQuoted";
				$resultatCheck = $madb->query($requeteCheck);
				$resultCheck = $resultatCheck->fetch(PDO::FETCH_ASSOC);
		
				if ($resultCheck) {
					// Si NoVin existe, mettre à jour la quantité
					$newQuantite = $resultCheck['Quantite'] + $Quantite;
					$newQuantiteQuoted = $madb->quote($newQuantite);
					$requeteUpdate = "UPDATE Stock_Cave SET Quantite = $newQuantiteQuoted WHERE NoVin = $NoVinQuoted";
					$resultat = $madb->exec($requeteUpdate);
				} else {
					// Si NoVin n'existe pas, insérer une nouvelle ligne
					$requeteInsert = "INSERT INTO Stock_Cave (Quantite, NoVin) VALUES ($QuantiteQuoted, $NoVinQuoted)";
					$resultat = $madb->exec($requeteInsert);
				}
		
				if ($resultat) {
					$retour = 1;
				}
			} else {
				echo 'Erreur : Le vin correspondant n\'a pas été trouvé.';
			}
		} catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $retour;
	}
	
//*********************************************Suppression Mohamed********************************************************
	function supprimervin($Producteur,$Annee, $NomVin) {
		$retour = 0;
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.db');
			$madb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Utiliser quote pour sécuriser les entrées
			$ProducteurQuoted = $madb->quote($Producteur);
			$AnneeQuoted = $madb->quote($Annee);
			$NomVinQuoted = $madb->quote($NomVin);

			// Commencer la transaction
			$madb->beginTransaction();

			// Requête pour obtenir NoVin
			$requeteNoVin = "SELECT NoVin FROM Vin WHERE Producteur = $ProducteurQuoted AND NomVin = $NomVinQuoted AND Annee = $AnneeQuoted";
			$resultatNoVin = $madb->query($requeteNoVin);
			$resultNoVin = $resultatNoVin->fetch(PDO::FETCH_ASSOC);

			#€var_dump($resultNoVin); // Vérifier si $resultNoVin contient les données attendues

			if ($resultNoVin) {
				$NoVin = $resultNoVin['NoVin'];
				$NoVinQuoted = $madb->quote($NoVin);

				// Supprimer de Stock_Cave si NoVin existe
				$requeteDeleteStock = "DELETE FROM Stock_Cave WHERE NoVin = $NoVinQuoted";
				$madb->exec($requeteDeleteStock);

				//Supprimer de Vin
				$requeteDeleteVin = "DELETE FROM Vin WHERE NoVin = $NoVinQuoted";
				$madb->exec($requeteDeleteVin);

				// Confirmer la transaction
				$madb->commit();
				$retour = 1;
			} else {
				// Annuler la transaction si NoVin n'existe pas
				$madb->rollBack();
				echo 'Erreur : Le vin correspondant n\'a pas été trouvé.';
			}
		} catch (PDOException $e) {
			// Annuler la transaction en cas d'erreur
			if ($madb->inTransaction()) {
				$madb->rollBack();
			}
			echo 'Connexion échouée : ' . $e->getMessage();
		}
		return $retour;
	}

//**************************************Modification*************************************************************
	function modifierVin($Producteur, $Annee, $NomVin){
		$retour = 0;
				
		try {
			$madb = new PDO('sqlite:bdd/CaveAVin.bd');
			//$Vin_avant_modif = $madb->quote($Producteur);
			//$rq = "UPDATE Vin SET Producteur='$Producteur', Annee='$Annee', Couleur='$Couleur', Region='$Region', NomVin='$NomVin' WHERE Producteur='$Vin_avant_modif';";
			$resultat = $madb->exec($rq);
		} catch (Exception $e) {
			echo "Erreur de la base de donnée";
		}
		if (!empty($resultat)) {			
			$retour = 1;
		}
			
		return $retour;
	}


//*********************************************Redirection Mohamed********************************************************
	function redirect($url,$tps){
		$temps = $tps * 1000;
		
		echo "<script type=\"text/javascript\">\n"
		. "<!--\n"
		. "\n"
		. "function redirect() {\n"
		. "window.location='" . $url . "'\n"
		. "}\n"
		. "setTimeout('redirect()','" . $temps ."');\n"
		. "\n"
		. "// -->\n"
		. "</script>\n";
		
	}

//*********************************************captcha Mohamed********************************************************
	function formater_saisie($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>