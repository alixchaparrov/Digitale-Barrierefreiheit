<?php
/*
Plugin Name: CDH - Benutzerdefinierte Funktionen
Description: Diverse Funktionen z.B. Kommentare deaktivieren, emojis deaktivieren, SVG Upload aktivieren etc.
Version: 1.0
Author: heumann. agentur für stadtwerke (Lara Jochim)
Author URI: https://agentur-heumann.de
*/

// Sicherstellen, dass das Plugin nur innerhalb von WordPress geladen wird
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


#region Wordpress Emojis deaktivieren

function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * tinymce emoji entfernen.
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/**
 * Emoji CDN entfernen.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

        $urls = array_diff($urls, array($emoji_svg_url));
    }

    return $urls;
}

#endregion Wordpress Emojis deaktivieren


#region Kommentare deaktivieren

add_action(
    'admin_init',
    function () {
        // Weiterleitung, wenn ein Benutzer versucht, die Kommentarseite aufzurufen
        global $pagenow;

        if ($pagenow === 'edit-comments.php') {
            wp_redirect(admin_url());
            exit;
        }

        // Kommentare metabox entfernen
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

        // Kommentare aus dem Admin-Bar-Menü entfernen
        foreach (get_post_types() as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    }
);

// Bestehende Kommentare ausblenden
add_filter('comments_array', '__return_empty_array', 10, 2);

// Kommentare im Adminbereich deaktivieren
add_action(
    'admin_menu',
    function () {
        remove_menu_page('edit-comments.php');
    }
);

#endregion Kommentare deaktivieren

#region SVG Upload

// SVG Upload aktivieren, nur für Administratoren
function custom_mime_types($mimes)
{
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');

// SVG Sicherheitsüberprüfung
function check_for_svg($file)
{
    $filetype = wp_check_filetype($file['name']);
    if ($filetype['ext'] === 'svg') {
        $contents = file_get_contents($file['tmp_name']);
        // Einfacher Check, ob die Datei gültiges SVG ist
        if (strpos($contents, '<!DOCTYPE svg') !== false || strpos($contents, '<svg') !== false) {
            return $file;
        } else {
            $file['error'] = 'Invalid SVG file';
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'check_for_svg');

#endregion SVG Upload

#region Blockvorlagen deaktivieren

// Deaktiviere die Standard-Blockvorlagen, erlaube nur benutzerdefinierte
add_action('after_setup_theme', function () {
    remove_theme_support('core-block-patterns');
});

#endregion Blockvorlagen deaktivieren

#region Openverse deaktivieren

add_filter(
    'block_editor_settings_all',
    function ($settings) {
        $settings['enableOpenverseMediaCategory'] = false;

        return $settings;
    },
    10
);

#endregion Openverse deaktivieren

#region Dashboard Widgets deaktivieren

function remove_dashboard_widgets()
{
    // Entferne die Standard-Dashboard-Widgets
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Schneller Entwurf
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); // Neueste Entwürfe
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress Neuigkeiten
    remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // Weitere Neuigkeiten
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Jetzt gerade
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Aktivität
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // Eingehende Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Neueste Kommentare
    // remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // Website-Zustand
    // remove_meta_box('themeisle', 'dashboard', 'normal'); // Website-Zustand
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

#endregion Dashboard Widgets deaktivieren

#region Anzahl der Suchergebnisse

function customize_search_results_per_page($query)
{
    if (!is_admin() && $query->is_search() && $query->is_main_query()) {
        $query->set('posts_per_page', 10); // Hier die Anzahl der Suchergebnisse pro Seite angeben
    }
}
add_action('pre_get_posts', 'customize_search_results_per_page');

#endregion Anzahl der Suchergebnisse