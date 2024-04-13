<?php get_header();
?>
<?php
// Récupération l'id de la publication actuelle
$post_id = get_the_ID();

// Récupération des infos de l'image
$image = get_field('image');
$reference = get_field('reference');
$type = get_field('type');
$annee = get_the_date('Y');
$titre = get_the_title();

// Récupération de la catégorie + vérification de la présence d'un terme dans cette catégorie
$categories = wp_get_post_terms($post_id, 'categorie');
$categorie = $categories ? $categories[0]->name : ''; 

// Récupération du format d'image + vérification des termes
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

        <!-- MINIATURES IMAGES -->
        <div class="navigation-image">
        <?php
            // Récupération de l'ID de la publication suivante
            $next_post = get_next_post();
            if ($next_post) {
                $next_post_id = $next_post->ID;
                // Récupération des informations de l'image suivante
                $next_image = get_field('image', $next_post_id);
                ?>
                <div class="next-photo">
                    <img src="<?php echo esc_url($next_image['url']); ?>" alt="<?php echo esc_attr($next_image['alt']); ?>">
                </div>
                <?php
            }
            // Récupération de l'ID de la publication précédente
            $previous_post = get_previous_post();
            if ($previous_post) {
                $previous_post_id = $previous_post->ID;
                $previous_image = get_field('image', $previous_post_id);
                ?>
                <div class="previous-photo">
                    <img src="<?php echo esc_url($previous_image['url']); ?>" alt="<?php echo esc_attr($previous_image['alt']); ?>">
                </div>
            <?php
            } ?>

            <!-- FLECHES NAVIGATION -->
            <div class="navigation">  
                <?php 
                if (!empty($previous_post)) :                        
                    $prevArrow = get_permalink($previous_post); ?>
                    <a href="<?= $prevArrow; ?>">
                        <img id="previous-link" src="<?= get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="image précédente" />
                    </a>
                <?php endif;
                if (!empty($next_post)) :
                    $nextArrow = get_permalink($next_post); ?>
                    <a href="<?= $nextArrow; ?>">
                        <img id="next-link" src="<?= get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="image suivante" />
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>

</section>

<section class="photos-other"> 

    <div>
        <h3>Vous aimerez aussi</h3>
    </div>

    <div class="catalog">
        <?php
        // Récupération des catégories de la publication en cours / Si aucune catégorie n'est trouvée, l'ID est défini sur 0.
        $categories = wp_get_post_terms($post_id, 'categorie');
        $current_category_id = !empty($categories) ? $categories[0]->term_id : 0;
       
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
            } else { // si aucune image dans la meme catégorie, on affiche deux images au hasard
                $new_args = array(
                    'post_type' => 'image',
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                    'orderby' => 'rand', 
                );
    
                $new_query = new WP_Query($new_args);
    
                if ($new_query->have_posts()) {
                    while ($new_query->have_posts()) {
                        $new_query->the_post();
                        get_template_part('template-parts/photos-blocs');
                    }
                    wp_reset_postdata(); // réinitialisation de la requête
                }
            }?>
    </div>
</section>

<?php get_footer(); 