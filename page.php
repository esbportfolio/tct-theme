<?php
/**
 * The template for displaying pages (i.e. posts with the type 'page')
 * (A page is considered a type of post in WordPress)
 */

declare(strict_types=1);

get_header();

?>
            <div class="container">
<?php
if ( have_posts() ) {
	// If there are posts, create a Post Formatter object
	$post_formatter = new Tct_Post_Formatter(new Tct_Html_Helper);
    while ( have_posts() ) {
        the_post();
        echo $post_formatter->format_post(4, false);
    }
}
?>
            </div>
<?php

get_footer();