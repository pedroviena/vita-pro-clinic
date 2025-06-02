
<?php
/**
 * Custom Post Type: Serviços
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra o Custom Post Type Serviços
 */
function vitapro_clinic_register_servicos_cpt() {
    $labels = array(
        'name'                  => _x('Serviços', 'Post type general name', 'vitapro-clinic'),
        'singular_name'         => _x('Serviço', 'Post type singular name', 'vitapro-clinic'),
        'menu_name'             => _x('Serviços', 'Admin Menu text', 'vitapro-clinic'),
        'name_admin_bar'        => _x('Serviço', 'Add New on Toolbar', 'vitapro-clinic'),
        'add_new'               => __('Adicionar Novo', 'vitapro-clinic'),
        'add_new_item'          => __('Adicionar Novo Serviço', 'vitapro-clinic'),
        'new_item'              => __('Novo Serviço', 'vitapro-clinic'),
        'edit_item'             => __('Editar Serviço', 'vitapro-clinic'),
        'view_item'             => __('Ver Serviço', 'vitapro-clinic'),
        'all_items'             => __('Todos os Serviços', 'vitapro-clinic'),
        'search_items'          => __('Buscar Serviços', 'vitapro-clinic'),
        'parent_item_colon'     => __('Serviços Pai:', 'vitapro-clinic'),
        'not_found'             => __('Nenhum serviço encontrado.', 'vitapro-clinic'),
        'not_found_in_trash'    => __('Nenhum serviço encontrado na lixeira.', 'vitapro-clinic'),
        'featured_image'        => _x('Imagem do Serviço', 'Overrides the "Featured Image" phrase', 'vitapro-clinic'),
        'set_featured_image'    => _x('Definir imagem do serviço', 'Overrides the "Set featured image" phrase', 'vitapro-clinic'),
        'remove_featured_image' => _x('Remover imagem do serviço', 'Overrides the "Remove featured image" phrase', 'vitapro-clinic'),
        'use_featured_image'    => _x('Usar como imagem do serviço', 'Overrides the "Use as featured image" phrase', 'vitapro-clinic'),
        'archives'              => _x('Arquivos de Serviços', 'The post type archive label used in nav menus', 'vitapro-clinic'),
        'insert_into_item'      => _x('Inserir no serviço', 'Overrides the "Insert into post"/"Insert into page" phrase', 'vitapro-clinic'),
        'uploaded_to_this_item' => _x('Enviado para este serviço', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'vitapro-clinic'),
        'filter_items_list'     => _x('Filtrar lista de serviços', 'Screen reader text for the filter links', 'vitapro-clinic'),
        'items_list_navigation' => _x('Navegação da lista de serviços', 'Screen reader text for the pagination', 'vitapro-clinic'),
        'items_list'            => _x('Lista de serviços', 'Screen reader text for the items list', 'vitapro-clinic'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'servicos'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'template'           => array(
            array('core/paragraph', array(
                'placeholder' => 'Descreva o serviço oferecido...'
            )),
        ),
    );

    register_post_type('servicos', $args);
}
add_action('init', 'vitapro_clinic_register_servicos_cpt');

/**
 * Registra taxonomia para categorizar serviços
 */
function vitapro_clinic_register_servicos_taxonomy() {
    $labels = array(
        'name'              => _x('Especialidades', 'taxonomy general name', 'vitapro-clinic'),
        'singular_name'     => _x('Especialidade', 'taxonomy singular name', 'vitapro-clinic'),
        'search_items'      => __('Buscar Especialidades', 'vitapro-clinic'),
        'all_items'         => __('Todas as Especialidades', 'vitapro-clinic'),
        'parent_item'       => __('Especialidade Pai', 'vitapro-clinic'),
        'parent_item_colon' => __('Especialidade Pai:', 'vitapro-clinic'),
        'edit_item'         => __('Editar Especialidade', 'vitapro-clinic'),
        'update_item'       => __('Atualizar Especialidade', 'vitapro-clinic'),
        'add_new_item'      => __('Adicionar Nova Especialidade', 'vitapro-clinic'),
        'new_item_name'     => __('Nova Especialidade', 'vitapro-clinic'),
        'menu_name'         => __('Especialidades', 'vitapro-clinic'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'especialidade'),
        'show_in_rest'      => true,
    );

    register_taxonomy('especialidade_servico', array('servicos'), $args);
}
add_action('init', 'vitapro_clinic_register_servicos_taxonomy');

/**
 * Adiciona meta boxes para informações adicionais dos serviços
 */
function vitapro_clinic_add_servicos_meta_boxes() {
    add_meta_box(
        'servico_detalhes',
        __('Detalhes do Serviço', 'vitapro-clinic'),
        'vitapro_clinic_servicos_meta_box_callback',
        'servicos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vitapro_clinic_add_servicos_meta_boxes');

/**
 * Callback para o meta box de detalhes do serviço
 */
function vitapro_clinic_servicos_meta_box_callback($post) {
    wp_nonce_field('vitapro_clinic_save_servico_meta', 'vitapro_clinic_servico_nonce');
    
    $duracao = get_post_meta($post->ID, '_servico_duracao', true);
    $preco = get_post_meta($post->ID, '_servico_preco', true);
    $preparacao = get_post_meta($post->ID, '_servico_preparacao', true);
    $contraindicacoes = get_post_meta($post->ID, '_servico_contraindicacoes', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="servico_duracao"><?php _e('Duração', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="servico_duracao" name="servico_duracao" value="<?php echo esc_attr($duracao); ?>" placeholder="Ex: 30 minutos" />
                <p class="description"><?php _e('Duração aproximada do procedimento', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="servico_preco"><?php _e('Preço', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="servico_preco" name="servico_preco" value="<?php echo esc_attr($preco); ?>" placeholder="Ex: R$ 150,00" />
                <p class="description"><?php _e('Preço do serviço (opcional)', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="servico_preparacao"><?php _e('Preparação', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <textarea id="servico_preparacao" name="servico_preparacao" rows="4" cols="50"><?php echo esc_textarea($preparacao); ?></textarea>
                <p class="description"><?php _e('Instruções de preparação para o procedimento', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="servico_contraindicacoes"><?php _e('Contraindicações', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <textarea id="servico_contraindicacoes" name="servico_contraindicacoes" rows="4" cols="50"><?php echo esc_textarea($contraindicacoes); ?></textarea>
                <p class="description"><?php _e('Contraindicações e cuidados especiais', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Salva os meta dados do serviço
 */
function vitapro_clinic_save_servico_meta($post_id) {
    if (!isset($_POST['vitapro_clinic_servico_nonce']) || !wp_verify_nonce($_POST['vitapro_clinic_servico_nonce'], 'vitapro_clinic_save_servico_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('servico_duracao', 'servico_preco', 'servico_preparacao', 'servico_contraindicacoes');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'vitapro_clinic_save_servico_meta');
