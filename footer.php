<?php get_template_part( 'template-parts/contact' ); ?>

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