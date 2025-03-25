<?php
function dbl_cdh_scripts() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', [], '5.3.2');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap', [], null);
    wp_enqueue_style('dbl-cdh-style', get_stylesheet_uri(), ['bootstrap'], _S_VERSION);
    wp_enqueue_style('dbl-cdh-main-styles', get_template_directory_uri() . '/assets/css/main-dist.css', ['bootstrap'], _S_VERSION);

    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.2', true);
    wp_enqueue_script('dbl-cdh-main', get_template_directory_uri() . '/assets/js/main.js', ['jquery', 'bootstrap'], _S_VERSION, true);
    wp_enqueue_script('dbl-cdh-accesibility', get_template_directory_uri() . '/assets/js/accesibility.js', ['jquery'], _S_VERSION, true);
    wp_enqueue_script('dbl-cdh-hero-block', get_template_directory_uri() . '/assets/js/blocks/hero-block.js', ['jquery'], _S_VERSION, true);

    wp_localize_script('dbl-cdh-accesibility', 'accesibilityVars', [
        'skipLinkText' => __('Zum Inhalt springen', 'cdh'),
        'menuToggleText' => __('Menü', 'cdh'),
        'menuExpandText' => __('Untermenü anzeigen', 'cdh'),
        'menuCollapseText' => __('Untermenü verbergen', 'cdh'),
    ]);
}
add_action('wp_enqueue_scripts', 'dbl_cdh_scripts');

function dbl_cdh_enqueue_bootstrap_in_block_editor() {
    wp_enqueue_style('bootstrap-editor', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', [], '5.3.2');
    wp_enqueue_style('dbl-cdh-editor-styles', get_template_directory_uri() . '/assets/css/editor-style.css', ['bootstrap-editor'], _S_VERSION);
}
add_action('enqueue_block_assets', 'dbl_cdh_enqueue_bootstrap_in_block_editor');
