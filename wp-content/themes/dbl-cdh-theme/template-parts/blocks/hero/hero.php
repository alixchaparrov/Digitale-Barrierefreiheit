<?php

/**
 * Hero Block Template 
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

// Buttons
$default_buttons = [

    [
        ['text' => 'Unterstützung einer Agentur', 'link' => '#agentur', 'disabled' => false, 'row' => 1],
        ['text' => 'Prüfung der Website', 'link' => '#pruefung', 'disabled' => false, 'row' => 1],
        ['text' => 'barrierefreie Dokumente', 'link' => '#dokumente', 'disabled' => false, 'row' => 1],
    ],

    [
        ['text' => 'Leichte Sprache', 'link' => '#leichtesprache', 'disabled' => false, 'row' => 2],
        ['text' => 'Erklärung zur Barrierefreiheit', 'link' => '#erklarung', 'disabled' => false, 'row' => 2],
        ['text' => 'Stadwerke Kunden', 'link' => '#stadtwerke', 'disabled' => false, 'row' => 2],
    ],

    [
        ['text' => 'BGG vs. BFSG', 'link' => '#bgg-bfsg', 'disabled' => false, 'row' => 3],
        ['text' => 'Häufige Fragen', 'link' => '#faq', 'disabled' => false, 'row' => 3],
    ],
];

$custom_buttons = [];
if (have_rows('interest_buttons')) {
    while (have_rows('interest_buttons')) {
        the_row();
        $row_number = get_sub_field('button_row') ?: 1;
        $custom_buttons[] = [
            'text' => get_sub_field('button_text'),
            'link' => get_sub_field('button_link'),
            'disabled' => get_sub_field('disabled'),
            'white_button' => get_sub_field('white_button'),
            'row' => $row_number
        ];
    }
}

$use_custom_buttons = !empty($custom_buttons);
$buttons_by_row = [1 => [], 2 => [], 3 => []];


if ($use_custom_buttons) {
    foreach ($custom_buttons as $btn) {
        if (!empty($btn['text']) && !empty($btn['link'])) {
            $row = min(max(intval($btn['row']), 1), 3);
            $buttons_by_row[$row][] = $btn;
        }
    }
} else {

    foreach ($default_buttons as $row_index => $row_buttons) {
        $row_number = $row_index + 1;
        foreach ($row_buttons as $btn) {
            $buttons_by_row[$row_number][] = $btn;
        }
    }
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" aria-labelledby="hero-title">
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

                    <nav class="interest-buttons-section" aria-labelledby="hero-interest-question">
                        <div class="interest-buttons">
                            <?php for ($row_number = 1; $row_number <= 3; $row_number++): ?>
                                <?php if (!empty($buttons_by_row[$row_number])): ?>
                                    <div class="button-row-<?php echo $row_number; ?>">
                                        <?php foreach ($buttons_by_row[$row_number] as $btn):

                                            $is_white = isset($btn['white_button']) ? $btn['white_button'] : false;


                                            if ($btn['text'] === 'BGG vs. BFSG') {
                                                $is_white = false;
                                            }

                                            $url = '';
                                            if (is_array($btn['link'])) {
                                                $url = esc_url($btn['link']['url'] ?? '');
                                            } else {
                                                $url = esc_url($btn['link']);
                                            }
                                        ?>
                                            <div class="button-container">
                                                <?php if ($btn['disabled']): ?>
                                                    <span class="interest-button disabled" aria-disabled="true">
                                                        <?php echo esc_html($btn['text']); ?>
                                                    </span>
                                                <?php else: ?>
                                                    <a href="<?php echo $url; ?>"
                                                        class="interest-button<?php echo $is_white ? ' interest-button-white' : ''; ?>"
                                                        target="_self"
                                                        role="button"
                                                        aria-pressed="false"
                                                        tabindex="0">
                                                        <?php echo esc_html($btn['text']); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </nav>

                    <div class="hero-cta">
                        <a href="#contact" class="btn btn-light"
                            aria-label="<?php esc_attr_e('Kontakt aufnehmen', 'cdh-theme'); ?>"
                            role="button">
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