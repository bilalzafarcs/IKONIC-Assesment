<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>

</head>

<body class="d-flex flex-column min-vh-100">
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">
            <?php
            if (has_custom_logo()) {
                the_custom_logo(); 
            } else {
                echo '<span>' . get_bloginfo('name') . '</span>'; 
            }
            ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'depth'          => 2,
                'container'      => false,
                'menu_class'     => 'navbar-nav ms-auto',
                'fallback_cb'    => '__return_false',
                'walker'         => new Bootstrap_Navwalker(),
            ));
            ?>
        </div>
    </div>
</nav>



</header>
    