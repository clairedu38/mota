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

// Ajout de Select2 pour modifier la couleur des filtres selectionnés
function enqueue_select2_jquery() {
    wp_enqueue_style('select2-css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', false, null);
    wp_enqueue_script('select2-js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), null, true);
    // wp_enqueue_script('select2-init', get_template_directory_uri() . '/js/select2-init.js', array('jquery', 'select2-js'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_select2_jquery');

add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

function theme_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true);
    wp_enqueue_script( 'contact-script', get_stylesheet_directory_uri() . '/js/contact.js', array(), null, true );
    wp_enqueue_script( 'lightbox-script', get_stylesheet_directory_uri() . '/js/lightbox.js', array(), null, true );
    wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri() . '/js/ajax.js', array(), null, true );
    wp_enqueue_script( 'menu-script', get_stylesheet_directory_uri() . '/js/menuBurger.js', array(), null, true );
    wp_enqueue_script( 'images-script', get_stylesheet_directory_uri() . '/js/navSingleImages.js', array(), null, true );
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


function filter_posts() {
    $posts_per_page = 8;
    $filtreFormat = $_POST['formats'];
    $filtreCategories = $_POST['categories'];
    $filtreOrder = $_POST['filtreOrder'];

        $args = array(
            'post_type' => 'image', 
            'posts_per_page' => $posts_per_page, 
        );

        if (!empty($filtreCategories)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $filtreCategories,
            );
        }

        if (!empty($filtreFormat)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'formatimg',
                'field' => 'slug',
                'terms' => $filtreFormat,
            );
        }

        if (!empty($filtreCategories) && !empty($filtreFormat)) {
            $args['tax_query']['relation'] = 'AND';
        }


        if (!empty($filtreOrder)) {
            $args['order'] = $filtreOrder;
        }

        else {
            $args['orderby'] = 'rand';
        }


    $query = new WP_Query($args); 

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photos-blocs');
        }
        wp_reset_postdata(); // réinitialisation de la requête
    } else {
        echo 'Pas de résultats';
    }
}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');
