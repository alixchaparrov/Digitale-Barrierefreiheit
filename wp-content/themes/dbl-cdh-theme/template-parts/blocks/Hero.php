<?php
$headline = get_field('hero_headline');
$description = get_field('hero_description');
$interest_buttons = get_field('interest_buttons');
?>

<section class="hero-section" role="region" aria-label="Einleitung Hero-Bereich">
  <div class="hero-content">
    <?php if ($headline = get_field('hero_headline')) : ?>
      <h1 class="hero-headline"><?= esc_html($headline) ?></h1>
    <?php endif; ?>

    <?php if ($description = get_field('hero_description')) : ?>
      <p class="hero-description"><?= esc_html($description) ?></p>
    <?php endif; ?>

    <?php if (have_rows('interest_buttons')) : ?>
      <div class="hero-buttons">
        <?php while (have_rows('interest_buttons')) : the_row(); ?>
          <?php
          $button = get_sub_field('button');
          if ($button):
            $link_url = $button['url'];
            $link_title = $button['title'];
            $link_target = $button['target'] ?: '_self';
          ?>
            <a class="hero-btn" href="<?= esc_url($link_url) ?>" target="<?= esc_attr($link_target) ?>">
              <?= esc_html($link_title) ?>
            </a>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
