document.addEventListener("DOMContentLoaded", function() {
    var previousLink = document.getElementById('previous-link');
    var previousPhoto = document.querySelector('.previous-photo');
    var nextLink = document.getElementById('next-link');
    var nextPhoto = document.querySelector('.next-photo');

    previousLink.addEventListener('mouseover', function() {
        previousPhoto.style.display = 'flex';
    });

    previousLink.addEventListener('mouseout', function() {
        previousPhoto.style.display = 'none';
    });

    nextLink.addEventListener('mouseover', function() {
        nextPhoto.style.display = 'flex';
    });

    nextLink.addEventListener('mouseout', function() {
        nextPhoto.style.display = 'none';
    });
});