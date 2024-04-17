<?php 
get_header(); 
?>

<section class="banner-home">
    <?php
    $args = array(
        'post_type' => 'image',
        'posts_per_page' => 1, 
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'formatimg',
                'field' => 'slug',
                'terms' => 'paysage' 
            )
        )
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

<section class="catalog-photos">

    <div class="filters">   
        <div class="filters-taxonomy">
            <!-- FILTRE CATEGORIE -->
            <?php 
            $categories = get_terms('categorie'); // récupération des catégories via ACF ?>
            
            <div class="filter" id="category-filter">
                <div class="filter-selected">
                    <div class="option-selected">Catégories</div>
                    <img class="show-more" src="<?= get_template_directory_uri(); ?>/assets/images/chevron-down-s.png" alt="chevron pour choisir catégory" />
                </div>
                <div class="filter-options">
                    <div class="option all-option">Catégories</div>
                <?php 
                    foreach ($categories as $category) { ?>
                        <div class="option">
                        <?php echo $category->name; ?> 
                    </div>
                    <?php 
                    } ?>
                </div>
            </div>

            <!-- FILTRE FORMAT -->
            <?php
            $formats = get_terms('formatimg'); // récupération des formats via ACF 
             ?>
            <div class="filter" id="format-filter">
                <div class="filter-selected">
                    <div class="option-selected">Formats</div>
                    <img class="show-more" src="<?= get_template_directory_uri(); ?>/assets/images/chevron-down-s.png" alt="chevron pour choisir catégory" />
                </div>
                <div class="filter-options">
                <div class="option all-option">Formats</div>
                <?php 
                    foreach ($formats as $format) { ?>
                        <div class="option">
                        <?php echo $format->name; ?> 
                    </div>
                    <?php 
                    } ?>
                </div>
            </div>
        </div>
    
        <!-- TRI DATE -->
        <div class="filter-tri">
            <div class="filter" id="orderby">
                <div class="filter-selected">
                    <div class="option-selected">Trier par</div>
                    <img class="show-more" src="<?= get_template_directory_uri(); ?>/assets/images/chevron-down-s.png" alt="chevron pour choisir catégory" />
                </div>
                <div class="filter-options">
                    <div class="option all-option">Trier par</div>
                    <div class="option order-option" id="DESC">à partir des plus récentes</div>
                    <div class="option order-option" id="ASC">à partir des plus anciennes</div>
                </div>
            </div>   
        </div>      
    </div>
    
    <div class="catalog catalog-front"></div>

    <div class="more">
        <div class="btn-submit load-more">Charger plus</div>
    </div>

    
</section>


<?php get_footer(); ?>