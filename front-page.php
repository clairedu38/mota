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
    //$filtreCategories = $_POST['category-filter']; 
    // $filtreFormat = $_POST['format-filter']; 
    // $filtreOrders = $_POST['orderby']; 
    // var_dump($filtreOrder);
    // var_dump($filtreFormat);
    // var_dump($filtreCategories); 
    ?>
    
        <div class="filtres-taxonomy">
            <!-- filtre CATEGORIE -->
            <?php 
            $categories = get_terms('categorie'); // récupération des catégories

            //print_r($categories); ?>
            
            <div class="filter" id="category-filter">
                <div class="filter-selected">
                    <div class="option-selected" id="category-selected">Catégories</div>
                    <img class="show-more" id="show-category" src="<?= get_template_directory_uri(); ?>/assets/images/chevron-down-s.png" alt="chevron pour choisir catégory" />
                </div>
                <div class="filter-options">
                    <div class="option all-option">Catégories</div>
                <?php 
                    foreach ($categories as $category) { ?>
                        <div class="option category-option" id="category-<?php echo $category->slug; ?>">
                        <?php echo $category->name; ?> 
                    </div>
                    <?php 
                    } ?>
                </div>
            </div>

            <!-- filtre FORMAT -->
            <?php
            $formats = get_terms('formatimg'); // récupération des catégories
            //  print_r($formats); ?>
            <div class="filter" id="format-filter">
                <div class="filter-selected">
                    <div class="option-selected" id="format-selected">Formats</div>
                    <img class="show-more" id="show-format" src="<?= get_template_directory_uri(); ?>/assets/images/chevron-down-s.png" alt="chevron pour choisir catégory" />
                </div>
                <div class="filter-options">
                <div class="option all-option">Formats</div>
                <?php 
                    foreach ($formats as $format) { ?>
                        <div class="option format-option" id="format-<?php echo $format->slug; ?>">
                        <?php echo $format->name; ?> 
                    </div>
                    <?php 
                    } ?>
                </div>
            </div>
        </div>
    
        <div class="filtre-tri">
            <div class="filter" id="orderby">
                <div class="filter-selected">
                    <div class="option-selected" id="order-selected">Trier par</div>
                    <img class="show-more" id="show-order" src="<?= get_template_directory_uri(); ?>/assets/images/chevron-down-s.png" alt="chevron pour choisir catégory" />
                </div>
                <div class="filter-options">
                    <div class="option all-option">Trier par</div>
                    <div class="option order-option" id="DESC">à partir des plus récentes</div>
                    <div class="option order-option" id="ASC">à partir des plus anciennes</div>
                </div>
            </div>   
        </div>      
    </form>
    <div class="catalogue catalogue-front"></div>

    <div class="more">
        <div class="btn-submit load-more">Charger plus</div>
    </div>

</section>

<?php get_footer(); ?>