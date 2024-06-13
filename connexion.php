<?php
session_start();
include_once('fonctions.php');
include_once('formulaires.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Lien vers mon CSS-->
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<!--Lien du sript local-->
		<script src="js/script.js"></script>
        <title>Connexion</title>
    </head>
    
    <body style="background-image: url('image/cave1.webp'); background-size: 100% 120%; height: 100vh; background-repeat: no-repeat;">
        <nav>
			

			<?php
				// affichage du formulaire de connexion ou le menu avec le nom de la personne
				if (empty($_SESSION)) {
					?>
					<div class="center-container">
						<div class="form-container" id="formulaire-filtre">
							<?php FormulaireAuthentification(); ?>
						</div>
					</div>

					<?php
				}
				else menu();
				
				
				// test de la connexion
				if (isset($_POST['connect']) && $_POST['connect'] == 'Connexion' && isset($_POST['login']) && isset($_POST['pass'])) {
					if (authentification($_POST['login'], $_POST["pass"])){
						$_SESSION['login'] = $_POST['login'];
						if (isAdmin($_SESSION['login'])) $_SESSION["statut"] = 'admin';
						else						     $_SESSION["statut"] = 'user';
					header('Location: index.php');	

					// 1 : on ouvre le fichier
					$monfichier = fopen('acces.log', 'a+');
					
					// 2 : Ecriture dans le fichier...
					fputs($monfichier, $_POST['login']." de ".$_SERVER['REMOTE_ADDR']." à ".date('l jS \of F Y h:i:s A'));
					
					fputs($monfichier, "\n");
					
					// 3 : quand on a fini de l'utiliser, on ferme le fichier
					fclose($monfichier);
					
                } 
				
				else {
						echo "L'utilisateur n'existe pas ou alors vos identifiants ne sont pas corrects !";

						// 1 : on ouvre le fichier
						$monfichier = fopen('error.log', 'a+');

						// 2 : Ecriture dans le fichier...
						fputs($monfichier, $_POST['login']." de ".$_SERVER['REMOTE_ADDR']." à ".date('l jS \of F Y h:i:s A'));

						fputs($monfichier, "\n");

						// 3 : quand on a fini de l'utiliser, on ferme le fichier
						fclose($monfichier);
					}
				}
			?>
		</nav>
		<footer class="footer" >
			<p style="color: white;">© Copyright 2023 - 2024 H.S & M.D.S</p>
		</footer>
    </body>
</html>