<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="content">
<?php the_content(); ?>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>