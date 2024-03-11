<?php get_header();
?>

<?php
// Récupérer l'ID de la publication actuelle
$post_id = get_the_ID();

// Utiliser WP Query pour récupérer les données de la publication
$args = array(
    'p' => $post_id, // Récupérer la publication par son ID
    'post_type' => 'image', // Type de publication personnalisé
    'post_status' => 'publish', // Publications publiées uniquement
    'posts_per_page' => 1 
);

$image_query = new WP_Query($args);
?>

<?// Boucle sur les résultats
if ($image_query->have_posts()) {
    while ($image_query->have_posts()) {
        $image_query->the_post();

        // Récupérer les informations de l'image
        $image = get_field('image');
        $reference = get_field('reference');
        $type = get_field('type');
        $annee = get_the_date('Y');

        $titre = get_the_title();

        // Récupérer les catégories (ici, une seule catégorie est prise en compte)
        $categories = wp_get_post_terms($post_id, 'categorie');
        $categorie = $categories ? $categories[0]->name : '';

        // Récupérer les formats d'image
        $formats = wp_get_post_terms($post_id, 'formatimg');
        $format = $formats ? $formats[0]->name : '';

        // Afficher les détails de l'image
        ?>

<section class="infos-photo"> 
    <div class="photo">
            <div>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            </div>
            <div class="description-photo">
                <div>
                    <h2><?php echo esc_html($titre); ?></h2>
                    <h4>Référence : <?php echo esc_html($reference); ?></h4>
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
            ?>
            <div class="navigation">
                <?php previous_post_link('%link', '<i class="fas fa-arrow-left"></i>'); ?>
                <?php next_post_link('%link', '<i class="fas fa-arrow-right"></i>'); ?>
            </div>
        </div>
    </div>
</section>

<section class="photos-autres"> 
    <div>
        <h3>Vous aimerez aussi</h3>
    </div>
    <div>
       <!-- photos apparentées -->
    </div>
</section>



<?php
    }
}
   // Réinitialiser les données de la requête
wp_reset_postdata();
?>


<?php get_footer(); 