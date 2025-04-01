<?php
/**
 * Template para el bloque Unterstützung (Servicios de Apoyo)
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 */


$id = 'unterstuetzung-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}


$className = 'unterstuetzung-block';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}


$title = get_field('unterstuetzung_title') ?: 'So können wir Sie unterstützen';
$subtitle = get_field('unterstuetzung_subtitle') ?: 'Von der Beratung über die Prüfung bis hin zur Umsetzung';


$default_items = [
    [
        'title' => 'Beratung zur digitalen Barrierefreiheit',
        'content' => 'Wir unterstützen Sie bei Entscheidungen rund um die digitale Barrierefreiheit. Ihr Beratungskontingent wird flexibel nach Ihren Ansprüchen vereinbart. Sie können es vielseitig einsetzen: für Design-Fragen, Fragen zur technischen Umsetzung, Strategie oder zu Organisatorischem. So erhalten Sie genau die Hilfe, die Sie brauchen im Fragen-Dschungel.',
        'cta_text' => 'Beratungsangebot anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Prüfung Ihrer Website',
        'content' => 'Wir analysieren Ihre Website auf Barrierefreiheit gemäß WCAG 2.2 Standards und liefern Ihnen einen detaillierten Bericht mit konkreten Verbesserungsvorschlägen.',
        'cta_text' => 'Prüfung anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Unterstützung beim Einholen von Angeboten',
        'content' => 'Wir helfen Ihnen bei der Erstellung von Ausschreibungen und der Bewertung von Angeboten für Projekte zur digitalen Barrierefreiheit.',
        'cta_text' => 'Unterstützung anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Technische und gestalterische Umsetzung',
        'content' => 'Unsere Experten unterstützen Sie bei der barrierefreien Gestaltung und technischen Umsetzung Ihrer Website gemäß aktueller Standards.',
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
        'content' => 'Wir erstellen und konvertieren Ihre Dokumente (PDF, Word, etc.) in barrierefreie Formate gemäß den aktuellen Anforderungen.',
        'cta_text' => 'Dokumente anfragen',
        'cta_link' => '#contact'
    ]
];
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" aria-labelledby="unterstuetzung-title">
    <div class="container">
        
        <div class="section-header">
            <?php if ($title): ?>
                <h2 id="unterstuetzung-title" class="section-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            
            <?php if ($subtitle): ?>
                <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
        
       
        <div class="unterstuetzung-accordion" role="tablist" aria-multiselectable="true">
            <?php
            
            $custom_items = false;
            if (have_rows('unterstuetzung_items')) {
                $custom_items = true;
            }
            
           
            $items = $custom_items ? [] : $default_items;
            
            if ($custom_items) {
                while (have_rows('unterstuetzung_items')) {
                    the_row();
                    $items[] = [
                        'title' => get_sub_field('item_title'),
                        'content' => get_sub_field('item_content'),
                        'cta_text' => get_sub_field('item_cta_text'),
                        'cta_link' => get_sub_field('item_cta_link')
                    ];
                }
            }
            
         
            foreach ($items as $index => $item):
                
                $accordion_id = 'accordion-' . $index . '-' . $block['id'];
                $heading_id = 'heading-' . $index . '-' . $block['id'];
                $content_id = 'content-' . $index . '-' . $block['id'];
            ?>
                <div class="accordion-item">
                    <h3 id="<?php echo esc_attr($heading_id); ?>" class="accordion-header">
                        <button class="accordion-button" 
                                id="<?php echo esc_attr($accordion_id); ?>" 
                                type="button" 
                                aria-expanded="false" 
                                aria-controls="<?php echo esc_attr($content_id); ?>"
                                data-bs-toggle="collapse" 
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
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const accordionButtons = document.querySelectorAll('.accordion-button');

        accordionButtons.forEach(function(button)
    {
        button.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);

            const contentId = this.getAttribute('aria-controls');
            const content = document.getElementById(contentId);

            if(content) {
                content.classList.toggle('active');
            }

            if(!expanded) {
                const currentContentId = contentId;
                accordionButtons.forEach(function(otherButton){
                    const otherContentId = otherButton.getAttribute('aria-controls');

                    if(otherContentId == currentContentId) {
                        return;
                    }
                    const otherContent = document.getElementById(otherContentId);
                    if(otherContent && otherContent.classList.contains('active')){
                        otherButton.setAttribute('aria-expanded', 'false');
                        otherContent.classList.remove('active');
                    }
                });
            }
        });

        button.addEventListener('keydown', function(e) {
            if(e.key === '' || e.key === 'Enter') {
                e.preventDefault();
                this.click();
            }
        });
    });
});

</script>