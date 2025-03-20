<?php
class Custom_Nav_Walker extends Walker_Nav_Menu {

function start_lvl(&$output, $depth = 0, $args = null) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class='menu-dropdown'>\n";
}

function end_lvl(&$output, $depth = 0, $args = null) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
}

function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    // Check if the menu item has children
    $has_children = in_array('menu-item-has-children', $item->classes);

    // Generate unique ID for checkboxes
    $menu_id = 'menu-' . sanitize_title($item->title);

    // Start <li> tag
    $output .= $indent . '<li' . ($has_children ? ' class="menu-hasdropdown"' : '') . '>';

    // Generate link
    $output .= '<a href="' . esc_attr($item->url) . '">' . esc_html($item->title);

    // Add dropdown toggle label if it has children
    if ($has_children) {
        $output .= ' <label title="toggle menu" for="' . $menu_id . '">';
        $output .= '<i class="fa fa-caret-down"></i>';
        $output .= '</label>';
    }

    $output .= '</a>';

    // Add hidden checkbox input for toggling dropdowns
    if ($has_children) {
        $output .= '<input type="checkbox" id="' . $menu_id . '">';
    }
}

function end_el(&$output, $item, $depth = 0, $args = null) {
    $output .= "</li>\n";
}
}
