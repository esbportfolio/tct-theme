<?php
/**
 * TCT Theme functions and definitions
 * 
 * This file contains only functions related to setting up the theme.
 * Any other functions that need to be loaded should be placed inside
 * the /inc directory.
 */

declare(strict_types=1);

/* ----- ACTIONS ----- */

/* ## HOOK: after_setup_theme ##
This hook fires when the theme is initialized.
This can be used for init actions that need to happen when a theme
is launched.
*/

// Import dependencies
if (!function_exists('tct_dependency_setup')) {
    function tct_dependency_setup() {

        // List of required files (must be present for theme to work)
        $required_files = array(
            get_stylesheet_directory() . '/inc/constants.php', // Constants
        );

        // List of included files (theme will work even if not present)
        $included_files = array(
            get_stylesheet_directory() . '/inc/cleanup.php', // Cleanup extra WP code
        );
        
        // Require files
        foreach ($required_files as $dependency) {
            require_once($dependency);
        }

        // Include files
        foreach ($included_files as $dependency) {
            include_once($dependency);
        }
    }
}

add_action( 'after_setup_theme', 'tct_dependency_setup' );

// Add support for theme features
if (!function_exists('tct_theme_setup')) {
    
    function tct_theme_setup() {

		// Let Wordpress manage site title
		add_theme_support( 'title-tag' );
		// Add support for custom logo
		add_theme_support( 'custom-logo' );

        // Register menus for theme
        register_nav_menus( array(
            'header-menu' => 'Header Menu'
        ) );
        
    }
}

add_action( 'after_setup_theme', 'tct_theme_setup' );

/* ## HOOK: wp_enqueue_scripts ##
This hook fires when scripts and styles are enqueued.
This can be used to enqueue both scripts and styles.  Use
the dependency array to manage styles/scripts that need to
be loaded after styles/scripts.
*/

// Add CSS and JS files
function tct_enqueue_scripts() {
	
    // Skeleton normalize file (loaded locally)
    wp_enqueue_style(
        'sk-normalize',
        SITE_ROOT . '/css/normalize.css'
    );

    // Local CSS (load after normalizing)
    wp_enqueue_style(
        'tct-main',
        SITE_ROOT . '/css/main.css',
        array('sk-normalize')
    );

    // // Bootstrap JS (loaded from CDN)
    // wp_enqueue_script(
    //     'bootstrap_js',
    //     'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js',
    //     array(),
    //     false,
    //     array(
    //         'strategy' => 'defer'
    //     )
    // );

    // // WP comment reply JavaScript (loaded only if necesary)
	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}

add_action( 'wp_enqueue_scripts', 'tct_enqueue_scripts' );

/* ----- FILTERS ----- */

/* ## FILTER: comment_form_default_fields ##
This hook fires when the default fields for a comment form
are loaded.  This can be used to remove default fields.
*/

// Remove website field from comment form
function tct_remove_website_field( $fields ) {
	unset( $fields['url'] );
	return $fields;
}

add_filter( 'comment_form_default_fields', 'tct_remove_website_field' );
