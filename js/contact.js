// Sélectionnez le dernier élément du menu
var headerMenuItems = document.querySelectorAll('#main-menu .header-menu li');
var lastHeaderMenuItem = headerMenuItems[headerMenuItems.length - 1];

// Ajoutez la classe "contact" au dernier élément du menu
lastHeaderMenuItem.setAttribute('id', 'openmodal');

document.addEventListener("DOMContentLoaded", function() {
// Get the modal
var modal = document.getElementById('contact-modal');

// Get the button that opens the modal
var btn = document.getElementById("openmodal");


// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "flex";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
})