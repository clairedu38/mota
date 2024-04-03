<?php 
$photo = get_field('image');
$categories = get_the_terms(get_the_ID(), 'categorie');
$reference = get_field('reference');

?>
<div class="photo-unique">
    <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>">

    <div class="photo-survol">

        <div class="survol-fullscreen" 
        data-image="<?php echo esc_attr($photo['url']); ?>"
        data-categorie="<?php foreach ( (array) $categories as $category ) { echo $category->name; } ?>"
        data-reference="<?php echo esc_attr($reference); ?>"
        data-id="<?php echo get_the_ID(); ?>">
            <img class="fullscreen" src="<?php echo get_template_directory_uri()?>/assets/images/Icon_fullscreen.png" alt="">
        </div>

        <div class="survol-oeil">
            <a href="<?php the_permalink(); ?>">
            <img class="oeil" src="<?php echo get_template_directory_uri()?>/assets/images/Icon_eye.png" alt=""></a>
        </div>

        <div class="survol-texte">
            <p class="survol-titre"><?php echo get_the_title() ?></p>
            <p class="survol-categorie"><?php foreach ( (array) $categories as $category ) {
                    echo $category->name; }?>
            </p>  
        </div>
    </div>
</div>

