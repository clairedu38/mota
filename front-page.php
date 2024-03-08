<?php get_header(); 

$imageaccueil = get_field('image_daccueil');

?>

<section class="banner-home">
<img src="<?php echo $imageaccueil['url']; ?>" alt="<?php echo $imageaccueil['alt']; ?>">
<h1><?php the_field('titre_banniere'); ?></h1>
</section>


<h2> front page h2 </h2>
<h3> front page h3</h3>
<h4> front page description </h4>
<p> paragraphe </p>

<h2> front page h2 </h2>
<h3> front page h3</h3>
<h4> front page description </h4>
<p> paragraphe </p>

<?php get_footer(); ?>