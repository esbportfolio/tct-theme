<?php
/**
 * Walker for handling navigation header menus. Extended from Walker_Nav_Menu via Tct_Nav_Walker.
 */

declare(strict_types=1);

class Tct_Nav_Header_Walker extends Tct_Nav_Walker {

    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        /**
         * Start of each element.  Abstract class in extending class, so much match that format
         * and cannot specify types.
         * 
         * @param string                $output             Output of walker. Passed by reference so all functions in class affect it.
         * @param object                $data_object        WP_Post object for current element (menu items are each a WP_Post object).
         * @param int                   $depth              Current depth of walker. Starts at 0 for level of first items.
         * @param null|array|object     $args               Arguments.  This will be an object if invoked with wp_nav_walker but an array
         *                                                  for other uses.
         * @param int                   $current_objct_id   Current object ID, but not passed in by default.
         */
        
        // Set basic data
        $el_title = $data_object->title;
        // URL is set to # if top-level element with children
        $el_url = ($depth === 0 && $args->walker->has_children) ? '#' : $data_object->url;
        // Set if element active (also active if top-level ancestor of active element)
        $el_active = ($data_object->current || ($depth === 0 && $data_object->current_item_ancestor));

        // Set default conditions
        $li_classes = array();
        $a_classes = array();
        $a_attr = array(
            'href' => $el_url
        );

        // Add classes and a dropdown icon for top level items with children
        if ($depth === 0 && $args->walker->has_children) {
            $li_classes[] = 'dropdown-toggle';
            // Create an icon for the dropdown and insert it with the menu item title
            $icon = $this->html_helper->create_html_tag(
                tag_type: 'span',
                classes: array('icon-down-dir')
            );
            $el_title .= $icon;
        }

        // If nav element is active, give it the active class and don't create a link
        // Otherwise, create a link to go to the nav item.
        if ($el_active) {
            $li_classes[] = 'active';
            $content = $el_title;
        } else {
            $content = $this->html_helper->create_html_tag(
                tag_type: 'a',
                inner_html: $el_title,
                classes: $a_classes,
                attr: $a_attr
            );
        }

        // Get a formatted list item tag
        // We use the array format since we only need the opening tag
        $li_tag_array = $this->html_helper->create_html_tag(
            tag_type: 'li',
            return_str: false,
            classes: $li_classes
        );

        // Inserts tags into the output
        $output .= str_repeat(T, $this->base_indent + $depth) . $li_tag_array['start'] . $content;

    }

    // Start each level below the top level
	public function start_lvl( &$output, $depth = 0, $args = null ) {
        /**
         * Start of each level beyond the top level.  Abstract class in extending class, so much match that format
         * and cannot specify types.
         * 
         * @param string                $output             Output of walker. Passed by reference so all functions in class affect it.
         * @param int                   $depth              Current depth of walker. Starts at 0 for first children of top-level items.
         * @param null|array|object     $args               Arguments.  This will be an object if invoked with wp_nav_walker but an array
         *                                                  for other uses.
         * @param int                   $current_objct_id   Current object ID, but not passed in by default.
         */

        // Set default conditions
        $ul_classes = array();

        // Set classes for the dropdown menu based on depth
		if ( $depth === 0 ) {
			$ul_classes = array('dropdown');
		}

        // Get a formatted unordered list tag
        // We use the array format since we only need the opening tag
        $ul_tag_array = $this->html_helper->create_html_tag(
            tag_type: 'ul',
            return_str: false,
            classes: $ul_classes
        );

        // Inserts tags into the output
        $output .= N . str_repeat(T, $this->base_indent + $depth) . $ul_tag_array['start'] . N;
    }

}