<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dbl-cdh-theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php 
    // Check if this is the homepage
    if (is_front_page()) :
        // Prioritize landing page template
        get_template_part('template-parts/content', 'landingpage');
    
    // Check if it's a page
    elseif (is_page()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
    
    // Check if it's a single post
    elseif (is_single()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', get_post_type());
        endwhile;
    
    // Default blog/archive loop
    elseif (have_posts()) :
        if (is_home() && !is_front_page()) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        // Start the Loop
        while (have_posts()) :
            the_post();

            // Include the Post-Type-specific template for the content
            get_template_part('template-parts/content', get_post_type());

        endwhile;

        // Posts navigation
        the_posts_navigation();

    else :
        // If no posts found
        get_template_part('template-parts/content', 'none');

    endif;
    ?>
</main><!-- #main -->

<?php
//get_sidebar();
get_footer();