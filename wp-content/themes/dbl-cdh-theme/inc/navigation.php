<?php
function dbl_cdh_nav_menu_aria_atributes($atts, $item, $args) {
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'dbl_cdh_nav_menu_aria_atributes', 10, 3);
