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
		<!--Lien du sript local-->
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
				} 
				else {
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
						<?php FormulaireAjoutvin(); ?>
					</div>
				</div>
                    
                <?php
				
				
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$Producteur = $_POST['Producteur'];
					$Annee = $_POST['Annee'];
					$Couleur = $_POST['Couleur'];
					$Region = $_POST['Region'];
					$NomVin = $_POST['NomVin'];
					$result = ajouterVin($Producteur, $Annee, $Couleur, $Region, $NomVin);
					if ($result == 1) {
						$Vin = listervin();
						?>
						<div class="table-container">
							<?php
							 echo "<h4> Insertion du vin réussie.</h4>";
					 		 afficheTableau($Vin); ?>
						<div>
						<?php
						

					} else {
						echo "<br/>";
						echo "L'ajout du vin a échoué.";
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