
<?php
/**
 * Block Pattern Categories for VitaPro Clinic
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register block pattern categories
 */
function vitapro_clinic_register_pattern_categories() {
    
    register_block_pattern_category(
        'vitapro-hero',
        array(
            'label' => __('VitaPro - Hero Sections', 'vitapro-clinic'),
        )
    );

    register_block_pattern_category(
        'vitapro-services',
        array(
            'label' => __('VitaPro - Serviços', 'vitapro-clinic'),
        )
    );

    register_block_pattern_category(
        'vitapro-team',
        array(
            'label' => __('VitaPro - Equipe', 'vitapro-clinic'),
        )
    );

    register_block_pattern_category(
        'vitapro-testimonials',
        array(
            'label' => __('VitaPro - Depoimentos', 'vitapro-clinic'),
        )
    );

    register_block_pattern_category(
        'vitapro-forms',
        array(
            'label' => __('VitaPro - Formulários', 'vitapro-clinic'),
        )
    );

    register_block_pattern_category(
        'vitapro-cta',
        array(
            'label' => __('VitaPro - Call to Action', 'vitapro-clinic'),
        )
    );

    register_block_pattern_category(
        'vitapro-content',
        array(
            'label' => __('VitaPro - Conteúdo', 'vitapro-clinic'),
        )
    );
}
add_action('init', 'vitapro_clinic_register_pattern_categories');
