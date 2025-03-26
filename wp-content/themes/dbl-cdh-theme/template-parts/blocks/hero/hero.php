<?php

/**
 * Hero Block Template con estructura exacta según diseño Figma.
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

$className = 'hero-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$hero_headline = get_field('hero_headline') ?: 'Wir begleiten Energieversorger auf dem Weg ihre Website barrierefrei zu machen.';
$hero_interest_question = get_field('hero_interest_question') ?: 'Wofür interessieren Sie sich?';
$hero_description = get_field('hero_description') ?: 'Bald muss Ihre Website barrierefrei sein – sind Sie bereit? Die gesetzlichen Anforderungen sind komplex, die Umsetzung oft eine Herausforderung.';

// Botones organizados por filas según diseño Figma
$button_rows = array(
    // Primera fila - 3 botones
    array(
        array('text' => 'Unterstützung einer Agentur', 'link' => '#agentur', 'disabled' => false),
        array('text' => 'Prüfung der Website', 'link' => '#pruefung', 'disabled' => false),
        array('text' => 'barrierefreie Dokumente', 'link' => '#dokumente', 'disabled' => false),
    ),
    // Segunda fila - 3 botones
    array(
        array('text' => 'Leichte Sprache', 'link' => '#leichtesprache', 'disabled' => false),
        array('text' => 'Erklärung zur Barrierefreiheit', 'link' => '#erklarung', 'disabled' => false),
        array('text' => 'Stadwerke Kunden', 'link' => '#stadtwerke', 'disabled' => false),
    ),
    // Tercera fila - 2 botones
    array(
        array('text' => 'BGG vs. BFSG', 'link' => '#bgg-bfsg', 'disabled' => false),
        array('text' => 'Häufige Fragen', 'link' => '#faq', 'disabled' => false),
    ),
);
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" role="region" aria-labelledby="hero-title" aria-label="<?php _e('Hero Bereich', 'cdh-theme'); ?>">
    <div class="hero-red-area">
        <div class="hero-rect-shape" aria-hidden="true"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <?php if ($hero_headline): ?>
                        <h1 id="hero-title"><?php echo esc_html($hero_headline); ?></h1>
                    <?php endif; ?>

                    <?php if ($hero_interest_question): ?>
                        <h4 id="hero-interest-question" class="interest-question"><?php echo esc_html($hero_interest_question); ?></h4>
                    <?php endif; ?>

                    <nav class="interest-buttons-section" role="navigation" aria-label="<?php _e('Interessen Navigation', 'cdh-theme'); ?>">
                        <div class="interest-buttons">
                            <?php
                            // Verificar si hay botones personalizados
                            $has_custom_buttons = false;
                            if (have_rows('interest_buttons')) {
                                $has_custom_buttons = true;
                            }
                            
                            // Procesar cada fila de botones
                            foreach ($button_rows as $row_index => $row_buttons): 
                                $row_number = $row_index + 1;
                            ?>
                            <div class="button-row-<?php echo $row_number; ?>">
                                <?php 
                                if ($has_custom_buttons) {
                                    // Reset the counter for each row
                                    $button_counter = 0;
                                    
                                    // Loop through custom buttons
                                    if (have_rows('interest_buttons')) {
                                        while (have_rows('interest_buttons')) {
                                            the_row();
                                            
                                            // Only process buttons for the current row
                                            if ($button_counter < count($row_buttons) * $row_index || 
                                                $button_counter >= count($row_buttons) * ($row_index + 1)) {
                                                $button_counter++;
                                                continue;
                                            }
                                            
                                            $text = get_sub_field('button_text');
                                            $link = get_sub_field('button_link');
                                            $url = is_array($link) ? esc_url($link['url'] ?? '') : esc_url($link);
                                            $disabled = get_sub_field('disabled');
                                            $white_button = get_sub_field('white_button');
                                            
                                            // Prevenir que el botón BGG vs. BFSG sea blanco
                                            $is_white = $white_button;
                                            if ($text == 'BGG vs. BFSG') {
                                                $is_white = false;
                                            }
                                            
                                            if (!$text || !$link) {
                                                $button_counter++;
                                                continue;
                                            }
                                ?>
                                    <div class="button-container">
                                        <?php if ($disabled): ?>
                                            <span class="interest-button disabled" aria-disabled="true">
                                                <?php echo esc_html($text); ?>
                                            </span>
                                        <?php else: ?>
                                            <a href="<?php echo $url; ?>" 
                                               class="interest-button<?php echo $is_white ? ' interest-button-white' : ''; ?>" 
                                               target="_self" 
                                               role="button" 
                                               aria-pressed="false">
                                                <?php echo esc_html($text); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php
                                            $button_counter++;
                                        }
                                    }
                                } else {
                                    // Use default buttons for this row
                                    foreach ($row_buttons as $btn) {
                                        // Prevenir que el botón BGG vs. BFSG sea blanco
                                        $is_white = false;
                                        if ($btn['text'] === 'Sonstiges') {
                                            $is_white = true;
                                        }
                                ?>
                                    <div class="button-container">
                                        <?php if ($btn['disabled']): ?>
                                            <span class="interest-button disabled" aria-disabled="true">
                                                <?php echo esc_html($btn['text']); ?>
                                            </span>
                                        <?php else: ?>
                                            <a href="<?php echo esc_url($btn['link']); ?>" 
                                               class="interest-button<?php echo $is_white ? ' interest-button-white' : ''; ?>" 
                                               target="_self" 
                                               role="button" 
                                               aria-pressed="false">
                                                <?php echo esc_html($btn['text']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </nav>

                    <div class="hero-cta">
                        <a href="#contact" class="btn btn-light" aria-label="<?php echo esc_attr(__('Kontakt aufnehmen', 'cdh-theme')); ?>">
                            <?php _e('Kontakt aufnehmen', 'cdh-theme'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-white-area">
        <div class="container">
            <?php if ($hero_description): ?>
                <div class="hero-subtitle">
                    <p><?php echo esc_html($hero_description); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>