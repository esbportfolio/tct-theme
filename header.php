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
                            <li><a href="#">Link 1</a></li>
                            <li><a href="#" class="active">Link 2</a></li>
                            <li class="dropdown-toggle"><a href="#">Dropdown Parent 1<span class="icon-down-dir"></span></a>
                                <ul class="dropdown">
                                    <li><a href="#">Link a</a></li>
                                    <li><a href="#">Link b</a>
                                        <ul>
                                            <li><a href="#">Link i</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-toggle"><a href="#">Link<span class="icon-down-dir"></span></a>
                                <ul class="dropdown">
                                    <li><a href="#">Link a</a></li>
                                    <li><a href="#">Link b</a>
                                        <ul>
                                            <li><a href="#">Link i</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">Link 4</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
