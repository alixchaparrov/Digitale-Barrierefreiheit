<?php
/**
 * Hero-ACF-Blöck
 * 
 * @package cdh-theme
 */

if (!function_exists('register_hero_block')) {
  
    function register_hero_block() {
     
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name' => 'hero',
                'title' => __('Hero Barrierefreiheit', 'cdh-theme'),
                'description' => __('Ein zugänglicher Heroblock mit Design für Barrierefreiheit und WCAG 2.2 Konformität.', 'cdh-theme'),
                'render_template' => 'template-parts/blocks/hero/hero.php',
                'category' => 'formatting',
                'icon' => 'align-full-width',
                'keywords' => ['hero', 'banner', 'header', 'barrierefreiheit'],
                'supports' => [
                    'align' => false,
                    'mode' => false,
                    'jsx' => true,
                    'anchor' => true,
                    'customClassName' => true,
                ],
                'example' => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'hero_headline' => 'Wir begleiten Energieversorger auf dem Weg ihre Webseite barrierefrei zu machen.',
                            'hero_interest_question' => 'Wofür interessieren Sie sich?',
                            'is_preview' => true,
                        ]
                    ]
                ]
            ]);
        }
    }
    
    add_action('acf/init', 'register_hero_block');
}

/**
 * Unterstützung-ACF-Blöck
 * @package cdh-theme
 */

 if (!function_exists('register_unterstuetzung_block')) {
    
    function register_unterstuetzung_block() {
        
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name' => 'unterstuetzung',
                'title' => __('Unterstützung Accordeon', 'cdh-theme'),
                'description' => __('Ein zugänglicher Accordeon-Block für Unterstützungsleistungen mit WCAG 2.2 Konformität.', 'cdh-theme'),
                'render_template' => 'template-parts/blocks/unterstuetzung/unterstuetzung.php',
                'category' => 'formatting',
                'icon' => 'list-view',
                'keywords' => ['unterstuetzung', 'accordeon', 'services', 'hilfe', 'barrierefreiheit'],
                'supports' => [
                    'align' => false,
                    'mode' => false,
                    'jsx' => true,
                    'anchor' => true,
                    'customClassName' => true,
                ],
                'example' => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'unterstuetzung_title' => 'So können wir Sie unterstützen',
                            'unterstuetzung_subtitle' => 'Von der Beratung über die Prüfung bis hin zur Umsetzung',
                            'is_preview' => true,
                        ]
                    ]
                ]
            ]);
        }
    }
    
    add_action('acf/init', 'register_unterstuetzung_block');
}