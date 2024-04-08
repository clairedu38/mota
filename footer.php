<?php get_template_part( 'template-parts/contact' );?>

<div class="lightbox">

  <div class="lightbox__close">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.png" alt="fermer">
  </div>

  <div class="lightbox__prev">
    <img class="previous-lightbox" src="<?= get_template_directory_uri(); ?>/assets/images/arrow-left-white.png" alt="image précédente" />
    <div>Précédente</div> 
  </div>

  <div class="lightbox__container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nathalie-13.jpeg" alt="Image full">
    <div>
        <div class="lightbox__ref">Référence de la photo</div>
        <div class="lightbox__cat">Catégorie</div>
    </div>

  </div>
  <div class="lightbox__next">
  <div>Suivante</div>
  <img class="next-lightbox" src="<?= get_template_directory_uri(); ?>/assets/images/arrow-right-white.png" alt="image suivante" />
  </div>
</div>

<footer>
    <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'container'      => false, // N'affiche pas le conteneur ul autour du menu
            'menu_class'     => 'footer-menu', 
        ));
    ?>
</footer>
</div>
<?php wp_footer(); ?> 
</body>
</html>