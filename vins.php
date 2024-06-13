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
		<title>CAVE à VIN</title>
	</head>
    <body>
        <nav>
       	  <?php 
            if (empty($_SESSION)) {
              echo "Veuillez vous connecter";
              redirect("connexion.php", 1);
            } else{
              Menu();
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

        </article>

        <main>

<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">Nos vins</h1>
      <p class="lead text-body-secondary"><b style="text-align:center; font-family:Times New Romain; font-size:2rem;">"éveillez vos sens, dégustez l'excellence."</b></p>
      <p>
        <a href="index.php#table-des-vins" class="btn btn-warning my-2">Une liste detaillée de nos vins</a>
        <a href="index.php#formulaire-filtre" class="btn btn-secondary my-2"> Une liste filtrée de nos vins</a>
      </p>
    </div>
  </div>
</section>

<div class="album py-5 bg-body-tertiary">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      
      <div class="col">
        <div class="card shadow-sm">
          <img src="image/rouge_bordeau.jpg" style="width: 420px; height: 400px;" alt="">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Rouge</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Bordeaux</button>
              </div>
              <small class="text-body-secondary"><b>450 €</b></small>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
        <img src="image/blanc_rhone.png" style="width: 420px; height: 400px;" alt="">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Blanc</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Côtes de Rhone</button>
              </div>
              <small class="text-body-secondary"><b>150 €</b></small>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
        <img src="image/rouge_bourgogne.jpg" style="width: 420px; height: 400px;" alt="">       
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary"> Vin Rouge</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Bourgogne</button>
              </div>
              <small class="text-body-secondary"><b>200 €</b></small>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card shadow-sm">
        <img src="image/blanc_loire.png" style="width: 420px; height: 400px;" alt=""> 
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Blanc</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Loire</button>
              </div>
              <small class="text-body-secondary"><b>350 €</b></small>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
        <img src="image/rose_loire.jpg" style="width: 420px; height: 400px;" alt=""> 
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Rosé</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Loire</button>
              </div>
              <small class="text-body-secondary"><b>100 €</b></small>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
        <img src="image/rose_rhone.png" style="width: 420px; height: 400px;" alt=""> 
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Rosé</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Côtes de Rhone</button>
              </div>
              <small class="text-body-secondary"><b>95.99 €</b></small>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card shadow-sm">
        <img src="image/rouge_loire.webp" style="width: 420px; height: 400px;" alt="">           
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Rouge</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Loire</button>
              </div>
              <small class="text-body-secondary"><b>84.59 €</b></small>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
        <img src="image/rose_bordeau.png" style="width: 420px; height: 400px;" alt="">           <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Rosé</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Bordeaux</button>
              </div>
              <small class="text-body-secondary"><b>300 €</b></small>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm">
        <img src="image/rouge-rhones.jpg" style="width: 400px; height: 370px;" alt="">           <div class="card-body">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Vin Rouge</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Côtes de Rhones</button>
              </div>
              <small class="text-body-secondary"><b>200 €</b></small>
            </div>
          </div>
        </div>
      </div>

      

    </div>
  </div>
</div>
</main>

  <footer class="footer">
		<p>© Copyright 2023 - 2024 M.D.S</p>
	</footer>

</body>
</html>