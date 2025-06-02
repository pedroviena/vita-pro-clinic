
<?php
/**
 * Enqueue scripts and styles
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts and styles
 */
function vitapro_clinic_scripts() {
    $theme_version = wp_get_theme()->get('Version');

    // Main stylesheet
    wp_enqueue_style(
        'vitapro-clinic-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        $theme_version
    );

    // Main JavaScript
    wp_enqueue_script(
        'vitapro-clinic-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme_version,
        true
    );

    // Localize script for AJAX
    wp_localize_script('vitapro-clinic-script', 'vitapro_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vitapro_nonce'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'vitapro_clinic_scripts');

/**
 * Enqueue editor styles
 */
function vitapro_clinic_editor_styles() {
    wp_enqueue_style(
        'vitapro-clinic-editor-style',
        get_template_directory_uri() . '/assets/css/editor-style.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('enqueue_block_editor_assets', 'vitapro_clinic_editor_styles');
