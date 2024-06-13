<?php
include_once("fonctions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CouleurRegion = $_POST['CouleurRegion'];
    list($Couleur, $Region) = explode(' - ', $CouleurRegion);
    $result = filtrerVin($Couleur, $Region);

    if (!empty($result)) {
        afficheTableau($result);
    } else {
        echo "Le filtrage des vins a échoué.";
    }
}
?>