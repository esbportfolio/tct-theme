<?php

declare(strict_types=1);

function tct_get_image_data(int $img_id): array|null {
    /**
     * Gets source and alt text for a given image ID
     * 
     * @param int       $img_id            ID for the image sought
     * 
     * @return          Array with source and alt text. Null if not found.
     */

    // Get source URL
    $src = wp_get_attachment_image_src($img_id)[0] ?? null;

    // If there's no image with that ID, return null
    if (!$src) return null;

    // Get alt text (fallback to 'image' if not present)
    $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
    if (strlen($alt) === 0 ) $alt = 'image';

    return compact('src', 'alt');

}

function tct_menu_has_items(string $menu_location): bool|null {
    /**
     * Checks if the menu assigned to a location has any items
     * 
     * @param string    $menu_location     Location for the menu in question
     * 
     * @return          Boolean to indicate if the menu has items, or null if no menu at that location
     */
    
    // Get all menu locations
    $menu_arr = get_nav_menu_locations();

    // If the menu location doesn't exist, return a null
    if ( !isset($menu_arr[$menu_location]) ) return null;

    // Get the menu-id
    $menu_id = $menu_arr[$menu_location];

    return boolval(wp_get_nav_menu_items($menu_id));

}

function tct_get_menu_id(string $menu_location): int|null {
    /**
     * Gets the ID of a menu at a given location
     * 
     * @param string    $menu_location     Location for the menu in question
     * 
     * @return          Integer that represents the ID of the menu, or null if no menu at that location
     * 
     */
    
    // Get all menu locations
    $menu_arr = get_nav_menu_locations();

    // Return either the menu ID or null if not found
    return $menu_arr[$menu_location] ?? null;

}
