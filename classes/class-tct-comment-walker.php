<?php
/**
 * Walker for comment output. Extended from Walker_Comment.
 */

declare(strict_types=1);

class Tct_Comment_Walker extends Walker_Comment {

    // Dependency injection
    public function __construct(protected Tct_Html_Helper $html_helper, protected int $base_indent = 0) {}

    private function format_comment_reply_link(WP_Comment $comment): string {
        /**
         * Format anchor tag for comment reply link
         * 
         * @param WP_Comment            $comment            WP_Comment object for current element.
         * 
         * @return string               Returns a formatted anchor tag with a reply link.
         */

        // Get basic data about comment and post
        $comment_id = $comment->comment_ID;
        $post_id = $comment->comment_post_ID;
        $comment_author = $comment->comment_author;

        // Build the href
        $href = sprintf(
            '%s?replytocom=%s#respond', 
            get_permalink($post_id),
            $comment_id
        );

        // Create the attributes
        $attr = array(
            'rel' => 'nofollow',
            'href' => $href,
            'data-commentid' => $comment_id,
            'data-postid' => $post_id,
            'data-belowelement' => sprintf('comment-%s', $comment_id),
            'data-respondelement' => 'respond',
            'data-replyto' => sprintf('Reply to %s', $comment_author),
            'aria-label' => sprintf('Reply to %s', $comment_author)
        );

        // Return the formatted string
        return $this->html_helper->create_html_tag(
            tag_type: 'a',
            inner_html: 'Reply',
            classes: array('comment-reply-link'), // comment-reply-link is what WP JS uses to identify links
            attr: $attr,
        );

    }

    private function format_comment_edit_link(WP_Comment $comment): string {
        /**
         * Format anchor tag for comment edit link
         * 
         * @param WP_Comment            $comment            WP_Comment object for current element.
         * 
         * @return string               Returns a formatted anchor tag with a reply link.
         */

        // Build the href
        $href = sprintf(
            '%scomment.php?action=editcomment&amp;c=%s', 
            get_admin_url(),
            $comment->comment_ID
        );

        // Return the formatted string
        return $this->html_helper->create_html_tag(
            tag_type: 'a',
            inner_html: 'Edit',
            attr: array(
                'href' => $href,
                'target' => '_self',
            ),
        );
    }

    private function format_edit_reply(WP_Comment $data_object, int $depth, array $args, bool $user_can_edit): string {
        /**
         * Format edit / reply line
         * 
         * @param object                $data_object        WP_Comment object for current element.
         * @param int                   $depth              Current depth of walker. Starts at 0 for level of first items.
         * @param array                 $args               Arguments as an associative array.
         * @param bool                  $user_can_edit      Whether the current user can edit the current comment
         * 
         * @return string               Returns formatted HTML for an edit / reply line or string if not applicable
         */

        // Default condition is not to show edit / reply line
        $show_edit_reply = false;
        $edit_reply_line = '';

        // Create an edit link if applicable
        $edit_link = '';
        if ( $user_can_edit ) {
            $edit_link = $this->format_comment_edit_link($data_object);
            $show_edit_reply = true;
        }

        
        // Create a reply link if comments are open and we haven't reached the maximum allowed nesting
        $reply_link = '';
        if ( comments_open($data_object->comment_post_ID) && $depth < $args['max_depth'] - 1 ) {
            $reply_link = $this->format_comment_reply_link($data_object);
            $show_edit_reply = true;
        }

        if ($show_edit_reply) {
            $edit_reply_line = $this->html_helper->create_html_tag(
                tag_type: 'div',
                inner_html: $edit_link . $reply_link,
                classes: array('reply'),
            );
        }

        return str_repeat(T, $this->base_indent + $depth + 1) . $edit_reply_line . N;

    }

    private function format_comment_data(WP_Comment $data_object, int $depth, array $args, bool $user_can_edit, bool $user_owns_comment = false): array {
        /**
         * Format comment data
         * 
         * @param object                $data_object        WP_Comment object for current element.
         * @param int                   $depth              Current depth of walker. Starts at 0 for level of first items.
         * @param array                 $args               Arguments as an associative array.
         * @param bool                  $user_can_edit      Whether the current user can edit the current comment
         * @param string                $color_flag         Alternate color flag for container div (alters some colors of comment elements)
         * 
         * @return array                Returns array of formatted HTML elements
         */
        
        // Set default author conditions and modify if author is logged in
        $author_classes = array('author');
        $login_indicator = '';
        if ($user_owns_comment) {
            $author_classes[] = 'current-user';
            $login_indicator = ' <span class="login-indicator">(Logged In)</span>';
        }
            
        // Build the author line
        $author_div = $this->html_helper->create_html_tag(
            tag_type: 'div',
            inner_html: get_comment_author($data_object) . $login_indicator,
            classes: $author_classes,
        );

        // Build the date line
        $date_div = $this->html_helper->create_html_tag(
            tag_type: 'div',
            inner_html: get_comment_date('F j, Y \a\t h:i A', $data_object),
            classes: array('date'),
        );

        // Set default moderation condtions
        $mod_div = '';
        // Build the in moderation line
        if (!$data_object->comment_approved) {
            // Build the moderation line
            $mod_div = $this->html_helper->create_html_tag(
                tag_type: 'div',
                inner_html: 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.',
                classes: array('moderation'),
            );
        }

        // Get the comment content and add paragraph breaks
        $comment_text = wpautop(get_comment_text($data_object));

        // Build the edit/reply line
        $edit_reply_div = $this->format_edit_reply($data_object, $depth, $args, $user_can_edit);

        return array(
            'author' => $author_div,
            'date' => $date_div,
            'mod_status' => $mod_div,
            'comment' => $comment_text,
            'edit_reply' => $edit_reply_div,
        );
    }

    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        /**
         * Start of each element.  Abstract class in extending class, so much match that format
         * and cannot specify types.
         * 
         * @param string                $output             Output of walker. Passed by reference so all functions in class affect it.
         * @param object                $data_object        WP_Comment object for current element.
         * @param int                   $depth              Current depth of walker. Starts at 0 for level of first items.
         * @param array                 $args               Arguments as an associative array.
         * @param int                   $current_objct_id   Current object ID, but not passed in by default.
         */


        // Check if the user is logged in and owns the current comment
        $user_owns_comment = is_user_logged_in() && ( intval($data_object->user_id) === intval(get_current_user_id()) );
        // The current user can edit the comment if they own the comment and can edit their own posts OR
        // if they can edit others posts
        $user_can_edit = ($user_owns_comment && current_user_can('edit_posts')) || current_user_can('edit_others_posts');

        // Get array of HTML comment contents
        $comment_html_arr = $this->format_comment_data($data_object, $depth, $args, $user_can_edit, $user_owns_comment);

        // Get the comment classes
        $comment_classes = array('comment');
        if ($depth === 0 && $data_object->get_children()) {
            $comment_classes[] = 'thread';
        }

        // Build the div to contain the comment
        $comment_div = $this->html_helper->create_html_tag(
            tag_type: 'div',
            return_str: false,
            ids: array(sprintf('comment-%s', $data_object->comment_ID)),
            classes: $comment_classes,
        );

        // Output the end result
        $output .= 
            str_repeat(T, $this->base_indent + $depth) . $comment_div['start'] . N . 
            str_repeat(T, $this->base_indent + $depth + 1) . $comment_html_arr['author'] . N . 
            str_repeat(T, $this->base_indent + $depth + 1) . $comment_html_arr['date'] . N . 
            $comment_html_arr['mod_status'] . 
            str_repeat(T, $this->base_indent + $depth + 1) . $comment_html_arr['comment'] . 
            $comment_html_arr['edit_reply'];
    }

    public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
        /**
         * Start of each element.  Abstract class in extending class, so much match that format
         * and cannot specify types.
         * 
         * @param string                $output             Output of walker. Passed by reference so all functions in class affect it.
         * @param object                $data_object        WP_Comment object for current element.
         * @param int                   $depth              Current depth of walker. Starts at 0 for level of first items.
         * @param array                 $args               Arguments as an associative array.
         */

        // For the cards to behave correctly, the element div must close in start_el and NOT in end_el
        // (Otherwise, all nested comments will be placed inside their parent's comment cards)
        $output .= str_repeat(T, $this->base_indent + $depth) . '</div>' . N;

    }

}