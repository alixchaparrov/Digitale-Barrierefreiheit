<?php
/**
 * Template Inhalt Landingpage
 *
 * @package dbl-cdh-theme
 */

if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
}
?>


<section id="agentur" aria-label="Unterstützung durch Agentur" class="anchor-section py-5">
    <div class="container">
        <h2>Unterstützung einer Agentur</h2>
        <p>Hier kommt der Inhalt über die Unterstützung durch eine Agentur.</p>
    </div>
</section>

<section id="pruefung" aria-label="Prüfung der Website" class="anchor-section py-5 bg-light">
    <div class="container">
        <h2>Prüfung der Website</h2>
        <p>Hier kommt der Inhalt zur Prüfung Ihrer barrierefreien Website.</p>
    </div>
</section>

<section id="dokumente" aria-label="Barrierefreie Dokumente" class="anchor-section py-5">
    <div class="container">
        <h2>Barrierefreie Dokumente</h2>
        <p>Hier kommt der Inhalt zu barrierefreien PDFs oder Word-Dokumenten.</p>
    </div>
</section>

<section id="sprache" aria-label="Leichte Sprache" class="anchor-section py-5 bg-light">
    <div class="container">
        <h2>Leichte Sprache</h2>
        <p>Hier kommt der Inhalt zur Verwendung von Leichter Sprache auf Websites.</p>
    </div>
</section>

<section id="erklaerung" aria-label="Erklärung zur Barrierefreiheit" class="anchor-section py-5">
    <div class="container">
        <h2>Erklärung zur Barrierefreiheit</h2>
        <p>Hier kommt der Inhalt zur Barrierefreiheitserklärung.</p>
    </div>
</section>

<section id="stadtwerke" aria-label="Stadtwerke-Kunden" class="anchor-section py-5 bg-light">
    <div class="container">
        <h2>Stadtwerke-Kunden</h2>
        <p>Hier kommt der Inhalt für Stadtwerke-Kunden.</p>
    </div>
</section>

<section id="bgg" aria-label="BGG vs. BFSG" class="anchor-section py-5">
    <div class="container">
        <h2>BGG vs. BFSG</h2>
        <p>Hier kommt der Inhalt über die Unterschiede zwischen BGG und BFSG.</p>
    </div>
</section>

<section id="faq" aria-label="Häufige Fragen" class="anchor-section py-5 bg-light">
    <div class="container">
        <h2>Häufige Fragen</h2>
        <p>Hier können häufig gestellte Fragen beantwortet werden.</p>
    </div>
</section>
