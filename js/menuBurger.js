document.addEventListener("DOMContentLoaded", function () {

    const menuToggle = document.getElementById('menu-toggle');
    const mainMenu = document.getElementById('main-menu');
 
    menuToggle.addEventListener('click', function () {
        if (mainMenu.classList.contains('menu-popin')) {
            mainMenu.classList.remove('menu-popin');
            mainMenu.style.display = 'none';
            menuToggle.classList.toggle('open'); // retire la classe si celle ci existe deja 
        } else {
            mainMenu.style.display = 'flex';
            setTimeout(() => { // ajoute un delai avant de lancer l'animation de 10ms
                mainMenu.classList.add('menu-popin');
                menuToggle.classList.toggle('open'); 
            }, 10);
        }
    });
    
    // Cache du menu-list lors du clic sur un lien quand on est en mobile
    const mainMenus = mainMenu.querySelectorAll('a');
   if (window.innerWidth < 700) {
        mainMenus.forEach(link => {
            link.addEventListener('click', function () {
                mainMenu.classList.remove('menu-popin'); 
                mainMenu.style.display = 'none';
                menuToggle.classList.toggle('open'); 
            });
        });
    }
 });

 