
<?php
/**
 * Security and optimization functions
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Remove unnecessary meta tags
 */
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove jQuery migrate
 */
function vitapro_clinic_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'vitapro_clinic_remove_jquery_migrate');

/**
 * Disable emoji scripts
 */
function vitapro_clinic_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'vitapro_clinic_disable_emojis');

/**
 * Remove unnecessary dashboard widgets
 */
function vitapro_clinic_remove_dashboard_widgets() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'vitapro_clinic_remove_dashboard_widgets');

/**
 * Security headers
 */
function vitapro_clinic_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'vitapro_clinic_security_headers');

/**
 * Sanitize file names on upload
 */
function vitapro_clinic_sanitize_file_name($filename) {
    $sanitized_filename = remove_accents($filename);
    $invalid = array(
        ' '   => '-',
        '%20' => '-',
        '_'   => '-',
    );
    $sanitized_filename = str_replace(array_keys($invalid), array_values($invalid), $sanitized_filename);
    $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename);
    $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename);
    return $sanitized_filename;
}
add_filter('sanitize_file_name', 'vitapro_clinic_sanitize_file_name', 10);

/**
 * Limit login attempts (basic implementation)
 */
function vitapro_clinic_check_attempted_login($user, $username, $password) {
    if (get_transient('attempted_login')) {
        $datas = get_transient('attempted_login');
        
        if ($datas['tried'] >= 3) {
            $until = get_option('_transient_timeout_attempted_login');
            $time = vitapro_clinic_when($until);
            
            $error = new WP_Error();
            $error->add('too_many_tried', sprintf(__('Você tentou fazer login muitas vezes. Por favor, tente novamente em %s.', 'vitapro-clinic'), $time));
            return $error;
        }
    }
    
    return $user;
}
add_filter('authenticate', 'vitapro_clinic_check_attempted_login', 30, 3);

function vitapro_clinic_login_failed($username) {
    if (get_transient('attempted_login')) {
        $datas = get_transient('attempted_login');
        $datas['tried']++;
        
        if ($datas['tried'] <= 3) {
            set_transient('attempted_login', $datas, 300);
        }
    } else {
        $datas = array(
            'tried' => 1
        );
        set_transient('attempted_login', $datas, 300);
    }
}
add_action('wp_login_failed', 'vitapro_clinic_login_failed');

function vitapro_clinic_when($time) {
    return date('H:i:s', $time);
}
