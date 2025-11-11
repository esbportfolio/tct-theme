<?php
/**
 * The template for displaying archive pages (including tag and category archives)
 */

declare(strict_types=1);

get_header();

?>
            <div class="container">
                <h1><?php printf('Results For: “%s”', get_search_query()); ?></h1>
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

if ( $wp_query->max_num_pages > 1 ) {
    get_template_part('pagination');
}
?>
            </div>
<?php

get_footer();