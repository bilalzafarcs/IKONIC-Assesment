<?php
require_once get_template_directory() . '/inc/custom-posts.php';
require_once get_template_directory() . '/inc/custom-apis.php';
require_once get_template_directory() . '/inc/nav-walker.php';

// For Classic Editor
add_filter('use_block_editor_for_post', '__return_false');


function basic_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'basic_theme_setup');


// Script for adding Css,Js Files
function theme_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style( 'fontfam', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;family=Roboto:ital,wght@0,300;0,400;0,500;0,900;1,700&amp;display=swap', false, '1.0', 'all' );
	wp_enqueue_style( 'bootstrapcss', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css', false, '1.0', 'all' );
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', false, '1.0', 'all' );

    wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js', array('jquery'), '1.0', true); 
}
add_action('wp_enqueue_scripts', 'theme_scripts');


// Registering the Menu
function register_my_menus() {
    register_nav_menus([
        'header-menu' => __('Header Menu'),
    ]);
}
add_action('after_setup_theme', 'register_my_menus');

