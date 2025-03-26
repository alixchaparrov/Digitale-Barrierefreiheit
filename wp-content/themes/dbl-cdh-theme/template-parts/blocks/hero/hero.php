<?php

/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$hero_headline = get_field('hero_headline') ?: 'Wir begleiten Energieversorger auf dem Weg ihre Website barrierefrei zu machen.';
$hero_description = get_field('hero_description') ?: 'Bald muss Ihre Website barrierefrei sein – sind Sie bereit? Die gesetzlichen Anforderungen sind komplex, die Umsetzung oft eine Herausforderung.';

// Botones por defecto
$default_buttons = array(
    array('text' => 'Unterstützung einer Agentur', 'link' => '#agentur', 'disabled' => false),
    array('text' => 'Prüfung der Website', 'link' => '#pruefung', 'disabled' => false),
    array('text' => 'barrierefreie Dokumente', 'link' => '#dokumente', 'disabled' => false),
    array('text' => 'Leichte Sprache', 'link' => '#leichtesprache', 'disabled' => false),
    array('text' => 'Erklärung zur Barrierefreiheit', 'link' => '#erklarung', 'disabled' => false),
    array('text' => 'Stadwerke Kunden', 'link' => '#stadtwerke', 'disabled' => false),
    array('text' => 'BGG vs. BFSG', 'link' => '#bgg-bfsg', 'disabled' => false),
    array('text' => 'Häufige Fragen', 'link' => '#faq', 'disabled' => false)
);
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" role="region" aria-labelledby="hero-title" aria-label="<?php _e('Hero Bereich', 'cdh-theme'); ?>">
    <div class="hero-rect-shape" aria-hidden="true"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-8">
                <div class="hero-content">
                    <div class="hero-text">
                        <?php if ($hero_headline): ?>
                            <h1 id="hero-title"><?php echo esc_html($hero_headline); ?></h1>
                        <?php endif; ?>

                        <?php if ($hero_description): ?>
                            <div class="hero-subtitle">
                                <p><?php echo esc_html($hero_description); ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- NAV con botones de interés -->
                        <nav class="interest-buttons-section" role="navigation" aria-label="<?php _e('Interessen Navigation', 'cdh-theme'); ?>">
                            <div class="interest-buttons">
                                <?php if (have_rows('interest_buttons')): ?>
                                    <?php while (have_rows('interest_buttons')): the_row();
                                        $text = get_sub_field('button_text');
                                        $link = get_sub_field('button_link');
                                        $url = is_array($link) ? esc_url($link['url'] ?? '') : esc_url($link);
                                        $disabled = get_sub_field('disabled');

                                        if (!$text || !$link) continue;
                                    ?>
                                        <?php if ($disabled): ?>
                                            <span class="btn btn-outline-light interest-button disabled" aria-disabled="true">
                                                <?php echo esc_html($text); ?>
                                            </span>
                                        <?php else: ?>
                                            <a href="<?php echo $url; ?>" class="btn btn-outline-light interest-button" target="_self">
                                                <?php echo esc_html($text); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <?php foreach ($default_buttons as $btn): ?>
                                        <a href="<?php echo esc_url($btn['link']); ?>" class="btn btn-outline-light interest-button" target="_self">
                                            <?php echo esc_html($btn['text']); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </nav>

                        <!-- Botón de contacto -->
                        <div class="hero-cta">
                            <a href="#contact" class="btn btn-light" aria-label="<?php echo esc_attr(__('Kontakt aufnehmen', 'cdh-theme')); ?>">
                                <?php _e('Kontakt aufnehmen', 'cdh-theme'); ?>
                            </a>
                        </div>

                    </div> <!-- .hero-text -->
                </div> <!-- .hero-content -->
            </div>
        </div>
    </div>
</section>