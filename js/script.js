/*******************************************Verification du forlulaires insertion.php****************************************************/

function verifierFormulaire() {
    var retour = false;
    var messageDiv = document.getElementById("message");
    messageDiv.innerHTML = "";

    // Récupération des valeurs des champs
    var producteur = document.getElementById("id_prod").value;
    var annee = document.getElementById("id_Annee").value;
    var couleur = document.getElementById("id_Couleur").value;
    var region = document.getElementById("id_reg").value;
    var currentYear = new Date().getFullYear();

    // Tableau pour stocker les messages d'erreur
    var errors = [];

    // Vérification du champ Producteur
    if (producteur.length > 40 || /\d/.test(producteur)) {
        errors.push("Le nom du Producteur doit pas comporter de chiffres.");
    }

    // Vérification du champ Annee
    if (isNaN(annee) || annee < 1900 || annee > currentYear) {
        errors.push("L'Annee doit être compris entre 1900 et l'année actuelle.");
    }

    // Vérification du champ Couleur
    var couleursAutorisees = ["Blanc", "Rouge", "Rosé"];
    if (!couleursAutorisees.includes(couleur)) {
        errors.push("La Couleur doit être Blanc, Rouge ou Rosé.");
    }

    // Vérification du champ Region
    var regionsAutorisees = ["Bordeaux", "Côtes du Rhone", "Sud Ouest", "Bourgogne", "Loire"];
    if (!regionsAutorisees.includes(region)) {
        errors.push("La Region doit être Bordeaux, Côtes du Rhone, Sud Ouest, Bourgogne ou Loire.");
    }

    // Affichage des erreurs ou message de succès
    if (errors.length > 0) {
        messageDiv.style.color = "red";
        messageDiv.innerHTML = errors.join("<br>");
    } else {
        messageDiv.style.color = "green";
        messageDiv.innerHTML = "Toutes les conditions sont remplies avec succès !";
        retour = true;
    }

    // Empêcher l'envoi du formulaire si des erreurs sont présentes
    return retour;
}


/*******************************Technique Ajax pour formulaire flitrer Mohamed****************************************************/
$(document).ready(function() {
    $('#filtrer-vin-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'filtrer_vin.php',
            type: 'POST',
            data: $(this).serialize() + '&ajax=1', // Ajoutez ajax=1 pour les requêtes AJAX
            success: function(data) {
                $('#resultats').html(data);
            },
            error: function() {
                alert('Erreur lors du filtrage des vins.');
            }
        });
    });
});

/***********************************VERIFICATION DU mdp  CONNEXION***************************************************************** */
function checkpass() {
    var retour= false;
    
    // Récupération des mots de passe rentré
    let MDP = document.getElementById("password");
    let Erreur = document.getElementById("Erreur");
   
    if(MDP.value.length >=7){
   
        if (MDP.value) {
            var reg = /(?=.*[a-z])(?=.*[A-Z])(?=.*[#\$\&\%\@])/; 
            
            if(resultat = reg.test(MDP.value)) {
                retour = true;
            } 
            
            else {
                Erreur.style.color = "red";
                Erreur.innerHTML = "Respecter les consignes de dureté s'il-vous-plaît";  
            }

        } 
    }
    
    else {
        Erreur.style.color = "red";
        Erreur.innerHTML = "Votre mot de passe est trop court";
    }
    
    if(retour == true){
        alert("Vous allez être rédirigé de suite");
    }
    
    return retour;
}

