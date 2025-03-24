<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dbl-cdh-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="topscroll">
    <?php wp_body_open(); ?>
    <div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Zum Inhalt springen', 'cdh' ); ?></a>
    
    <?php echo do_shortcode('[newsticker]'); ?>
    
    <div class="is-sticky">
			<div class="container-xxl container-fluid">
				<header id="masthead" class="site-header">
					<div class="row">
                        <div class="site-branding col-5 col-sm-4 col-md-3">
			                <?php the_custom_logo(); ?>
                        </div>
                        <div class="main-navigation col-7 col-sm-8 col-md-9">
                            <div class="row">
                                <?php
                                if (has_nav_menu('menu-top')) {
                                    wp_nav_menu(array(
                                        'container' => 'nav',
                                        'container_class' => '',
                                        'container_aria_label' => 'Oberes Menü',
                                        'theme_location' => 'menu-top',
                                        'menu_id'        => 'menu-top',
                                        'depth'          => 1,
                                        'items_wrap' => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
                                    ));
                                }
                                ?>
                                <?php
                                wp_nav_menu(
                                    array(
                                        'container' => 'nav',
                                        'container_class' => 'd-none d-xl-block',
                                        'container_aria_label' => 'Hauptmenü',
                                        'theme_location' => 'menu-primary',
                                        'menu_id'        => 'menu-primary',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
                                    )
                                );
                                ?>
                                <nav id="site-d-block d-xl-none" aria-label="Hauptmenü im Vollbild">
                                    <ul class="fullpagemenu">
                                         <li class="nav-item openmodal">
                                             <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#fullpagemenuModal">Alles im Überblick</a>
                                        </li>
                                    </ul>
                                </nav> <!-- #site-navigation -->
                            </div>
						</div>
					</div>
				</header><!-- #masthead -->
			</div>
		</div>
