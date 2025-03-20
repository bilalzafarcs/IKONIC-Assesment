<?php

function my_custom_event() {
    $labels = array(
      'name'               => _x( 'Projects', 'post type general name' ),
      'singular_name'      => _x( 'Project', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'Project' ),
      'add_new_item'       => __( 'Add New Project' ),
      'edit_item'          => __( 'Edit Project' ),
      'new_item'           => __( 'New Project' ),
      'all_items'          => __( 'All Projects' ),
      'view_item'          => __( 'View Project' ),
      'search_items'       => __( 'Search Projects' ),
      'not_found'          => __( 'No Projects found' ),
      'not_found_in_trash' => __( 'No Projects found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Projects'
  );
  
  $args = array(
      'labels'        => $labels,
      'description'   => 'Projects',
      'public'        => true,
      'show_ui'        => true,
      'capability_type'  => 'post',
      'menu_position' => 5,
      'supports'      => array( 'title' , 'thumbnail', 'editor', 'page-attributes'),
      'taxonomies'    => array('category', 'post_tag'),
      'has_archive'   => true, // Used this to enable custom archive page
      'rewrite' => array('slug' => 'projects'),
  );   
  
  register_post_type( 'projects', $args );   
  }
  add_action( 'init', 'my_custom_event' );