<?php get_header(); 

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

<?php get_footer(); ?>