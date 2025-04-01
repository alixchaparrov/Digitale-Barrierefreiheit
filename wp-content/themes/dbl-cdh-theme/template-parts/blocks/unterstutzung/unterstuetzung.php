<?php

/**
 * Template für Unterstützung
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param init $post_id The post ID the block is rendering content against.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'unterstuetzung-' . $block['id'];

if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'unterstuetzung-block';
if (!empty($block['className'])) {
    $className .= '' . $block['className'];
}

$title = get_field('unterstuetzung_title') ?: 'So können wir Sie unterstützen';
$subtitle = get_field('unterstuetzung_subtitle') ?: 'Von der Beratung über die Prüfung bis hin zur Umsetzung';

$default_items = [
    [
        'title' => 'Beratung zur digitalen Barrierefreiheit',
        'content' => 'Wir unterstützen Sie bei Entscheidungen rund um die digitale Barrierefreiheit. Ihre Beratungskontingent wird flexibel nach Ihren Ansprüchen vereinbart. Sie können es vielseitig einsetzen: für Design-Fragen, Fragen zur technischen Umsetzung, Strategie oder zu Organisatorischem. So erhalten Sie genau die Hilfe, die Sie brauchen im Fragen-Dschungel.',
        'cta_text' => 'Beratungsangebot anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Prüfung Ihrer Webseite',
        'content' => 'Wir analysieren Ihre Website auf Barrierefreiheit gemäß WCAG 2.2 Standards und liefern Ihnen einen detallierten Bericht mit konkreten Verbesserungsvorschlägen.',
        'cta_text' => 'Prüfung anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Unterstützung beim Einholen von Angeboten',
        'content' => 'Wir helfen Ihnen bei der Erstellung von Auschreibungen und der Bewertung von Angeboten für Projekte zur digitalen Barrierefreiheit.',
        'cta_text' => 'Unterstützung anfragen',
        'cta_link' => '#contact',
    ],
    [
        'title' => 'Technische und gestalterische Umsetzung',
        'content' => 'Unsere Experten unterstützen Sie bei der barrierefreien Gestaltung und technischen Umsetzung Ihrer Webseite gemäß aktueller Standards.',
        'cta_text' => 'Umsetzung anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Texterstellung und Leichte Sprache',
        'content' => 'Wir erstellen barrierefreie Texte und bieten Übersetzungen in Leichte Sprache für maximale Verständlichkeit.',
        'cta_text' => 'Textanfrage stellen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Barrierefreie Dokumente',
        'content' => 'Wir stellen und konvertieren Ihre Dokumente in barrierefreie Formate gemäß den aktuellen Anforderungen.',
        'cta_text' => 'Dokumente anfragen',
        'cta_link' => '#contact'
    ]
];
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" aria-labelledby="unterstutzung-title">
    <div class="container">
        <div class="section-header">
            <?php if ($title): ?>
                <h2 id="unterstutzung-title" class="section-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($subtitle): ?>
                <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
        <div class="accordion-item">
            <h3 id="<?php echo esc_attr($heading_id); ?>" class="accordeon-header">
                <button class="accordion-button"
                    id="<?php echo esc_attr($accordion_id); ?>"
                    type="button"
                    aria-expanded="false"
                    aria-controls="<?php echo esc_attr($content_id); ?>"
                    data-bs-collapse="collapse"
                    data-bs-target="#<?php echo esc_attr($content_id); ?>">
                    <span class="accordion-title"><?php echo esc_html($item['title']); ?></span>
                    <span class="accordion-icon" aria-hidden="true"></span>
                </button>
            </h3>
            <div id="<?php echo esc_attr($content_id); ?>"
                class="accordion-content"
                aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                role="region">
                <div class="content-inner">
                    <p><?php echo wp_kses_post($item['content']); ?></p>
                    <?php if (!empty($item['cta_text']) && !empty($item['cta_link'])): ?>
                        <a href="<?php echo esc_url($item['cta_link']); ?>"
                        class="cta-button"
                        aria-label="<?php echo esc_attr($item['cta_text'] . ' für ' . $item['title']); ?>">
                    <?php echo esc_html($item['cta_text']); ?>
                    </a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
                    </div>
</section>