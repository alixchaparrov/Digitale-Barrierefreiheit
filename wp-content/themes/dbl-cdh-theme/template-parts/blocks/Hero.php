<?php
$headline = get_field('hero_headline');
$description = get_field('hero_description');
$interest_buttons = get_field('interest_buttons');
?>

<section class="hero-section" role="region" aria-label="Einleitung Hero-Bereich">
  <div class="container hero-content">
    
    <?php if ($headline): ?>
      <h1 class="hero-headline"><?php echo esc_html($headline); ?></h1>
    <?php endif; ?>

    <?php if ($description): ?>
      <div class="hero-text">
        <p><?php echo esc_html($description); ?></p>
      </div>
    <?php endif; ?>

    <?php if ($interest_buttons): ?>
      <div class="hero-buttons">
        <?php foreach ($interest_buttons as $item): ?>
          <?php 
            if ($item['acf_fc_layout'] === 'button') {
              $link = $item['link'];
              if ($link):
                $url = esc_url($link['url']);
                $label = esc_html($link['title']);
                $target = $link['target'] ? ' target="' . esc_attr($link['target']) . '"' : '';
          ?>
                <a class="btn btn-outline-light" href="<?php echo $url; ?>"<?php echo $target; ?>>
                  <?php echo $label; ?>
                </a>
          <?php 
              endif;
            }
          ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
