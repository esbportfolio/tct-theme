<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 * 
 * This should always be called inside a conditional statement, since the comments section
 * shouldn't be created if there are no comments.  Variables in this file should be scoped
 * to that conditional and should *not* be global.
 */

declare(strict_types=1);

// Retrieve comment count for the current post
$comment_count = get_comments_number(get_the_id());
$comment_text = $comment_count . ( (intval($comment_count) === 1) ? ' response' : ' responses' ) . ' on “' . get_the_title() . '”';

?>
                <div class="comments">
                    <h4>Comments</h4>
                    <p><?php echo $comment_text; ?></p>
                    <div id="comments-content">
<?php
wp_list_comments(array(
    'style' => 'div',
    'walker' => new Tct_Comment_Walker(new Tct_Html_Helper, 6),
));
?>
                    </div>
                </div>
                <div id="comment-reply">
<?php

// NOTE: You don't need the comments_open conditional to hide the comments form.
// However, we need a conditional to show the "Comments are closed" message, so we 
// might as well not call the extra function when it's not neccessary.
if ( comments_open() ) {
?>
<!-- Begin Wordpress comment form -->
<?php
    comment_form();
?>
<!-- End Wordpress comment form -->
<?php
} else {
?>
                    <p class="closed">Comments are closed</p>
<?php
}
?>
                </div>
