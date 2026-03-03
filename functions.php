<?php
/**
 * ImageGallery Theme Functions
 */

function imagegallery_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');

    register_nav_menus([
        'primary' => __('Primary Menu', 'imagegallery'),
    ]);
}
add_action('after_setup_theme', 'imagegallery_setup');



/**
 * Enqueue Theme Assets
 */
function imagegallery_enqueue_assets() {

    $theme_version = wp_get_theme()->get('Version');

    // Main Theme Style
    wp_enqueue_style(
        'imagegallery-style',
        get_stylesheet_uri(),
        [],
        $theme_version
    );

    // Tooplate Gallery CSS
    wp_enqueue_style(
        'tooplate-winter-gallery',
        get_template_directory_uri() . '/assets/css/gallery.css',
        [],
        $theme_version
    );

    // Tooplate Gallery JS
    wp_enqueue_script(
        'tooplate-winter-scripts',
        get_template_directory_uri() . '/assets/js/gallery.js',
        array(),              // dependencies
        $theme_version,       // version
        true                  // load in footer
    );
}
add_action('wp_enqueue_scripts', 'imagegallery_enqueue_assets');
