const urlAjax = 'http://localhost/mota/wp-admin/admin-ajax.php';
let numberPostInit = 8;

let filterOrderChoice = ""; 
let filterFormatChoice = ""; 
let filterCategoryChoice = ""; 

document.addEventListener("DOMContentLoaded", function() {
    // Gestion des filtres
    addFilterListeners();

    // Chargement des données initiales
    load_ajax(numberPostInit);

    // Gestion du chargement supplémentaire
    const loadMoreBtn = document.querySelector('.load-more');
    loadMoreBtn.addEventListener('click', load_more);
});

// Fonction pour ajouter des écouteurs d'événements sur les filtres
function addFilterListeners() {
    const filterChoices = document.querySelectorAll('.filter-selected');
    filterChoices.forEach(function(selected) {
        selected.addEventListener('click', handleFilterClick);
    });

    // Ajouter des écouteurs d'événements aux options
    const optionElements = document.querySelectorAll('.option');
    optionElements.forEach(function(option) {
        option.addEventListener('click', handleOptionClick);
    });
}

// Fonction pour gérer le clic sur les filtres
function handleFilterClick() {
    const options = this.nextElementSibling;
    const isopen = options.style.display === 'flex';

    const allFilters = document.querySelectorAll('.filter-selected');
    allFilters.forEach(function(filter) {
        filter.classList.remove('clicked'); // Supprime la classe 'clicked' de tous les éléments .filter-selected
    });

    const allOptions = document.querySelectorAll('.filter-options');
    allOptions.forEach(function(option) {
        if (option.style.display === 'flex') {
            option.style.display = 'none';
        }
    });

    if (!isopen) {
        options.style.display = 'flex';
        this.classList.add('clicked');

    } else {
        options.style.display = 'none';
        this.classList.remove('clicked');
    }
}

// Fonction pour gérer le clic sur les options
function handleOptionClick() {
    const filterOptions = document.querySelectorAll('.filter-options');
    filterOptions.forEach(function(option) {
        option.style.display = 'none';
    });

    const selectedOption = this.textContent;
    const filterParent = this.closest('.filter');
    const optionSelected = filterParent.querySelector('.option-selected');
    optionSelected.textContent = selectedOption;

    if (filterParent.id === "category-filter") {
        if (!this.classList.contains('all-option')) { // On vérifie si l'option cliquée n'est pas "Catégories"
        filterCategoryChoice = this.textContent; // Met à jour la variable avec le texte de l'option cliquée
        } else {
            filterCategoryChoice = "";
        }
    }

    if (filterParent.id === "format-filter") {
        if (!this.classList.contains('all-option')) { // On vérifie si l'option cliquée n'est pas "Catégories"
        filterFormatChoice = this.textContent; // Met à jour la variable avec le texte de l'option cliquée
        } else {
            filterFormatChoice = "";
        }
    }

    if (filterParent.id === "orderby") { // Si l'élément parent a l'id "orderby"
        if (this.id === "DESC") {
            filterOrderChoice = "DESC"; // Si l'option cliquée a l'id "DESC", définir le filtre d'ordre sur "DESC"
        } else if (this.id === "ASC") {
            filterOrderChoice = "ASC"; // Si l'option cliquée a l'id "ASC", définir le filtre d'ordre sur "ASC"
        } else {
            filterOrderChoice = "";
        }
    }

    load_ajax(numberPostInit);
}

// Fonction pour charger les données via AJAX
function load_ajax(postsPerPage) {
    let format = filterFormatChoice;
    let category = filterCategoryChoice;
    let order = filterOrderChoice;

    const data = {
        'action': 'filter_posts',
        'formats': format,
        'categories': category,
        'filtreOrder': order,
        'posts_per_page': postsPerPage
    }

    fetch(urlAjax, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Cache-Control': 'no-cache',
        },
        body: new URLSearchParams(data),
    })
    .then(response => response.text())
    .then(body => {
        const catalogue = document.querySelector('.catalogue-front');
        catalogue.innerHTML = body;
        initializeLightbox();
    });
}

// Fonction pour charger plus de données
function load_more() {
    numberPostInit += 8; 
    load_ajax(numberPostInit); 
}