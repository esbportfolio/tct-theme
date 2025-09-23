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
            <div class="bg-tan">
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
                    <button data-target="toggler-content" aria-controls="toggler-content" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div class="container">
                    <div id="toggler-content" class="hide" aria-hidden="true">
                        <ul>
<!-- Begin main nav walker -->
<?php
// Note: If a menu isn't found at the location below,
// wp_nav_menu falls back to the first menu created
wp_nav_menu(array(
	'menu' => tct_get_menu_id('primary-menu'),
	'container' => false,
	'items_wrap' => '%3$s',
	'walker' => new Tct_Nav_Header_Walker(new Tct_Html_Helper(), 7),
));
?>
<!-- End main nav walker -->
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
