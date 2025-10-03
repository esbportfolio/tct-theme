<?php
/**
 * The template for displaying all single posts
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

// If there are comments or if comments are open, insert the comments template
if ( comments_open() || intval(get_comments_number()) > 0 ) {
	comments_template('/comments.php');
}

?>
            </div>
<?php
get_footer();