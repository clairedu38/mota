
const urlAjax = 'http://localhost/mota/wp-admin/admin-ajax.php'; 
let numberPostInit = 8;

function load_ajax(postsPerPage) { // Fonction pour charger les données des filtres via AJAX
    // console.log(postsPerPage);  
    const format = document.querySelector('#format').value;
    const category = document.querySelector('#category').value;
    const order = document.querySelector('#orderby').value;
    // console.log(format);
    // console.log(category);
    // console.log(order);

    const data = {  // Données à envoyer via AJAX
        'action': 'filter_posts',
        'formats': format,
        'categories': category,
        'filtreOrder': order,
        'posts_per_page': postsPerPage
    }

    // Envoie de la requête AJAX
    fetch(urlAjax, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Cache-Control': 'no-cache',
        },
        body: new URLSearchParams(data),
    })
    .then(response => response.text()) // Récupère la réponse au format texte
    .then(body => {
        // console.log(body);

        const catalogue = document.querySelector('.catalogue-front');
        catalogue.innerHTML = body;
         // Réinitialiser la lightbox après le chargement AJAX
        initializeLightbox();
    });
}

function load_more() {
    numberPostInit += 8; 
    load_ajax(numberPostInit); 
}

document.addEventListener("DOMContentLoaded", function () {
    load_ajax(numberPostInit);

    const filters = document.querySelectorAll('select');

    filters.forEach(e => {
        e.addEventListener('change', function () {
            load_ajax(numberPostInit);
        });
    }); 

    const loadMoreBtn = document.querySelector('.load-more');
    loadMoreBtn.addEventListener('click', function () {
        load_more();
    });
})


