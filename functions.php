<?php 

register_nav_menus( array(
	'header' => 'Menu Principal',
	'footer' => 'Bas de page',
) );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/css/style.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

function theme_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true);
    wp_enqueue_script( 'contact-script', get_stylesheet_directory_uri() . '/js/contact.js', array(), null, true );
    wp_enqueue_script( 'images-script', get_stylesheet_directory_uri() . '/js/images.js', array(), null, true );
}

add_action('wp_enqueue_scripts', 'add_google_fonts');

function add_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400;1,700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), null);
}

function custom_footer_menu_items($items, $args) {
    if ($args->theme_location == 'footer') {
        $items .= '<li>Tous droits réservés</li>';
    }
    return $items;
}
// Ajouter la fonction de personnalisation des éléments de menu au filtre wp_nav_menu_items
add_filter('wp_nav_menu_items', 'custom_footer_menu_items', 10, 2);
