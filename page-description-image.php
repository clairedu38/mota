<?php get_header();
?>

<section class="infos-photo"> 
    <div class="photo">
        <div>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nathalie-15.jpeg" alt="Mariée et ses demoiselles d'honneur">
        </div>
        <div class="description-photo">
            <div>
                <h2>Team </br>Mariée</h2>
                    <h4>Référence : BF2400</h4>
                    <h4>Catégorie : Mariage</h4>  
                    <h4>Format : Portrait</h4>  
                    <h4>Type : numérique</h4>   
                    <h4>Année : 2022</h4>       
            </div> 
        </div>
    </div>
    <div class="contact-photo">
        <div>
            <p><?php the_field('question'); ?></p>
            <div class="openmodal btn-submit"><?php the_field('texte_bouton'); ?></div>
        </div>
        <div>
            <p>test</p>
        </div>
    </div>
</section>

<section class="photos-autres"> 
    <div>
        <h3><?php the_field('texte_photos_associees'); ?></h3>
    </div>
    <div>
       <!-- photos apparentées -->
    </div>
</section>

<?php get_footer(); ?>