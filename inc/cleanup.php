<?php

declare(strict_types=1);

/** CLEANUP UNNECESSARY HEAD CLUTTER **/
// If weird bugs, check here for stuff that might be necessary

// Remove unneeded emoji support
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
