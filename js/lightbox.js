function initializeLightbox() {
    const fullscreenImages = document.querySelectorAll('.survol-fullscreen');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = document.querySelector('.lightbox__container img');
    const lightboxCategorie = document.querySelector('.lightbox__cat');
    const lightboxReference = document.querySelector('.lightbox__ref');
    const prevButton = document.querySelector('.lightbox__prev');
    const nextButton = document.querySelector('.lightbox__next');
    let currentImageIndex = 0;
    let images = [];

    fullscreenImages.forEach(function(fullscreenImage, index) {
        const imageURL = fullscreenImage.dataset.image;
        const imageCategorie = fullscreenImage.dataset.categorie;
        const imageReference = fullscreenImage.dataset.reference;
        const imageID = fullscreenImage.dataset.id;

        images.push({
            id: imageID,
            url: imageURL,
            categorie: imageCategorie,
            reference: imageReference
        });

        fullscreenImage.addEventListener('click', function() {
            currentImageIndex = index;
            showImage(currentImageIndex);
            lightbox.style.display = 'flex';
        });
    });

    function showImage(index) {
        const currentImage = images[index];
        lightboxImage.src = currentImage.url;
        lightboxCategorie.textContent = currentImage.categorie;
        lightboxReference.textContent = currentImage.reference;
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    }

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    }

    nextButton.addEventListener('click', showNextImage);
    prevButton.addEventListener('click', showPrevImage);

    const closeBtn = document.querySelector('.lightbox__close img');
    closeBtn.addEventListener('click', function() {
        lightbox.style.display = 'none';
    });
}

document.addEventListener("DOMContentLoaded", function() {
    initializeLightbox();
});