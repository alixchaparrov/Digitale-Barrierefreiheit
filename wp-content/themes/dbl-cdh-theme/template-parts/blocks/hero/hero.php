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

// Datos predeterminados para los botones de interés
$default_buttons = array(
    array(
        'text' => 'Unterstützung einer Agentur',
        'link' => '#agentur'
    ),
    array(
        'text' => 'Prüfung der Website',
        'link' => '#pruefung'
    ),
    array(
        'text' => 'barrierefreie Dokumente',
        'link' => '#dokumente'
    )
);

// Obtener botones personalizados o usar los predeterminados
$interest_buttons = get_field('interest_buttons');
if (empty($interest_buttons)) {
    $interest_buttons = $default_buttons;
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" aria-label="<?php _e('Hero Bereich', 'cdh-theme'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-8">
                <div class="hero-content">
                    <div class="hero-text">
                        <?php if ($hero_headline): ?>
                            <h1><?php echo esc_html($hero_headline); ?></h1>
                        <?php endif; ?>

                        <?php if ($hero_description): ?>
                            <div class="hero-subtitle">
                                <p><?php echo esc_html($hero_description); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (have_rows('interest_buttons')): ?>
                            <div class="interest-buttons-section">
                                <p class="interest-label"><?php _e('Wofür interessieren Sie sich?', 'cdh-theme'); ?></p>
                                <div class="interest-buttons">
                                    <?php while (have_rows('interest_buttons')): the_row();
                                        $text = get_sub_field('button_text');
                                        $link = get_sub_field('button_link');
                                        $disabled = get_sub_field('disabled');
                                    ?>
                                        <?php if ($disabled): ?>
                                            <span class="btn btn-outline-light interest-button disabled" aria-disabled="true">
                                                <?php echo esc_html($text); ?>
                                            </span>
                                        <?php else: ?>
                                            <a href="<?php echo esc_url($link); ?>"
                                                class="btn btn-outline-light interest-button"
                                                aria-label="<?php echo esc_attr($text); ?>">
                                                <?php echo esc_html($text); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="hero-cta">
                            <a href="#contact" class="btn btn-light" aria-label="<?php echo esc_attr(__('Kontakt aufnehmen', 'cdh-theme')); ?>">
                                <?php _e('Kontakt aufnehmen', 'cdh-theme'); ?>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>