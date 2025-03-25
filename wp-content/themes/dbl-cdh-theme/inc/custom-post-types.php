<?php
function register_kunden_cpt() {
    $labels = [
        'name' => _x('Kunden', 'post type general name', 'cdh'),
        'singular_name' => _x('Kunde', 'post type singular name', 'cdh'),
        'menu_name' => _x('Kunden', 'admin menu', 'cdh'),
        'add_new' => _x('Neuen Kunden hinzufügen', 'cdh'),
        'edit_item' => __('Kunde bearbeiten', 'cdh'),
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => ['slug' => 'kunden'],
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'thumbnail'],
        'show_in_rest' => true,
    ];

    register_post_type('kunden', $args);
}
add_action('init', 'register_kunden_cpt');
