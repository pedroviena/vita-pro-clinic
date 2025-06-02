
<?php
/**
 * Custom Post Type: Depoimentos
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra o Custom Post Type Depoimentos
 */
function vitapro_clinic_register_depoimentos_cpt() {
    $labels = array(
        'name'                  => _x('Depoimentos', 'Post type general name', 'vitapro-clinic'),
        'singular_name'         => _x('Depoimento', 'Post type singular name', 'vitapro-clinic'),
        'menu_name'             => _x('Depoimentos', 'Admin Menu text', 'vitapro-clinic'),
        'name_admin_bar'        => _x('Depoimento', 'Add New on Toolbar', 'vitapro-clinic'),
        'add_new'               => __('Adicionar Novo', 'vitapro-clinic'),
        'add_new_item'          => __('Adicionar Novo Depoimento', 'vitapro-clinic'),
        'new_item'              => __('Novo Depoimento', 'vitapro-clinic'),
        'edit_item'             => __('Editar Depoimento', 'vitapro-clinic'),
        'view_item'             => __('Ver Depoimento', 'vitapro-clinic'),
        'all_items'             => __('Todos os Depoimentos', 'vitapro-clinic'),
        'search_items'          => __('Buscar Depoimentos', 'vitapro-clinic'),
        'not_found'             => __('Nenhum depoimento encontrado.', 'vitapro-clinic'),
        'not_found_in_trash'    => __('Nenhum depoimento encontrado na lixeira.', 'vitapro-clinic'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'depoimentos'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-quote',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('depoimentos', $args);
}
add_action('init', 'vitapro_clinic_register_depoimentos_cpt');

/**
 * Adiciona meta boxes para informações do depoimento
 */
function vitapro_clinic_add_depoimentos_meta_boxes() {
    add_meta_box(
        'depoimento_detalhes',
        __('Informações do Depoimento', 'vitapro-clinic'),
        'vitapro_clinic_depoimentos_meta_box_callback',
        'depoimentos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vitapro_clinic_add_depoimentos_meta_boxes');

/**
 * Callback para o meta box de detalhes do depoimento
 */
function vitapro_clinic_depoimentos_meta_box_callback($post) {
    wp_nonce_field('vitapro_clinic_save_depoimento_meta', 'vitapro_clinic_depoimento_nonce');
    
    $autor = get_post_meta($post->ID, '_depoimento_autor', true);
    $cidade = get_post_meta($post->ID, '_depoimento_cidade', true);
    $profissional = get_post_meta($post->ID, '_depoimento_profissional', true);
    $servico = get_post_meta($post->ID, '_depoimento_servico', true);
    $rating = get_post_meta($post->ID, '_depoimento_rating', true);
    $destaque = get_post_meta($post->ID, '_depoimento_destaque', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="depoimento_autor"><?php _e('Nome do Paciente', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="depoimento_autor" name="depoimento_autor" value="<?php echo esc_attr($autor); ?>" placeholder="Ex: Maria Silva" required />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="depoimento_cidade"><?php _e('Cidade', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="depoimento_cidade" name="depoimento_cidade" value="<?php echo esc_attr($cidade); ?>" placeholder="Ex: São Paulo/SP" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="depoimento_profissional"><?php _e('Profissional', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="depoimento_profissional" name="depoimento_profissional" value="<?php echo esc_attr($profissional); ?>" placeholder="Ex: Dr. João Santos" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="depoimento_servico"><?php _e('Serviço/Tratamento', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="depoimento_servico" name="depoimento_servico" value="<?php echo esc_attr($servico); ?>" placeholder="Ex: Consulta Cardiológica" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="depoimento_rating"><?php _e('Avaliação', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <select id="depoimento_rating" name="depoimento_rating">
                    <option value="">Selecione...</option>
                    <option value="5" <?php selected($rating, '5'); ?>>⭐⭐⭐⭐⭐ (5 estrelas)</option>
                    <option value="4" <?php selected($rating, '4'); ?>>⭐⭐⭐⭐ (4 estrelas)</option>
                    <option value="3" <?php selected($rating, '3'); ?>>⭐⭐⭐ (3 estrelas)</option>
                    <option value="2" <?php selected($rating, '2'); ?>>⭐⭐ (2 estrelas)</option>
                    <option value="1" <?php selected($rating, '1'); ?>>⭐ (1 estrela)</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="depoimento_destaque"><?php _e('Destacar na Homepage', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="checkbox" id="depoimento_destaque" name="depoimento_destaque" value="1" <?php checked($destaque, '1'); ?> />
                <label for="depoimento_destaque"><?php _e('Exibir este depoimento na homepage', 'vitapro-clinic'); ?></label>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Salva os meta dados do depoimento
 */
function vitapro_clinic_save_depoimento_meta($post_id) {
    if (!isset($_POST['vitapro_clinic_depoimento_nonce']) || !wp_verify_nonce($_POST['vitapro_clinic_depoimento_nonce'], 'vitapro_clinic_save_depoimento_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'depoimento_autor', 
        'depoimento_cidade', 
        'depoimento_profissional', 
        'depoimento_servico',
        'depoimento_rating'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
    
    // Checkbox para destaque
    $destaque = isset($_POST['depoimento_destaque']) ? '1' : '0';
    update_post_meta($post_id, '_depoimento_destaque', $destaque);
}
add_action('save_post', 'vitapro_clinic_save_depoimento_meta');

/**
 * Função helper para buscar depoimentos em destaque
 */
function vitapro_clinic_get_featured_testimonials($limit = 3) {
    $args = array(
        'post_type' => 'depoimentos',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_depoimento_destaque',
                'value' => '1',
                'compare' => '='
            )
        ),
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    return new WP_Query($args);
}
