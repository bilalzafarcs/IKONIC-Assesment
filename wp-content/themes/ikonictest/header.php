<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <header>
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'header-menu',
        'container'       => 'nav',
        'container_class' => 'menu',
        'items_wrap'      => '<ul>%3$s</ul>',
        'walker'          => new Custom_Nav_Walker(),
    ));
?>

    </header>