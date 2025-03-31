<?php
function register_hero_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name' => 'hero',
            'title' => __('Hero', 'cdh-theme'),
            'description' => __('Ein zugänglicher Heroblock mit Design für Barrierefreiheit.', 'cdh-theme'),
            'render_template' => 'template-parts/blocks/hero/hero.php',
            'category' => 'formatting',
            'icon' => 'format-image',
            'keywords' => ['hero', 'banner', 'header'],
            'supports' => [
                'align' => true,
                'mode' => false,
                'jsx' => true,
                'anchor' => true,
            ],
            'example' => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        'hero_headline' => 'Wir begleiten Energieversorger auf dem Weg ihre Webseite barrierefrei zu machen.',
                        'is_preview' => true,
                    ]
                ]
            ]
        ]);
    }
}
add_action('acf/init', 'register_hero_block');
