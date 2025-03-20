<?php
require_once get_template_directory() . '/inc/custom-posts.php';
require_once get_template_directory() . '/inc/custom-apis.php';
require_once get_template_directory() . '/inc/nav-walker.php';

// For Classic Editor
add_filter('use_block_editor_for_post', '__return_false');


function basic_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 50, 
        'width'       => 150, 
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'basic_theme_setup');


// // Script for adding Css,Js Files

function enqueue_assets() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0',false);
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', false, '1.0', 'all' );
	wp_enqueue_style( 'font-fam', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false, '1.0', 'all' );
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', false);
}
add_action('wp_enqueue_scripts', 'enqueue_assets');




// Registering the Menu
function register_my_menus() {
    register_nav_menus([
        'header-menu' => __('Header Menu'),
    ]);
}
add_action('after_setup_theme', 'register_my_menus');

