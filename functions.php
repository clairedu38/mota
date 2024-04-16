<?php 

// Enregistrement des menus dans WP
register_nav_menus( array(
	'header' => 'Menu Principal',
	'footer' => 'Bas de page',
) );

function theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/css/style.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true);
    wp_enqueue_script( 'contact-script', get_stylesheet_directory_uri() . '/js/contact.js', array(), null, true );
    wp_enqueue_script( 'menu-script', get_stylesheet_directory_uri() . '/js/menuBurger.js', array(), null, true );
    wp_enqueue_script( 'lightbox-script', get_stylesheet_directory_uri() . '/js/lightbox.js', array(), null, true );
    if ( is_front_page() ) {
        wp_enqueue_script( 'ajax-script', get_stylesheet_directory_uri() . '/js/ajax.js', array(), null, true );
    }    
    if ( is_single() ) {
        wp_enqueue_script( 'images-script', get_stylesheet_directory_uri() . '/js/navSingleImages.js', array(), null, true );
    }
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

// Ajout de la mention légale "tous droits réservés"
function custom_footer_menu_items($items, $args) {
    if ($args->theme_location == 'footer') {
        $items .= '<li>Tous droits réservés</li>';
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'custom_footer_menu_items', 10, 2);

// Requete pour affichage des images dans le catalogue
function filter_posts() {
    $filterFormat = $_POST['formats'];
    $filterCategories = $_POST['categories'];
    $filterOrder = $_POST['filtreOrder'];
    $posts_per_page = $_POST['posts_per_page'];

        $args = array(
            'post_type' => 'image', 
            'posts_per_page' => $posts_per_page, 
            'orderby' => 'date'
        );

        if (!empty($filterCategories)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $filterCategories,
            );
        }

        if (!empty($filterFormat)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'formatimg',
                'field' => 'slug',
                'terms' => $filterFormat,
            );
        }

        if (!empty($filterCategories) && !empty($filterFormat)) {
            $args['tax_query']['relation'] = 'AND';
        }


        if (!empty($filterOrder)) {
            $args['order'] = $filterOrder;
        }

        else {
            $args['orderby'] = 'date';
        }

    ob_start ();    

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
    $output = ob_get_clean();
    echo $output;
    wp_die ();
}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');


