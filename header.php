<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathalie Mota</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?> 
</head>

<body>
    <div class="main-container">
        <header>
            <div class="logo-header">
            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo Nathalie"></a>
            </div>
            <nav id="main-menu">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'header',
                        'container'      => false, // N'affiche pas le conteneur ul autour du menu
                        'menu_class'     => 'header-menu', // Ajoutez des classes supplémentaires au menu
                    ));               
                ?>
            </nav>
            <button class="menu-toggle" id="menu-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
        </header>