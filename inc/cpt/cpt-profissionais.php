
<?php
/**
 * Custom Post Type: Profissionais
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registra o Custom Post Type Profissionais
 */
function vitapro_clinic_register_profissionais_cpt() {
    $labels = array(
        'name'                  => _x('Profissionais', 'Post type general name', 'vitapro-clinic'),
        'singular_name'         => _x('Profissional', 'Post type singular name', 'vitapro-clinic'),
        'menu_name'             => _x('Profissionais', 'Admin Menu text', 'vitapro-clinic'),
        'name_admin_bar'        => _x('Profissional', 'Add New on Toolbar', 'vitapro-clinic'),
        'add_new'               => __('Adicionar Novo', 'vitapro-clinic'),
        'add_new_item'          => __('Adicionar Novo Profissional', 'vitapro-clinic'),
        'new_item'              => __('Novo Profissional', 'vitapro-clinic'),
        'edit_item'             => __('Editar Profissional', 'vitapro-clinic'),
        'view_item'             => __('Ver Profissional', 'vitapro-clinic'),
        'all_items'             => __('Todos os Profissionais', 'vitapro-clinic'),
        'search_items'          => __('Buscar Profissionais', 'vitapro-clinic'),
        'not_found'             => __('Nenhum profissional encontrado.', 'vitapro-clinic'),
        'not_found_in_trash'    => __('Nenhum profissional encontrado na lixeira.', 'vitapro-clinic'),
        'featured_image'        => _x('Foto do Profissional', 'Overrides the "Featured Image" phrase', 'vitapro-clinic'),
        'set_featured_image'    => _x('Definir foto do profissional', 'Overrides the "Set featured image" phrase', 'vitapro-clinic'),
        'remove_featured_image' => _x('Remover foto do profissional', 'Overrides the "Remove featured image" phrase', 'vitapro-clinic'),
        'use_featured_image'    => _x('Usar como foto do profissional', 'Overrides the "Use as featured image" phrase', 'vitapro-clinic'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'equipe'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-groups',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('profissionais', $args);
}
add_action('init', 'vitapro_clinic_register_profissionais_cpt');

/**
 * Adiciona meta boxes para informações do profissional
 */
function vitapro_clinic_add_profissionais_meta_boxes() {
    add_meta_box(
        'profissional_detalhes',
        __('Informações do Profissional', 'vitapro-clinic'),
        'vitapro_clinic_profissionais_meta_box_callback',
        'profissionais',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vitapro_clinic_add_profissionais_meta_boxes');

/**
 * Callback para o meta box de detalhes do profissional
 */
function vitapro_clinic_profissionais_meta_box_callback($post) {
    wp_nonce_field('vitapro_clinic_save_profissional_meta', 'vitapro_clinic_profissional_nonce');
    
    $crm = get_post_meta($post->ID, '_profissional_crm', true);
    $especialidades = get_post_meta($post->ID, '_profissional_especialidades', true);
    $formacao = get_post_meta($post->ID, '_profissional_formacao', true);
    $experiencia = get_post_meta($post->ID, '_profissional_experiencia', true);
    $horarios = get_post_meta($post->ID, '_profissional_horarios', true);
    $telefone = get_post_meta($post->ID, '_profissional_telefone', true);
    $email = get_post_meta($post->ID, '_profissional_email', true);
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="profissional_crm"><?php _e('CRM/Registro', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="profissional_crm" name="profissional_crm" value="<?php echo esc_attr($crm); ?>" placeholder="Ex: CRM/SP 123456" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="profissional_especialidades"><?php _e('Especialidades', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="profissional_especialidades" name="profissional_especialidades" value="<?php echo esc_attr($especialidades); ?>" placeholder="Ex: Cardiologia, Clínica Geral" />
                <p class="description"><?php _e('Especialidades separadas por vírgula', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="profissional_formacao"><?php _e('Formação', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <textarea id="profissional_formacao" name="profissional_formacao" rows="4" cols="50"><?php echo esc_textarea($formacao); ?></textarea>
                <p class="description"><?php _e('Formação acadêmica e certificações', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="profissional_experiencia"><?php _e('Experiência', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="text" id="profissional_experiencia" name="profissional_experiencia" value="<?php echo esc_attr($experiencia); ?>" placeholder="Ex: 15 anos de experiência" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="profissional_horarios"><?php _e('Horários de Atendimento', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <textarea id="profissional_horarios" name="profissional_horarios" rows="3" cols="50"><?php echo esc_textarea($horarios); ?></textarea>
                <p class="description"><?php _e('Ex: Segunda a Sexta: 8h às 17h', 'vitapro-clinic'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="profissional_telefone"><?php _e('Telefone', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="tel" id="profissional_telefone" name="profissional_telefone" value="<?php echo esc_attr($telefone); ?>" placeholder="(11) 99999-9999" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="profissional_email"><?php _e('E-mail', 'vitapro-clinic'); ?></label>
            </th>
            <td>
                <input type="email" id="profissional_email" name="profissional_email" value="<?php echo esc_attr($email); ?>" placeholder="doutor@vitaproclinic.com" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Salva os meta dados do profissional
 */
function vitapro_clinic_save_profissional_meta($post_id) {
    if (!isset($_POST['vitapro_clinic_profissional_nonce']) || !wp_verify_nonce($_POST['vitapro_clinic_profissional_nonce'], 'vitapro_clinic_save_profissional_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'profissional_crm', 
        'profissional_especialidades', 
        'profissional_formacao', 
        'profissional_experiencia',
        'profissional_horarios',
        'profissional_telefone',
        'profissional_email'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if ($field === 'profissional_formacao' || $field === 'profissional_horarios') {
                update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
            } else {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'vitapro_clinic_save_profissional_meta');
