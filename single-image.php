<?php get_header();
?>
<?php
// On récupère l'id de la publication actuelle
$post_id = get_the_ID();

// Récupération des infos de l'image
$image = get_field('image');
$reference = get_field('reference');
$type = get_field('type');
$annee = get_the_date('Y');
$titre = get_the_title();

// Récupération de la catégorie
$categories = wp_get_post_terms($post_id, 'categorie');
$categorie = $categories ? $categories[0]->name : ''; 
// on vérifie qu'il y ai bien un terme de cette taxonomie

// Récupération du format d'image
$formats = wp_get_post_terms($post_id, 'formatimg');
$format = $formats ? $formats[0]->name : '';
?>

<section class="infos-photo"> 
    <div class="photo">
            <div>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
            <div class="description-photo">
                <div>
                    <h2><?php echo esc_html($titre); ?></h2>
                    <h4>Référence : <span id="reference-text"><?php echo esc_html($reference); ?></span></h4>
                    <h4>Catégorie : <?php echo esc_html($categorie); ?></h4>
                    <h4>Format : <?php echo esc_html($format); ?></h4>
                    <h4>Type : <?php echo esc_html($type); ?></h4>
                    <h4>Année : <?php echo esc_html($annee); ?></h4>
                </div> 
            </div>
        </div>
    <div class="contact-photo">
        <div>
            <p>Cette photo vous intéresse ?</p>
            <div class="openmodal btn-submit">Contact</div>
        </div>
        <div class="navigation-image">
        <?php
            // Récupérer l'ID de la publication suivante
            $next_post = get_next_post();
            if ($next_post) {
                $next_post_id = $next_post->ID;
                // Récupérer les informations de l'image suivante
                $next_image = get_field('image', $next_post_id);
                ?>
                <div class="next-photo">
                    <img src="<?php echo esc_url($next_image['url']); ?>" alt="<?php echo esc_attr($next_image['alt']); ?>">
                </div>
                <?php
            }

    // Récupérer l'ID de la publication précédente
            $previous_post = get_previous_post();
            if ($previous_post) {
                $previous_post_id = $previous_post->ID;
                // Récupérer les informations de l'image précédente
                $previous_image = get_field('image', $previous_post_id);
                ?>
                <div class="previous-photo">
                    <img src="<?php echo esc_url($previous_image['url']); ?>" alt="<?php echo esc_attr($previous_image['alt']); ?>">
                </div>
                <?php
            }
            ?>

            <div class="navigation">  
                <?php previous_post_link('%link', '<img id="previous-link" src="' . esc_url(get_template_directory_uri()) . '/assets/images/arrow-left.png" alt="image précédente">'); ?>
                <?php next_post_link('%link', '<img id="next-link" src="' . esc_url(get_template_directory_uri()) . '/assets/images/arrow-right.png" alt="image suivante">'); ?>
            </div>
        </div>

    </div>
</section>

<section class="photos-autres"> 
    <div>
        <h3>Vous aimerez aussi</h3>
    </div>
    <div class="catalogue">
        <?php
        // Récupération des catégories de la publication en cours
        $categories = wp_get_post_terms($post_id, 'categorie');
        $current_category_id = !empty($categories) ? $categories[0]->term_id : 0;
        // Si aucune catégorie n'est trouvée, l'ID est défini sur 0.
        // Récupération des images de la même catégories

            $args = array(
                'post_type' => 'image',
                'post_status' => 'publish',
                'posts_per_page' => 2,
                'orderby' => 'rand',
                'post__not_in' => array( $post_id ), // ne pas prendre la publication en cours en compte
                'tax_query' => array( // filtre avec une taxonomie > ici categorie
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'term_id',
                        'terms' => array($current_category_id),
                    ),
                ),
            );

             // création d' une nouvelle instance de WP_Query
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <?php get_template_part('template-parts/photos-blocs'); ?>
                    <?php
                }
                wp_reset_postdata(); // réinitialisation de la requête
            }


        ?>
    </div>
</section>





<?php get_footer(); 