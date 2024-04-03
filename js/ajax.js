function load_ajax() { // Fonction pour charger les données via AJAX
    console.log('test');  
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
        'filtreOrder': order
    }

     // URL de l'interface AJAX
    const urlAjax = 'http://localhost/mota/wp-admin/admin-ajax.php'; 

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

        const catalogue = document.querySelector('#catalogue-front');
        catalogue.innerHTML = body;

    });
}

document.addEventListener("DOMContentLoaded", function () {
    load_ajax();

    const filters = document.querySelectorAll('select');

    filters.forEach(e => {
        e.addEventListener('change', function () {
            load_ajax();
        });
    }); 

})
