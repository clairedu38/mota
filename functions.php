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