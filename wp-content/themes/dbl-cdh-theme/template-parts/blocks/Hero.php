<?php
/**
 * Hero Block Template
 */

// Ensure direct access is blocked
if (!defined('ABSPATH')) {
    exit;
}

// Get block data
$hero_headline = get_field('hero_headline');
$hero_description = get_field('hero_description');
$interest_buttons = get_field('interest_buttons');
?>

<section class="hero-section">
    <div class="hero-content">
        <?php if ($hero_headline) : ?>
            <h1 class="hero-headline"><?php echo esc_html($hero_headline); ?></h1>
        <?php endif; ?>

        <?php if ($hero_description) : ?>
            <p class="hero-description"><?php echo esc_html($hero_description); ?></p>
        <?php endif; ?>

        <?php if ($interest_buttons) : ?>
            <div class="hero-interest-buttons">
                <?php while (have_rows('interest_buttons')) : the_row(); ?>
                    <?php 
                    $button_text = get_sub_field('button_text');
                    $button_link = get_sub_field('button_link');
                    ?>
                    <?php if ($button_text && $button_link) : ?>
                        <a href="<?php echo esc_url($button_link['url']); ?>" 
                           class="btn btn-outline-light" 
                           target="<?php echo esc_attr($button_link['target'] ? $button_link['target'] : '_self'); ?>">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>