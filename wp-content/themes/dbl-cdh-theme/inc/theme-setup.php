<?php
function dbl_cdh_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets',
    ]);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('custom-line-height');
    add_theme_support('experimental-link-color');
    add_theme_support('custom-units');
    add_theme_support('editor-styles');
    add_editor_style([
        'https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        'assets/css/editor-style.css'
    ]);

    register_nav_menus([
        'primary' => esc_html__('Primary', 'cdh'),
        'footer'  => esc_html__('Footer', 'cdh'),
        'social'  => esc_html__('Social Media Menu', 'cdh'),
        'legal'   => esc_html__('Rechtliches', 'cdh'),
    ]);
}
add_action('after_setup_theme', 'dbl_cdh_setup');
