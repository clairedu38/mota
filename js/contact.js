// Sélectionnez le dernier élément du menu
var headerMenuItems = document.querySelectorAll('#main-menu .header-menu li');
var lastHeaderMenuItem = headerMenuItems[headerMenuItems.length - 1];

// Ajoutez la classe "contact" au dernier élément du menu
lastHeaderMenuItem.classList.add('openmodal');

document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    var modal = document.getElementById('contact-modal');

    // Get all the elements with the class "openmodal"
    var btns = document.querySelectorAll(".openmodal");

    // Add click event listener to each element with the class "openmodal"
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

jQuery(document).ready(function($){
    $("#reference-photo").val($('#reference-text').text());
});