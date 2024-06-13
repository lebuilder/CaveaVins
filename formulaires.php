<?php
   function FormulaireAuthentification() {
    ?>
    <div class="wrapper">
        <img src="image/logo.png" style="width: 100px; height: 100px;">
        <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return checkpass();">
            <fieldset style="margin-top:10px; margin-bottom:10px;">
                <legend style="font-size:1.5rem; margin-bottom:10px;"><b>Connexion</b></legend>	
                <label style="font-size:1.2rem" for="id_email">Adresse Mail : </label>
                <input  style="width: 220px; height: 30px; margin-bottom:30px" type="email" name="login" id="id_email" placeholder="@email" required size="20" /><br />
                <label style="font-size:1.2rem" for="password">Mot de passe : </label>
                <input  style="width: 220px; height: 30px; margin-bottom:30px" type="password" name="pass" id="password" required size="10" /><br />
                <p id = "Erreur" class = "ErreurRouge"></p>
                <input style="width: 100px; height: 30px;" type="submit" name="connect" value="Connexion" />
            </fieldset>
        </form>
    </div>
    <?php 
    }

//*************************************************************Menu Mohamed**********************************************************
    function menu(){
        ?>
        <!--
            <header class="header">
            <nav class="nav container">
                <div class="navigation d-flex">

                    <div class="menu">
                        <ul>
                            <li class="nav-item"><a class="nav-link" href="index.php?action=Acceuil" title="Afficher les vin">Acceuil</a></li>
                            <li class="nav-item"><a class="nav-link" href="region.php?action=Liste vins par region" title="Liste vins par region">Liste vins par region</a></li>	
                            <li class="nav-item"><a class="nav-link" href="couleur.php?action=Liste vins par couleur" title="Couleur de vins">Liste vins par couleur</a></li>	
                            
                            <?php
                            if ($_SESSION["statut"] == "admin") {
                            ?>
                            <li class="nav-item"><a class="nav-link" href="insertion.php?action=inserer_element" title="Ajouter un Vin">Ajouter un vin</a></li>	
                            <li class="nav-item"><a class="nav-link" href="suppression.php?action=supprimer_element" title="Spprimer un element">Supprimer un élement</a></li>	
                            <li class="nav-item"><a class="nav-link" href="modification.php?action=modifier_element" title="Modifier un Vin">Modifier un Vin</a></li>	
                            
                            <li class="nav-item"><a class="nav-link" href="index.php?action=logout" title="Déconnexion">Se déconnecter</a></li>	
                            <?php
                            }
                            ?>
                        </ul>				
                    <p><a href="index.php?action=logout" title="Déconnexion">Se déconnecter</a>
                    </div>
                </div>
            </nav>
        </header>
        -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
            <div class="container-fluid">
                <b class="navbar-brand" >Cave à vin</b>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample03">
                    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                        <li class="nav-item">
                            <a class="nav-link active"  href="index.php?action=Acceuil" title="Afficher les vin">Acceuil</a>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="vins.php?action=Nos vins" title="Nos vins">Nos Vins</a></li>	

                        <?php
                        if ($_SESSION["statut"] == "admin") {
                        ?>
                            <li class="nav-item"><a class="nav-link" href="insertion.php?action=inserer_element" title="Ajouter un Vin">Ajouter un vin</a></li>	
                            <li class="nav-item"><a class="nav-link" href="insertion1.php?action=inserer_stock" title="Gerer le stock">Gerer le stock</a></li>	
                            <li class="nav-item"><a class="nav-link" href="suppression.php?action=supprimer_element" title="Spprimer un element">Supprimer un élement</a></li>	
                            <li class="nav-item"><a class="nav-link" href="modification.php?action=modifier_element" title="Modifier un Vin">Modifier un Vin</a></li>	
                        <?php
                        }
                        ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?action=logout" title="Déconnexion">Se déconnecter</a></li>
                        
                    </ul>

                </div>
            </div>
        </nav>    
    <?php
    }

//******************************************************Formulaire de Filtrer VIN Mohamed********************************************
    function FormulaireFiltrervin(){
        try {
            $madb = new PDO('sqlite:bdd/CaveAVin.db');
            $rq = "SELECT DISTINCT Couleur, Region FROM Vin";
            $resultats = $madb->query($rq);
            $Vin = $resultats->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="wrapper">
                <div class="from-box login">
                    <h3>Filtrer par rapport à la Couleur et la Region</h3>
                </div>
                <form id="filtrer-vin-form" method="post">
                    <fieldset>
                        <select style="width: 220px; height: 50px; margin-bottom:20px; margin-top:50px; display: block; margin-left: auto; margin-right: auto;" id="id_Fil" name="CouleurRegion" size="1">
                            <?php
                            foreach ($Vin as $vin) {
                                echo "<option value='" . $vin['Couleur'] .' - '. $vin['Region'] . "'>" . $vin['Couleur'] .' - '. $vin['Region'] ."</option>";
                            }
                            ?>
                        </select> </br>
                        <input type="submit" style="width: 220px; display: block; margin-left: auto; margin-right: auto;" value="Filtrer"/>
                    </fieldset>
                </form>
            </div>
            <?php
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

//*****************************************************Formulaire de Insertion VIN Mohamed********************************************
    function FormulaireAjoutvin(){
        try {
            $madb = new PDO('sqlite:bdd/CaveAVin.db');
            $madb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Requête pour obtenir les couleurs distinctes
            $rqCouleur = "SELECT DISTINCT Couleur FROM Vin";
            $resultatsCouleur = $madb->query($rqCouleur);
            $couleurs = $resultatsCouleur->fetchAll(PDO::FETCH_ASSOC);
    
            // Requête pour obtenir les régions distinctes
            $rqRegion = "SELECT DISTINCT Region FROM Vin";
            $resultatsRegion = $madb->query($rqRegion);
            $regions = $resultatsRegion->fetchAll(PDO::FETCH_ASSOC);

            $rqNomVin = "SELECT DISTINCT NomVin FROM Vin";
            $resultatsNomVin = $madb->query($rqNomVin);
            $NomVins = $resultatsNomVin->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <div class="wrapper">
            <div class="from-box login">
                <h3>Insérer un Vin dans la table vin</h3>
            </div>
            <form onsubmit="return verifierFormulaire();" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <label for="id_prod">Producteur : </label>
                    <input type="text" name="Producteur" id="id_prod" placeholder="Nom de producteur du vin" style="width: 220px; height: 30px; margin-bottom:20px;" required size="40"/><br/>
                    <label for="id_Annee">Annee : </label>
                    <input type="number" name="Annee" id="id_Annee" placeholder="Annee de production du vin" style="width: 220px; height: 30px; margin-bottom:20px;" required size="4"/><br/>
                    <label for="id_Couleur">Couleur : </label>
                    <select style="height: 30px; margin-bottom:20px;"  id="id_Couleur" name="Couleur" size="1">
                        <?php
                        // Générer la liste des options à partir des étudiants
                        
                        foreach ($couleurs as $couleur) {
                            echo "<option value='" . $couleur['Couleur'] . "'>" . $couleur['Couleur'] . "</option>";
                        }
                        ?>
                        
                    </select> </br>
                
                    <label for="id_reg">Region :</label>
                    <select style="height: 30px; margin-bottom:20px;" id="id_reg" name="Region" size="1">
                    <?php
                    foreach ($regions as $region) {
                        echo "<option value='" . $region['Region'] . "'>" . $region['Region'] . "</option>";
                    }
                    ?>
                    </select></br>

                    <label for="id_nomvin">NomVin :</label>
                    <select style="height: 30px;" id="id_nomvin" name="NomVin" size="1"> 
                    <?php
                    foreach ($NomVins as $NomVin) {
                        echo "<option value='" . $NomVin['NomVin'] . "'>" . $NomVin['NomVin'] . "</option>";
                    }
                    ?>
                    </select>

                    <input type="submit" value="Insérer"/>
                    <div id="message" style="margin-bottom: 2rem;"></div>
                </fieldset>
            </form>
        </div>

        <?php
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
    // fin FormulaireAjoutvin
    }

//******************************************************Formulaire de gestion stock Mohamed********************************************
    function FormulaireAjoutstock() {
        try {
            $madb = new PDO('sqlite:bdd/CaveAVin.db');
            $madb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour obtenir les vins
            $rq = "SELECT DISTINCT Producteur, Annee, NomVin FROM Vin";
            $resultat = $madb->query($rq);
            $Vin = $resultat->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="wrapper">
            <div class="form-box login">
                <h3>Gérer le stock dans la table vin</h3>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <label style="font-size: 1.2rem; margin-left: 50px; margin-top:20px;" for="id_quantite">Quantité: </label>
                    <input style="width: auto; height: 50px; margin-bottom:20px; margin-top:20px;" type="number" name="Quantite" id="id_quantite" placeholder="Quantité de vin" required size="40"/><br/>

                    <select style="width:  220px; height: 50px; margin-bottom:20px; margin-top:20px; display: block; margin-left: auto; margin-right: auto;" id="id_ProducteurAnneeNomVin" name="ProducteurAnneeNomVin" size="1">
                        <?php
                        foreach ($Vin as $vin) {
                            echo "<option value='" . $vin['Producteur'] .' - '. $vin['Annee'] .' - '. $vin['NomVin'] . "'>" . $vin['Producteur'] .' - '. $vin['Annee'] .' - '. $vin['NomVin'] ."</option>";
                        }
                        ?>
                    </select><br/>
                    <input style="width: 200px; height: 50px; margin-bottom:20px; display: block; margin-left: auto; margin-right: auto;" type="submit" value="Insérer"/>
                </fieldset>
            </form>
        </div>
        <?php
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

//*********************************************************Formulaire de suppression Mohamed********************************************
    function FormulaireChoixVin(){
        // Connexion à la base de données
        $madb = new PDO('sqlite:bdd/CaveAVin.db');
        // Requête pour obtenir la liste des vins
        $rq = "SELECT DISTINCT Producteur, Annee, NomVin FROM Vin";
        $resultats = $madb->query($rq);
        $Vin = $resultats->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="wrapper">
            <div class="from-box login">
                <h3>Supprimer un Vin dans la table vin</h3> 
            </div>
        
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset> 
                    <select id="id_ProducteurAnneeNomVin" style="width: 220px; height: 50px; margin-bottom:20px; margin-top:30px; display: block; margin-left: auto; margin-right: auto;" name="ProducteurAnneeNomVin" size="1">
                        <?php
                        foreach ($Vin as $vin) {
                            echo "<option value='" . $vin['Producteur'] .' - '. $vin['Annee'] .' - '. $vin['NomVin'] . "'>" . $vin['Producteur'] .' - '. $vin['Annee'] .' - '. $vin['NomVin'] ."</option>";
                        }
                        ?>
                    </select> </br>
                    <input type="text" style="width: 220px; height: 35px; margin-bottom: 20px; margin-left: 120px; margin-right: auto;" name="captcha"/>
                    <img src="./image.php" onclick="this.src='image.php?' + Math.random();" alt="captcha" style="cursor:pointer;">

                    
                    <input style="width: 220px; height: 50px; margin-bottom:20px; margin-top:20px; display: block; margin-left: auto; margin-right: auto;" type="submit" name="supprimer" value="Supprimer"/>
                </fieldset>
            </form>
        </div>
        <?php
    }


//***************************************************Formulaire de modification********************************************    
    function FormulaireModifVin(){
        try {
            $madb = new PDO('sqlite:bdd/CaveAVin.db');
            // Requête pour obtenir la liste des vins
            $rq = "SELECT DISTINCT Producteur, Annee, NomVin FROM Vin";
            $resultats = $madb->query($rq);
            $Vin = $resultats->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="wrapper">
                <div class="from-box login">
                    <h3>Modifier la quantité d'un vin</h3> 
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <fieldset>
                        <select style="width: auto; height: 50px; margin-bottom:20px; margin-top:50px; display: block; margin-left: auto; margin-right: auto;" id="id_Fil" name="choix_vin" size="1" onchange="getQuantity(this.value)">
                            <?php
                            foreach ($Vin as $vin) {
                                $value = $vin['Producteur'] . '|' . $vin['Annee'] . '|' . $vin['NomVin'];
                                echo "<option value=\"$value\">" . $vin['Producteur'] .' - '. $vin['Annee'] . ' - '. $vin['NomVin'] ."</option>";
                            }
                            ?>
                        </select> </br>
                        
                        <select style="width: auto; display: block; margin-left: auto; margin-right: auto;" name="quantite" id="quantite">
                            <!-- les options de quantité seront générées dynamiquement -->
                        </select>    

                        <input type="submit" style="width: 220px; display: block; margin-left: auto; margin-right: auto; margin-top :40px" value="Modifier"/>
                    </fieldset>
                </form>
            </div>
            <?php
            echo '<br>';
        } 
        catch (Exception $e) {
            echo "<p>Erreur lors de la connexion à la BDD: " . $e->getMessage() . "</p>";
        }
    }


?>
		
		