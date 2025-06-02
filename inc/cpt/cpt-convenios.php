
<?php
/**
 * Custom Post Type: Convênios
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra o Custom Post Type Convênios
 */
function vitapro_clinic_register_convenios_cpt() {
    $labels = array(
        'name'                  => _x('Convênios', 'Post type general name', 'vitapro-clinic'),
        'singular_name'         => _x('Convênio', 'Post type singular name', 'vitapro-clinic'),
        'menu_name'             => _x('Convênios', 'Admin Menu text', 'vitapro-clinic'),
        'name_admin_bar'        => _x('Convênio', 'Add New on Toolbar', 'vitapro-clinic'),
        'add_new'               => __('Adicionar Novo', 'vitapro-clinic'),
        'add_new_item'          => __('Adicionar Novo Convênio', 'vitapro-clinic'),
        'new_item'              => __('Novo Convênio', 'vitapro-clinic'),
        'edit_item'             => __('Editar Convênio', 'vitapro-clinic'),
        'view_item'             => __('Ver Convênio', 'vitapro-clinic'),
        'all_items'             => __('Todos os Convênios', 'vitapro-clinic'),
        'search_items'          => __('Buscar Convênios', 'vitapro-clinic'),
        'not_found'             => __('Nenhum convênio encontrado.', 'vitapro-clinic'),
        'not_found_in_trash'    => __('Nenhum convênio encontrado na lixeira.', 'vitapro-clinic'),
        'featured_image'        => _x('Logo do Convênio', 'Overrides the "Featured Image" phrase', 'vitapro-clinic'),
        'set_featured_image'    => _x('Definir logo do convênio', 'Overrides the "Set featured image" phrase', 'vitapro-clinic'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'convenios'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-businessman',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('convenios', $args);
}
add_action('init', 'vitapro_clinic_register_convenios_cpt');

/**
 * Adiciona meta boxes para informações do convênio
 */
function vitapro_clinic_add_convenios_meta_boxes() {
    add_meta_box(
        'convenio_detalhes',
        __('Informações do Convênio', 'vitapro-clinic'),
        'vitapro_clinic_convenios_meta_box_callback',
        'convenios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vitapro_clinic_add_convenios_meta_boxes');

/**
 * Callback para o meta box de detalhes do convênio
 */
function vitapro_clinic_convenios_meta_box_callback($post) {
    wp_nonce_field('vitapro_clinic_save_convenio_meta', 'vitapro_clinic_convenio_nonce');
    
    $website = get_post_meta($post->ID, '_convenio_website', true);
    $telefone = get_post_meta($post->ID, '_convenio_telefone', true);
    $categoria = get_post_meta($post->ID, '_convenio_categoria', true);
    $observacoes = get_post_meta($post->ID, '_convenio_observacoes', true);
    $ativo = get_post_meta($post->ID, '_convenio_ativo', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="convenio_categoria"><?php _e('Categoria', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <select id="convenio_categoria" name="convenio_categoria">
                    <option value="">Selecione...</option>
                    <option value="plano_saude" <?php selected($categoria, 'plano_saude'); ?>><?php _e('Plano de Saúde', 'vitapro-clinic'); ?></option>
                    <option value="seguro_saude" <?php selected($categoria, 'seguro_saude'); ?>><?php _e('Seguro Saúde', 'vitapro-clinic'); ?></option>
                    <option value="cooperativa" <?php selected($categoria, 'cooperativa'); ?>><?php _e('Cooperativa Médica', 'vitapro-clinic'); ?></option>
                    <option value="autogestao" <?php selected($categoria, 'autogestao'); ?>><?php _e('Autogestão', 'vitapro-clinic'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="convenio_website"><?php _e('Website', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="url" id="convenio_website" name="convenio_website" value="<?php echo esc_attr($website); ?>" placeholder="https://www.exemplo.com.br" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="convenio_telefone"><?php _e('Telefone de Contato', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="tel" id="convenio_telefone" name="convenio_telefone" value="<?php echo esc_attr($telefone); ?>" placeholder="(11) 0000-0000" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="convenio_observacoes"><?php _e('Observações', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <textarea id="convenio_observacoes" name="convenio_observacoes" rows="4" cols="50"><?php echo esc_textarea($observacoes); ?></textarea>
                <p class="description"><?php _e('Informações adicionais sobre o convênio, cobertura, etc.', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="convenio_ativo"><?php _e('Status', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="checkbox" id="convenio_ativo" name="convenio_ativo" value="1" <?php checked($ativo, '1'); ?> />
                <label for="convenio_ativo"><?php _e('Convênio ativo (aceito atualmente)', 'vitapro-clinic'); ?></label>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Salva os meta dados do convênio
 */
function vitapro_clinic_save_convenio_meta($post_id) {
    if (!isset($_POST['vitapro_clinic_convenio_nonce']) || !wp_verify_nonce($_POST['vitapro_clinic_convenio_nonce'], 'vitapro_clinic_save_convenio_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'convenio_website', 
        'convenio_telefone', 
        'convenio_categoria', 
        'convenio_observacoes'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if ($field === 'convenio_observacoes') {
                update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
            } else {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    
    // Checkbox para ativo
    $ativo = isset($_POST['convenio_ativo']) ? '1' : '0';
    update_post_meta($post_id, '_convenio_ativo', $ativo);
}
add_action('save_post', 'vitapro_clinic_save_convenio_meta');

/**
 * Função helper para buscar convênios ativos
 */
function vitapro_clinic_get_active_convenios() {
    $args = array(
        'post_type' => 'convenios',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_convenio_ativo',
                'value' => '1',
                'compare' => '='
            )
        ),
        'orderby' => 'title',
        'order' => 'ASC'
    );
    
    return new WP_Query($args);
}
