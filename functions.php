<?php
/**
 * ImageGallery Theme Functions
 */

function imagegallery_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => ['site-title', 'site-description'],
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'imagegallery'),
    ]);
}
add_action('after_setup_theme', 'imagegallery_setup');

/**
 * Add logo class to custom logo link for theme styling/scripts
 */
function imagegallery_logo_class($html) {
    return str_replace('custom-logo-link', 'custom-logo-link logo', $html);
}
add_filter('get_custom_logo', 'imagegallery_logo_class');

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

/**
 * Dequeue SimpLy Lightbox on gallery template to avoid conflict with theme lightbox
 */
function imagegallery_dequeue_simply_lightbox() {
    $use_gallery_template = is_page_template('page-gallery.php');
    if (!$use_gallery_template && is_front_page()) {
        $front_page_id = (int) get_option('page_on_front');
        $template = $front_page_id ? get_post_meta($front_page_id, '_wp_page_template', true) : '';
        $use_gallery_template = ($template === 'page-gallery.php');
    }
    if ($use_gallery_template) {
        wp_dequeue_script('pgc-simply-gallery-plugin-lightbox-script');
        wp_dequeue_style('pgc-simply-gallery-plugin-lightbox-style');
    }
}
add_action('wp_enqueue_scripts', 'imagegallery_dequeue_simply_lightbox', 20);

/**
 * Load Homepage Custom Fields
 */
require_once get_template_directory() . '/inc/homepage-custom-fields.php';
