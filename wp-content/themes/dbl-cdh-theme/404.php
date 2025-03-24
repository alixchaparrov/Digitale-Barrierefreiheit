<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dbl-cdh-theme
 */
 get_header();
 ?>
 
 <main id="primary" class="site-main">
     <div class="container-xxl container-fluid">
         <section class="error-404 not-found">
             <div class="row">
                 <header class="page-header col-12 col-xl-9">
                     <h1 class="page-title"><?php esc_html_e('Fehler (404)', 'cdh'); ?></h1>
                     <h2>Seite konnte nicht gefunden werden</h2>
                 </header><!-- .page-header -->
                 <div class="d-none d-xl-block col-xl-3">
                     <span class="icon"></span>
                 </div>
             </div>
             <div class="row">
                 <div class="page-content col-12">
                     <?php if (is_active_sidebar('error404')) : ?>
                         <?php dynamic_sidebar('error404'); ?>
                     <?php endif; ?>
                 </div><!-- .page-content -->
             </div>
         </section><!-- .error-404 -->
     </div>
 </main><!-- #main -->
 
 <?php
 get_footer();