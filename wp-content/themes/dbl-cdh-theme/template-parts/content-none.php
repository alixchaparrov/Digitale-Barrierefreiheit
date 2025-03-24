<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package dbl-cdh-theme
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nichts gefunden', 'cdh'); ?></h1>
    </header>

    <div class="page-content">
        <?php if (is_search()) : ?>
            <p><?php esc_html_e('Leider wurden keine passenden Ergebnisse gefunden. Bitte versuchen Sie es mit anderen Suchbegriffen.', 'cdh'); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Es scheint, dass wir nicht finden können, wonach Sie suchen.', 'cdh'); ?></p>
        <?php endif; ?>
    </div>
</section>