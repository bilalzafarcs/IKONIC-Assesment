<?php
// Registering the route
function register_projects_endpoint() {
    register_rest_route('custom/v1', '/projects/', array(
        'methods'  => 'GET',
        'callback' => 'projects_details',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'register_projects_endpoint');

// Function to get the details
function projects_details() {
    $args = array(
        'post_type'      => 'projects', 
        'posts_per_page' => -1,      
    );

    $projects_query = new WP_Query($args);
    $projects = array();

    if ($projects_query->have_posts()) {
        while ($projects_query->have_posts()) {
            $projects_query->the_post();
            
            $projects[] = array(
            'title'       => get_the_title(),
            'url'         => get_permalink(),
            'start_date'  => date('F j, Y', strtotime(get_post_meta(get_the_ID(), 'project_start_date', true))),
            'end_date'    => date('F j, Y', strtotime(get_post_meta(get_the_ID(), 'project_end_date', true))),
            );
        }
        wp_reset_postdata();
    }

    return rest_ensure_response($projects);
}
