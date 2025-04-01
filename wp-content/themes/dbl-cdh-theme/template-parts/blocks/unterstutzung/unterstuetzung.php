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
        'title' => 'Beratung zut digitalen Barrierefreiheit',
        'content' => 'Wir unterstützen Sie bei Entscheidungen rund um die digitale Barrierefreiheit. Ihre Beratungskontingent wird flexibel nach Ihren Ansprüchen vereinbart. Sie können es vielseitig einsetzen: für Design-Fragen, Fragen zur technischen Umsetzung, Strategie oder zu Organisatorischem. So erhalten Sie genau die Hilfe, die Sie brauchen im Fragen-Dschungel.',
        'cta_text' => 'Beratungsangebot anfragen',
        'cta_link' => '#contact'
    ],
    [
        'title' => 'Prüfung der Webseite',
    ]
];
