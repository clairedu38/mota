function initializeLightbox() {
    const fullscreenImages = document.querySelectorAll('.hover-fullscreen');
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = document.querySelector('.lightbox__container img');
    const lightboxCategory = document.querySelector('.lightbox__cat');
    const lightboxReference = document.querySelector('.lightbox__ref');
    const prevButton = document.querySelector('.lightbox__prev');
    const nextButton = document.querySelector('.lightbox__next');
    let currentImageIndex = 0;
    let images = []; // création d'un tableau vide

    fullscreenImages.forEach(function(fullscreenImage, index) {
        const imageURL = fullscreenImage.dataset.image;
        const imageCategory = fullscreenImage.dataset.category;
        const imageReference = fullscreenImage.dataset.reference;
        const imageID = fullscreenImage.dataset.id;

        images.push({
            id: imageID,
            url: imageURL,
            category: imageCategory,
            reference: imageReference
        });

        fullscreenImage.addEventListener('click', function() {
            currentImageIndex = index;
            showImage(currentImageIndex);
            lightbox.style.display = 'flex';
            lightbox.classList.add('lightbox-popin');
        });
    });

    function showImage(index) {
        if (index >= 0 && index < images.length) {
            const currentImage = images[index];
            lightboxImage.src = currentImage.url;
            lightboxCategory.textContent = currentImage.category;
            lightboxReference.textContent = currentImage.reference;
        } else {
            console.error(index);
        }
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    }

    nextButton.addEventListener('click', showNextImage);

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    }

    prevButton.addEventListener('click', showPrevImage);

    const closeBtn = document.querySelector('.lightbox__close img');
    closeBtn.addEventListener('click', function() {
        lightbox.style.display = 'none';
        lightbox.classList.remove('lightbox-popin');
    });
}

document.addEventListener("DOMContentLoaded", function() {
    initializeLightbox();
});