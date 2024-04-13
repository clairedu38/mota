// Sélectionnez le dernier élément du menu
var headerMenuItems = document.querySelectorAll('#main-menu .header-menu li');
var lastHeaderMenuItem = headerMenuItems[headerMenuItems.length - 1];

lastHeaderMenuItem.classList.add('openmodal');

document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('contact-modal');
    var btns = document.querySelectorAll(".openmodal");

    btns.forEach(function(btn) {
        btn.onclick = function() {
            modal.style.display = "flex";
        }
    });

    // fermeture de la modale quand on clique en dehors
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

// Utilisation de Jquery pour récupérer la référence de la photo et l'inclure dans le formulaire de contact
jQuery(document).ready(function($){
    $("#reference-photo").val($('#reference-text').text());
});

