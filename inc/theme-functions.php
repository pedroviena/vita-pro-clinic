
<?php
/**
 * Custom functions for VitaPro Clinic theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get featured services for homepage
 */
function vitapro_clinic_get_featured_services($limit = 6) {
    $args = array(
        'post_type' => 'servicos',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    return new WP_Query($args);
}

/**
 * Get team members for display
 */
function vitapro_clinic_get_team_members($limit = 8) {
    $args = array(
        'post_type' => 'profissionais',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    return new WP_Query($args);
}

/**
 * Display service icon based on specialty
 */
function vitapro_clinic_get_service_icon($specialty = '') {
    $icons = array(
        'cardiologia' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5Z"/></svg>',
        
        'dermatologia' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>',
        
        'ortopedia' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 18a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2"/><rect x="7" y="6" width="10" height="10" rx="2"/><circle cx="12" cy="10" r="1"/></svg>',
        
        'ginecologia' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M12 14v7"/><path d="M8 21h8"/></svg>',
        
        'pediatria' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
        
        'default' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>'
    );
    
    $specialty_key = sanitize_title($specialty);
    return isset($icons[$specialty_key]) ? $icons[$specialty_key] : $icons['default'];
}

/**
 * Display star rating
 */
function vitapro_clinic_display_rating($rating) {
    $rating = intval($rating);
    $output = '';
    
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $output .= '⭐';
        } else {
            $output .= '☆';
        }
    }
    
    return $output;
}

/**
 * Get contact information (should be stored in theme options)
 */
function vitapro_clinic_get_contact_info() {
    return array(
        'phone' => get_option('vitapro_clinic_phone', '(11) 99999-9999'),
        'email' => get_option('vitapro_clinic_email', 'contato@vitaproclinic.com'),
        'address' => get_option('vitapro_clinic_address', 'Rua das Flores, 123 - Centro - São Paulo/SP'),
        'hours' => get_option('vitapro_clinic_hours', 'Seg à Sex: 7h às 19h | Sáb: 8h às 12h'),
    );
}

/**
 * Custom excerpt length
 */
function vitapro_clinic_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'vitapro_clinic_excerpt_length');

/**
 * Custom excerpt more text
 */
function vitapro_clinic_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'vitapro_clinic_excerpt_more');

/**
 * Add custom body classes
 */
function vitapro_clinic_body_classes($classes) {
    // Add class for FSE theme
    $classes[] = 'vitapro-clinic-theme';
    
    // Add class for current page type
    if (is_front_page()) {
        $classes[] = 'vitapro-homepage';
    } elseif (is_page()) {
        $classes[] = 'vitapro-page';
    } elseif (is_single()) {
        $classes[] = 'vitapro-single';
    } elseif (is_archive()) {
        $classes[] = 'vitapro-archive';
    }
    
    return $classes;
}
add_filter('body_class', 'vitapro_clinic_body_classes');

/**
 * Customize login page
 */
function vitapro_clinic_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg);
            height: 80px;
            width: 200px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 10px;
        }
        
        .login form {
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(45, 55, 72, 0.15);
        }
        
        .login #nav a, .login #backtoblog a {
            color: #3A7DBC !important;
        }
        
        .login #nav a:hover, .login #backtoblog a:hover {
            color: #64C5BA !important;
        }
        
        .wp-core-ui .button-primary {
            background-color: #3A7DBC;
            border-color: #3A7DBC;
            border-radius: 6px;
        }
        
        .wp-core-ui .button-primary:hover {
            background-color: #64C5BA;
            border-color: #64C5BA;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'vitapro_clinic_login_logo');

/**
 * Change login logo URL
 */
function vitapro_clinic_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'vitapro_clinic_login_logo_url');

/**
 * Change login logo title
 */
function vitapro_clinic_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'vitapro_clinic_login_logo_url_title');
