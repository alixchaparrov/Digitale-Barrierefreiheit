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
$title = get_field('title') ?: 'Hero Title';
$subtitle = get_field('subtitle') ?: 'Hero Subtitle';
$background_image = get_field('background_image');
$cta_text = get_field('cta_text') ?: 'Learn More';
$cta_url = get_field('cta_url') ?: '#';
$overlay_opacity = get_field('overlay_opacity') ?: 70;

// Accessibility enhancements
$background_alt = !empty($background_image) ? $background_image['alt'] : 'Decorative background image';
$aria_label = get_field('aria_label') ?: 'Hero section';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" aria-label="<?php echo esc_attr($aria_label); ?>">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-12 position-relative">
                <?php if( $background_image ): ?>
                    <div class="hero-background" role="img" aria-label="<?php echo esc_attr($background_alt); ?>" style="background-image: url('<?php echo esc_url($background_image['url']); ?>')">
                        <div class="hero-overlay" style="opacity: <?php echo $overlay_opacity/100; ?>"></div>
                    </div>
                <?php endif; ?>
                
                <div class="hero-content container">
                    <div class="row">
                        <div class="col-md-8 col-lg-7 col-xl-6">
                            <div class="hero-text">
                                <h1><?php echo esc_html($title); ?></h1>
                                <?php if( $subtitle ): ?>
                                    <div class="hero-subtitle">
                                        <p><?php echo $subtitle; ?></p>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if( $cta_text ): ?>
                                    <div class="hero-cta">
                                        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary" aria-label="<?php echo esc_attr($cta_text); ?>">
                                            <span><?php echo esc_html($cta_text); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>