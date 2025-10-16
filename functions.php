<?php
/**
 * Federation of Canadian Chiropractic Block Theme functions
 *
 * @package ChiroFed
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Setup theme
 */
function chirofed_setup() {
    // Add theme support for block templates
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    
    // Add theme support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('css/wp-editor-styles.css');
    
    // Add theme support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'chirofed'),
        'footer'  => __('Footer Navigation', 'chirofed'),
    ));
}
add_action('after_setup_theme', 'chirofed_setup');

/**
 * Enqueue scripts and styles
 */
function chirofed_enqueue_assets() {
    // Enqueue the original theme's CSS
    wp_enqueue_style(
        'chirofed-original-styles',
        get_template_directory_uri() . '/css/style.css',
        array(),
        '2.0'
    );
    
    // Enqueue Font Awesome
    wp_enqueue_style(
        'chirofed-fontawesome',
        get_template_directory_uri() . '/css/all.min.css',
        array(),
        '2.0'
    );
    
    // Enqueue Google Fonts
    wp_enqueue_style(
        'chirofed-google-fonts',
        'https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,700;1,400;1,700&display=swap',
        array(),
        null
    );
    
    // Enqueue jQuery UI
    wp_enqueue_script(
        'chirofed-jquery-ui',
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        array('jquery'),
        '1.12.1',
        true
    );
    
    // Enqueue custom scripts
    wp_enqueue_script(
        'chirofed-scripts',
        get_template_directory_uri() . '/js/scripts.js',
        array('jquery'),
        '2.0',
        true
    );
    
    // Enqueue BX Slider for front page
    if (is_front_page()) {
        wp_enqueue_script(
            'chirofed-bxslider',
            'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js',
            array('jquery'),
            '4.2.12',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'chirofed_enqueue_assets');

/**
 * Add editor styles for block editor
 */
function chirofed_editor_styles() {
    // Add Google Fonts to editor
    wp_enqueue_style(
        'chirofed-editor-google-fonts',
        'https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,400;0,700;1,400;1,700&display=swap',
        array(),
        null
    );
    
    // Add custom editor styles
    wp_enqueue_style(
        'chirofed-editor-styles',
        get_template_directory_uri() . '/css/wp-editor-styles.css',
        array(),
        '2.0'
    );
}
add_action('enqueue_block_editor_assets', 'chirofed_editor_styles');

/**
 * Register block patterns category
 */
function chirofed_register_block_patterns() {
    register_block_pattern_category(
        'chirofed',
        array('label' => __('ChiroFed Patterns', 'chirofed'))
    );
}
add_action('init', 'chirofed_register_block_patterns');

/**
 * Custom block styles
 */
function chirofed_register_block_styles() {
    // Register custom button style
    register_block_style(
        'core/button',
        array(
            'name'  => 'chirofed-small-button',
            'label' => __('Small Button', 'chirofed'),
        )
    );
    
    // Register custom group style
    register_block_style(
        'core/group',
        array(
            'name'  => 'chirofed-card',
            'label' => __('Card Style', 'chirofed'),
        )
    );
}
add_action('init', 'chirofed_register_block_styles');

/**
 * Customize excerpt length
 */
function chirofed_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'chirofed_excerpt_length');

/**
 * Add custom image sizes
 */
function chirofed_image_sizes() {
    add_image_size('chirofed-large', 1200, 800, true);
    add_image_size('chirofed-medium', 800, 600, true);
    add_image_size('chirofed-thumbnail', 400, 300, true);
}
add_action('after_setup_theme', 'chirofed_image_sizes');

/**
 * Allow SVG uploads
 */
function chirofed_allow_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'chirofed_allow_svg');

/**
 * Add ACF options page if ACF is active
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Options',
        'menu_slug'  => 'general-settings',
        'capability' => 'edit_posts',
    ));
}