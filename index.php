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

    <form  class="filtres" action="" method="post">

    <?php 
    $filtreCategories = $_POST['category-filter']; 
    $filtreFormat = $_POST['format-filter']; 
    $filtreOrder = $_POST['orderby']; 
    // var_dump($filtreOrder);
    // var_dump($filtreFormat);
    // var_dump($filtreCategories); ?>
    
        <div class="filtres-taxonomy">
            <!-- filtre CATEGORIE -->
            <?php 
            $categories = get_terms('categorie'); // récupération des catégories

            //print_r($categories); ?>
            <select name="category-filter" id="category">
            <option value="">Catégories</option>
            <?php 
                foreach ($categories as $category) { ?>
                    <option <?php echo ($filtreCategories == $category->slug) ? 'selected' : ''; ?> 
                    value="<?php echo $category->slug; ?>">
                    <?php echo $category->name; ?>
                </option>
                <?php 
                } ?>
            </select>

            <!-- filtre FORMAT -->
            <?php
            $formats = get_terms('formatimg'); // récupération des catégories
            //  print_r($formats); ?>
            <select name="format-filter" id="format">
            <option value="">Format</option>
            <?php 
                foreach ($formats as $format) { ?>
                    <option <?php echo ($filtreFormat == $format->slug) ? 'selected' : ''; ?> 
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
                <option <?php selected($filtreOrder, 'DESC'); ?> value="DESC">à partir des plus récentes</option>
                <option <?php selected($filtreOrder, 'ASC'); ?> value="ASC">à partir des plus anciennes</option>
            </select>
        </div>

        <input type="submit" value="ok">

    </form>

    <div class="catalogue">
    <?php
        $args = array(
            'post_type' => 'image', 
            'posts_per_page' => 8, 
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
    ?>
    </div>

    <div class="more">
        <div class="btn-submit">Charger plus</div>
    </div>

</section>

<?php get_footer(); ?>