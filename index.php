<?php
/**
 * The main template file
 *
 * This acts as a fallback if no other templates are used.  It is also specifically used for the main blog page.
 */

declare(strict_types=1);

get_header();

?>
            <div class="container">
                <h1>All Posts</h1>
<?php
if ( have_posts() ) {
	// If there are posts, create a Post Formatter object
	$post_formatter = new Tct_Post_Formatter(new Tct_Html_Helper);
    while ( have_posts() ) {
        the_post();
        echo $post_formatter->format_post(4, true);
    }
} else {
?>
                <p>No posts yet, but check back to see what's coming soon!</p>
                <p><a href="<?php echo get_site_url(); ?>">Return Home</a></p>
<?php
}
?>
            </div>
<?php

get_footer();