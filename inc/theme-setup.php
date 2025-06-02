
<?php
/**
 * Theme setup functions
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features
 */
function vitapro_clinic_setup() {
    // Make theme available for translation
    load_theme_textdomain('vitapro-clinic', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('document-title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Add support for Block Templates
    add_theme_support('block-templates');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Enqueue editor styles
    add_editor_style('assets/css/editor-style.css');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'vitapro_clinic_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function vitapro_clinic_content_width() {
    $GLOBALS['content_width'] = apply_filters('vitapro_clinic_content_width', 1200);
}
add_action('after_setup_theme', 'vitapro_clinic_content_width', 0);

/**
 * Register widget area
 */
function vitapro_clinic_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'vitapro-clinic'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'vitapro-clinic'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'vitapro_clinic_widgets_init');
