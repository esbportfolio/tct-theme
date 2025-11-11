<?php
/**
 * The template for displaying the header
 */

declare(strict_types=1);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Begin Wordpress header -->
<?php wp_head(); ?>
<!-- End Wordpress header -->
	</head>
    <body>
        <header>
            <noscript>JavaScript is currently disabled. Some features may not work as intended.</noscript>
            <div id="search-bar">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input id="search-box" class="hide noscript-show" type="search" placeholder="Search" aria-label="Value to search" value="<?php echo get_search_query(); ?>" name="s">
                    <button id="search-display" type="submit" value="Search" aria-label="Perform search">
                        <span class="icon-search"></span>
                    </button>
                </form>
            </div>
            <div class="banner">
                <div class="logo-banner">
                    <a href="<?php echo get_site_url(); ?>" class="display-max-md" aria-label="Logo, links to home page">
                        <img src="<?php echo SITE_ROOT . '/assets/img/logo_icon.png'; ?>" alt="Site logo">
                    </a>
                    <a href="<?php echo get_site_url(); ?>" class="display-min-md" aria-label="Logo, links to home page">
                        <img src="<?php echo SITE_ROOT . '/assets/img/logo_horizontal.png'; ?>" alt="Site logo">
                    </a>
                </div>
            </div>
            <nav id="primary-menu">
                <div class="toggler">
                    <!-- The default for aria-hidden must be TRUE here to support noscript. If JS is enabled, this will be changed to false when DOM is loaded. -->
                    <button class="noscript-hide" data-target="toggler-content" aria-controls="toggler-content" aria-hidden="true" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div class="container">
                    <div id="toggler-content" class="hide noscript-show">
                        <ul>
<!-- Begin main nav walker -->
<?php

if (tct_menu_has_items('primary-menu')) {
    wp_nav_menu(array(
        'menu' => tct_get_menu_id('primary-menu'),
        'container' => false,
        'items_wrap' => '%3$s',
        'walker' => new Tct_Nav_Header_Walker(new Tct_Html_Helper(), 7),
    ));
}

?>
<!-- End main nav walker -->
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
