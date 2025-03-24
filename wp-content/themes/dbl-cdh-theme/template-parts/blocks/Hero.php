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
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$hero_headline = get_field('hero_headline') ?: 'Wir begleiten Energieversorger auf dem Weg ihre Website barrierefrei zu machen.';
$hero_description = get_field('hero_description') ?: 'Bald muss Ihre Website barrierefrei sein – sind Sie bereit? Die gesetzlichen Anforderungen sind komplex, die Umsetzung oft eine Herausforderung.';
$interest_buttons = get_field('interest_buttons');
$has_buttons = !empty($interest_buttons);
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" aria-label="<?php _e('Hero Section', 'cdh-theme'); ?>">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-12 position-relative">
                <div class="hero-background" role="presentation">
                    <div class="hero-overlay"></div>
                </div>
                
                <div class="hero-content container">
                    <div class="row">
                        <div class="col-md-8 col-lg-7">
                            <div class="hero-text">
                                <?php if($hero_headline): ?>
                                    <h1><?php echo $hero_headline; ?></h1>
                                <?php endif; ?>
                                
                                <?php if($hero_description): ?>
                                    <div class="hero-subtitle">
                                        <p><?php echo $hero_description; ?></p>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if($has_buttons): ?>
                                    <div class="interest-buttons">
                                        <p class="interest-label"><?php _e('Wofür interessieren Sie sich?', 'cdh-theme'); ?></p>
                                        <div class="button-container">
                                            <?php foreach($interest_buttons as $button): ?>
                                                <a href="<?php echo esc_url($button['link']); ?>" class="btn btn-outline-light interest-button" aria-label="<?php echo esc_attr($button['text']); ?>">
                                                    <?php echo esc_html($button['text']); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="hero-cta">
                                    <a href="#contact" class="btn btn-light" aria-label="<?php _e('Kontakt aufnehmen', 'cdh-theme'); ?>">
                                        <?php _e('Kontakt aufnehmen', 'cdh-theme'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>