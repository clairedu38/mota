<?php 
get_header(); 
$imageaccueil = get_field('image_daccueil');
?>

<section class="banner-home">
    <?php
    $args = array(
        'post_type' => 'image',
        'posts_per_page' => 1, 
        'orderby' => 'rand',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image = get_field('image');
            ?>
    <img src="<?php echo $image['url']; ?>" alt="banniere accueil">
            <?php
        }
    }
    wp_reset_postdata();
    ?>

    <h1>PHOTOGRAPHE EVENT</h1>

</section>

<section class="catalogue-photos">
    <div class="filtres">

        <div class="filtres-taxonomy">
            <!-- filtre CATEGORIE -->
            <?php 
            $categories = get_terms('categorie'); // récupération des catégories
            //print_r($categories); ?>
            <select name="category-filter" id="category">
            <option value="">Catégories</option>
            <?php 
                foreach ($categories as $category) {?>
                    <option 
                    <?php if ($categories == $category->slug) { echo "selected"; } ?> 
                    value=<?php echo $category->slug; ?>>
                        <?php echo $category->name; ?>
                    </option>;
                <?php
                }
                ?>
            </select>

            <!-- filtre FORMAT -->
            <?php
            $formats = get_terms('formatimg'); // récupération des catégories
            //  print_r($formats); ?>
            <select name="format-filter" id="format">
            <option value="">Format</option>
            <?php 
                foreach ($formats as $format) {?>
                    <option 
                    <?php if ($formats == $format->slug) { echo "selected"; } ?> 
                    value=<?php echo $format->slug; ?>>
                        <?php echo $format->name; ?>
                    </option>;
                <?php
                }
                ?>
            </select>
        </div>

        <div class="filtre-tri">
            <select name="orderby" id="orderby">
                        <option value="">Trier par</option>
                        <option value="date_desc" >à partir des plus récentes</option>
                        <option value="date_asc" >à partir des plus anciennes</option>
            </select>
        </div>
    </div>

    <div class="catalogue">
    <?php
        $args = array(
            'post_type' => 'image', 
            'orderby' => 'rand',
            'posts_per_page' => 8, 
        );

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

    <div class="more">
        <div class="btn-submit">Charger plus</div>
    </div>

</section>



<?php get_footer(); ?>