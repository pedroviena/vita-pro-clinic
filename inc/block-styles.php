
<?php
/**
 * Block Styles for VitaPro Clinic
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom block styles
 */
function vitapro_clinic_register_block_styles() {
    
    // Button styles
    register_block_style(
        'core/button',
        array(
            'name'  => 'vitapro-secondary',
            'label' => __('Secundário', 'vitapro-clinic'),
        )
    );

    register_block_style(
        'core/button',
        array(
            'name'  => 'vitapro-outline',
            'label' => __('Contorno', 'vitapro-clinic'),
        )
    );

    register_block_style(
        'core/button',
        array(
            'name'  => 'vitapro-large',
            'label' => __('Grande', 'vitapro-clinic'),
        )
    );

    // Group styles (for cards and sections)
    register_block_style(
        'core/group',
        array(
            'name'  => 'vitapro-card',
            'label' => __('Card', 'vitapro-clinic'),
        )
    );

    register_block_style(
        'core/group',
        array(
            'name'  => 'vitapro-card-hover',
            'label' => __('Card com Hover', 'vitapro-clinic'),
        )
    );

    register_block_style(
        'core/group',
        array(
            'name'  => 'vitapro-hero',
            'label' => __('Hero Section', 'vitapro-clinic'),
        )
    );

    // Column styles
    register_block_style(
        'core/columns',
        array(
            'name'  => 'vitapro-services-grid',
            'label' => __('Grid de Serviços', 'vitapro-clinic'),
        )
    );

    register_block_style(
        'core/columns',
        array(
            'name'  => 'vitapro-team-grid',
            'label' => __('Grid de Equipe', 'vitapro-clinic'),
        )
    );

    // Heading styles
    register_block_style(
        'core/heading',
        array(
            'name'  => 'vitapro-accent',
            'label' => __('Com Destaque', 'vitapro-clinic'),
        )
    );

    // Quote styles
    register_block_style(
        'core/quote',
        array(
            'name'  => 'vitapro-testimonial',
            'label' => __('Depoimento', 'vitapro-clinic'),
        )
    );
}
add_action('init', 'vitapro_clinic_register_block_styles');
