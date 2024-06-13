<?php
// BDD
// etudiants: EMAIL ADRESSE INSEE
//villes: COMMUNE CP DEPT INSEE
include_once("fonctions.php");
include_once("formulaires.php");
session_start();
?>

<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<!--Lien vers mon CSS-->
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<!--Lien vers les icons Bootstrap-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
		<!--Lien Bootstrap-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
		<!--Lien du sript bootstrap-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		<!--Lien du script local-->
		<script src="js/script.js"></script>
		<title>CAVE à VIN</title>
	</head>
    <body>

        <nav>
       		<?php
				
                // affichage du formulaire de connexion ou le menu avec le nom de la personne
				if (empty($_SESSION)) {
					echo "Veuillez vous connecter";
					redirect("connexion.php", 1);
				} elseif ($_SESSION['statut'] != 'admin'){
					echo "Vous n'êtes pas autorisé à accéder à cette page.";
					redirect("index.php", 1);
				}else {
                    Menu();
                }
       		?>
        </nav>

        <aside>

			<div class="banniere">
				<div class="banniere-contenu d-flex container">

				<div class="gauche">
                    <Span class="Sous-titre">
						<?php
							// Affichage du message accueil en fonction de la connexion
							echo "<h3> Bienvenue " . $_SESSION["login"] . " sur la page d'acceuil de notre cave à vin.</h3>";
						?>
					</Span>
                    
                </div>

				  	<div class="droit">
						<img src="image/cave.jpg" alt="">
					</div>
				</div>
			</div>

            <?php
            
            if (!empty($_SESSION) && $_SESSION['statut'] === 'admin') {
            ?>
                <div class="center-container">
                    <div class="form-container">
                        <?php FormulaireChoixVin(); ?>
                    </div>
		        </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
					if (isset($_POST['ProducteurAnneeNomVin']) && isset($_POST['captcha'])) {
						//session_start(); // Démarrer la session
						$code = isset($_SESSION["code"]) ? formater_saisie($_SESSION["code"]) : ""; // Vérifier si $_SESSION['code'] existe
						if($_POST['captcha'] == $code) { // Comparer avec $code
							// Traitement de la suppression
							$ProducteurAnneeNomVin = $_POST['ProducteurAnneeNomVin'];
							list($Producteur, $Annee, $NomVin) = explode(' - ', $ProducteurAnneeNomVin);
							$result = supprimervin($Producteur,$Annee, $NomVin);
							
							// Affichage des résultats
							if ($result == 1) {
								$Vin = listervin();?>
								<div class="table-container">
									<?php 
									echo "<h4>Suppression du vin réussie.</h4>";
									afficheTableau($Vin); 
									?>
								<div><?php
							} else {
								echo "<h4>La suppression du vin a échoué.</h4>";
							}
						} else {
							echo "<h4>Le code captcha est incorrect.</h4>"; // Message en cas de code captcha incorrect
						}
					}
				}
				
            }
            
            ?>


        </aside>

		<footer class="footer">
			<p>© Copyright 2023 - 2024 M.D.S</p>
		</footer>

    </body>
</html>