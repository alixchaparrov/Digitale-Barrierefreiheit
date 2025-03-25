<?php
/**
 * DBL CDH Theme functions and definitions
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

// Cargar archivos organizados
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/acf-blocks.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/widgets.php';
require_once get_template_directory() . '/inc/accessibility.php';
