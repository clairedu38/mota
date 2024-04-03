document.addEventListener("DOMContentLoaded", function () {

    const menuToggle = document.getElementById('menu-toggle');
    const mainMenu = document.getElementById('main-menu');
 
    menuToggle.addEventListener('click', function () {
        if (mainMenu.classList.contains('menu-popin')) {
            // Si la classe menu-popin est présente, on la retire pour cacher le menu
            mainMenu.classList.remove('menu-popin');
            mainMenu.style.display = 'none';
            menuToggle.classList.toggle('open'); // retire la classe si celle ci existe deja 
        } else {
            // Sinon, on ajoute la classe pour afficher le menu avec une animation
            mainMenu.style.display = 'flex';
            setTimeout(() => { // ajoute un delai avant de lancer l'animation de 10ms
                mainMenu.classList.add('menu-popin');
                menuToggle.classList.toggle('open');  // ajoute la classe si celle ci n'existe pas deja 
            }, 10);
        }
    });
    
    // on cache le menu-list lors du clic sur un lien
    const mainMenus = mainMenu.querySelectorAll('a');
    mainMenus.forEach(link => {
        link.addEventListener('click', function () {
            mainMenus.classList.remove('menu-popin');
            mainMenus.style.display = 'none';
            menuToggle.classList.toggle('open'); 
        });
    }); 
    
 });

 