<?php
function dbl_cdh_widgets_init() {
    register_sidebar([
        'name' => esc_html__('Error 404', 'cdh'),
        'id' => 'error404',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);

    register_sidebar([
        'name' => esc_html__('Footer - Kontakt', 'cdh'),
        'id' => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
}
add_action('widgets_init', 'dbl_cdh_widgets_init');
