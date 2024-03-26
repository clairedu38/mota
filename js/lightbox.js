document.addEventListener("DOMContentLoaded", function() {
    const fullscreenImages = document.querySelectorAll('.survol-fullscreen');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = document.querySelector('.lightbox__container img');
    const lightboxCategorie = document.querySelector('.lightbox__cat');
    const lightboxReference = document.querySelector('.lightbox__ref');
    
    fullscreenImages.forEach(function(fullscreenImage) {
        fullscreenImage.addEventListener('click', function() {
            const imageURL = fullscreenImage.dataset.image;
            const imageCategorie = fullscreenImage.dataset.categorie;
            const imageReference = fullscreenImage.dataset.reference;
            // console.log("Catégorie :", imageCategorie);
            
            lightboxImage.src = imageURL; // Mettre à jour l'URL de l'image dans la lightbox
            lightboxCategorie.textContent = imageCategorie; // Mettre à jour la catégorie dans la lightbox
            lightboxReference.textContent = imageReference;
            lightbox.style.display = 'flex'; // Afficher la lightbox
        });
    });

    const closeBtn = document.querySelector('.lightbox__close img');
    closeBtn.addEventListener('click', function() {
        lightbox.style.display = 'none'; // Masquer la lightbox
    });
});