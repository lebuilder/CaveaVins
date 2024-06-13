<?php
// BDD
// etudiants: EMAIL ADRESSE INSEE
//villes: COMMUNE CP DEPT INSEE
include_once("fonctions.php");
include_once("formulaires.php");
session_start();
if (empty($_SESSION['login'])) {
    redirect("connexion.php", 1);
}
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
		<!--Lien du sript jquery-->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    	<!--Lien du sript local-->
		<script src="js/script.js"></script>
		<title>CAVE à VIN</title>
	</head>
    <body>

        <nav>
       		<?php
				// affichage du formulaire de connexion ou le menu avec le nom de la personne
				// Vérifier si l'utilisateur est connecté
				
					Menu();
					
				// Destruction de la session
				if (!empty($_GET) && isset($_GET["action"]) && $_GET["action"] == "logout") {
					$_SESSION = array();
					session_destroy();
					redirect("connexion.php", 1);
				}
				
				if (
					isset($_POST["connect"], $_POST["login"], $_POST["pass"]) && 
					!empty($_POST) && 
					$_POST["connect"] == "Connexion"
				){	#if (isset($_POST) && !empty($_POST) && $_POST["connect"] == "Connexion" && isset($_POST["login"]) && isset($_POST["pass"])) {
					if (authentification($_POST["login"], $_POST["pass"])) {
						$_SESSION["login"] = $_POST["login"];
						if (isAdmin($_SESSION["login"])) {
							$_SESSION["statut"] = "admin";
						} else {
							$_SESSION["statut"] = "user";
						}
						redirect("connexion.php", 1);
					} else {
						echo "<p>Erreur d'authentification.</p>";
					}
				}
       		?>
        </nav>

        <article>

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

			<div class="space">
				<h2 id="vins" style="text-align:center;">La liste des vins</h2>
				<?php
					$Vin = listervin();
					?>
					<div class="table-container" id="table-des-vins">
					 <?php afficheTableau($Vin); ?>
					<div>
			
			</div>

        </article>

		<aside>
		
			<div class="center-container">
			<div class="form-container" id="formulaire-filtre">
				<?php FormulaireFiltrervin(); ?>
			</div>
		   </div>

		   	<div id="resultats">
			</div>
		
		</aside>

		<footer class="footer">
			<p>© Copyright 2023 - 2024 M.D.S</p>
		</footer>

    </body>
</html>