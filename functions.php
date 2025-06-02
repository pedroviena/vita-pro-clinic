
<?php
/**
 * VitaPro Clinic functions and definitions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
require_once get_template_directory() . '/inc/theme-setup.php';

// Enqueue scripts and styles
require_once get_template_directory() . '/inc/enqueue.php';

// Custom Post Types
require_once get_template_directory() . '/inc/cpt/cpt-servicos.php';
require_once get_template_directory() . '/inc/cpt/cpt-profissionais.php';
require_once get_template_directory() . '/inc/cpt/cpt-depoimentos.php';
require_once get_template_directory() . '/inc/cpt/cpt-convenios.php';

// Block Patterns
require_once get_template_directory() . '/inc/block-patterns.php';

// Block Pattern Categories
require_once get_template_directory() . '/inc/block-pattern-categories.php';

// Block Styles
require_once get_template_directory() . '/inc/block-styles.php';

// Custom functions for the theme
require_once get_template_directory() . '/inc/theme-functions.php';

// Security and optimization
require_once get_template_directory() . '/inc/security.php';
