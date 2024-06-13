<?php
include_once("fonctions.php");
include_once("formulaires.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    if (isset($_POST['ProducteurNomVin'])) {
        $ProducteurNomVin = $_POST['ProducteurNomVin'];
        list($Producteur, $NomVin) = explode(' - ', $ProducteurNomVin);

        $result = supprimervin($Producteur, $NomVin);
        
        if ($result == 1) {
            ob_start();
            FormulaireChoixVin();
            $formHtml = ob_get_clean();
            echo $formHtml;
        } else {
            echo "La suppression du vin a échoué.";
        }
    }
}
?>
