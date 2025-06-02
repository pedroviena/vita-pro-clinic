
<?php
/**
 * Block Patterns for VitaPro Clinic
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register block patterns
 */
function vitapro_clinic_register_block_patterns() {
    
    // Hero Section Pattern
    register_block_pattern(
        'vitapro-clinic/hero-section',
        array(
            'title'       => __('Hero Section - Clínica', 'vitapro-clinic'),
            'description' => __('Seção hero para homepage com call-to-action', 'vitapro-clinic'),
            'categories'  => array('vitapro-hero'),
            'content'     => '<!-- wp:cover {"url":"","dimRatio":40,"overlayColor":"primary","style":{"spacing":{"padding":{"top":"6rem","bottom":"6rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-cover" style="padding-top:6rem;padding-bottom:6rem"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-40 has-background-dim"></span><div class="wp-block-cover__inner-container">
                <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontWeight":"700"}},"textColor":"white","fontSize":"heading-1"} -->
                <h1 class="wp-block-heading has-text-align-center has-white-color has-text-color has-heading-1-font-size" style="font-weight:700">Cuidando da Sua Saúde com Excelência</h1>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1.5rem","bottom":"2rem"}}},"textColor":"white","fontSize":"large"} -->
                <p class="has-text-align-center has-white-color has-text-color has-large-font-size" style="margin-top:1.5rem;margin-bottom:2rem">Atendimento médico especializado com tecnologia de ponta e cuidado humanizado.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"secondary","textColor":"white","style":{"border":{"radius":"8px"},"spacing":{"padding":{"left":"2rem","right":"2rem","top":"1rem","bottom":"1rem"}}},"fontSize":"large"} -->
                    <div class="wp-block-button has-custom-font-size has-large-font-size">
                        <a class="wp-block-button__link has-white-color has-secondary-background-color has-text-color has-background wp-element-button" href="/agendamento" style="border-radius:8px;padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem">Agendar Consulta</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div></div>
            <!-- /wp:cover -->',
        )
    );

    // Services Grid Pattern
    register_block_pattern(
        'vitapro-clinic/services-grid',
        array(
            'title'       => __('Grid de Serviços', 'vitapro-clinic'),
            'description' => __('Grid responsivo para exibir serviços médicos', 'vitapro-clinic'),
            'categories'  => array('vitapro-services'),
            'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group" style="padding-top:5rem;padding-bottom:5rem">
                <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"3rem"}}},"textColor":"dark","fontSize":"heading-2"} -->
                <h2 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-heading-2-font-size" style="font-weight:600;margin-bottom:3rem">Nossos Serviços</h2>
                <!-- /wp:heading -->

                <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"2rem","left":"2rem"}}}} -->
                <div class="wp-block-columns alignwide">
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"white","className":"vitapro-service-item","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group vitapro-service-item has-white-background-color has-background" style="border-radius:12px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"}},"textColor":"dark","fontSize":"heading-3"} -->
                            <h3 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-heading-3-font-size" style="font-weight:600">Cardiologia</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"center","textColor":"gray-medium"} -->
                            <p class="has-text-align-center has-gray-medium-color has-text-color">Cuidados completos para sua saúde cardiovascular.</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"white","className":"vitapro-service-item","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group vitapro-service-item has-white-background-color has-background" style="border-radius:12px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"}},"textColor":"dark","fontSize":"heading-3"} -->
                            <h3 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-heading-3-font-size" style="font-weight:600">Dermatologia</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"center","textColor":"gray-medium"} -->
                            <p class="has-text-align-center has-gray-medium-color has-text-color">Diagnóstico e tratamento de doenças da pele.</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"radius":"12px"}},"backgroundColor":"white","className":"vitapro-service-item","layout":{"type":"constrained"}} -->
                        <div class="wp-block-group vitapro-service-item has-white-background-color has-background" style="border-radius:12px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                            <!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"600"}},"textColor":"dark","fontSize":"heading-3"} -->
                            <h3 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-heading-3-font-size" style="font-weight:600">Ortopedia</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"center","textColor":"gray-medium"} -->
                            <p class="has-text-align-center has-gray-medium-color has-text-color">Tratamento especializado para problemas ósseos.</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:group -->',
        )
    );

    // Contact Form Pattern
    register_block_pattern(
        'vitapro-clinic/contact-form',
        array(
            'title'       => __('Formulário de Contato', 'vitapro-clinic'),
            'description' => __('Formulário de contato completo para clínicas', 'vitapro-clinic'),
            'categories'  => array('vitapro-forms'),
            'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"backgroundColor":"background-light","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-background-light-background-color has-background" style="padding-top:3rem;padding-bottom:3rem">
                <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"2rem"}}},"textColor":"dark","fontSize":"heading-2"} -->
                <h2 class="wp-block-heading has-text-align-center has-dark-color has-text-color has-heading-2-font-size" style="font-weight:600;margin-bottom:2rem">Entre em Contato</h2>
                <!-- /wp:heading -->

                <!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"}} -->
                <div class="wp-block-group">
                    <!-- wp:html -->
                    <form class="vitapro-form" method="post" action="">
                        <div class="vitapro-form-group">
                            <label for="nome" class="vitapro-form-label">Nome Completo *</label>
                            <input type="text" id="nome" name="nome" class="vitapro-form-input" required>
                        </div>
                        
                        <div class="vitapro-form-group">
                            <label for="email" class="vitapro-form-label">E-mail *</label>
                            <input type="email" id="email" name="email" class="vitapro-form-input" required>
                        </div>
                        
                        <div class="vitapro-form-group">
                            <label for="telefone" class="vitapro-form-label">Telefone</label>
                            <input type="tel" id="telefone" name="telefone" class="vitapro-form-input">
                        </div>
                        
                        <div class="vitapro-form-group">
                            <label for="assunto" class="vitapro-form-label">Assunto</label>
                            <select id="assunto" name="assunto" class="vitapro-form-select">
                                <option value="">Selecione um assunto</option>
                                <option value="agendamento">Agendamento de Consulta</option>
                                <option value="informacao">Informações sobre Serviços</option>
                                <option value="convenio">Convênios</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        
                        <div class="vitapro-form-group">
                            <label for="mensagem" class="vitapro-form-label">Mensagem *</label>
                            <textarea id="mensagem" name="mensagem" class="vitapro-form-textarea" required></textarea>
                        </div>
                        
                        <div class="vitapro-form-group">
                            <button type="submit" class="vitapro-btn vitapro-btn--primary vitapro-btn--large">Enviar Mensagem</button>
                        </div>
                    </form>
                    <!-- /wp:html -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->',
        )
    );

    // CTA Section Pattern
    register_block_pattern(
        'vitapro-clinic/cta-section',
        array(
            'title'       => __('Seção Call-to-Action', 'vitapro-clinic'),
            'description' => __('Seção de chamada para ação com botões', 'vitapro-clinic'),
            'categories'  => array('vitapro-cta'),
            'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"backgroundColor":"primary","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-primary-background-color has-background" style="padding-top:5rem;padding-bottom:5rem">
                <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"1.5rem"}}},"textColor":"white","fontSize":"heading-2"} -->
                <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color has-heading-2-font-size" style="font-weight:600;margin-bottom:1.5rem">Pronto para Cuidar da Sua Saúde?</h2>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"2rem"}}},"textColor":"white","fontSize":"large"} -->
                <p class="has-text-align-center has-white-color has-text-color has-large-font-size" style="margin-bottom:2rem">Agende sua consulta hoje mesmo e dê o primeiro passo para uma vida mais saudável.</p>
                <!-- /wp:paragraph -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1rem"}}} -->
                <div class="wp-block-buttons">
                    <!-- wp:button {"backgroundColor":"secondary","textColor":"white","style":{"border":{"radius":"8px"},"spacing":{"padding":{"left":"2rem","right":"2rem","top":"1rem","bottom":"1rem"}}},"fontSize":"large"} -->
                    <div class="wp-block-button has-custom-font-size has-large-font-size">
                        <a class="wp-block-button__link has-white-color has-secondary-background-color has-text-color has-background wp-element-button" href="/agendamento" style="border-radius:8px;padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem">Agendar Consulta</a>
                    </div>
                    <!-- /wp:button -->

                    <!-- wp:button {"backgroundColor":"white","textColor":"primary","style":{"border":{"radius":"8px"},"spacing":{"padding":{"left":"2rem","right":"2rem","top":"1rem","bottom":"1rem"}}},"fontSize":"large"} -->
                    <div class="wp-block-button has-custom-font-size has-large-font-size">
                        <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="/contato" style="border-radius:8px;padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem">Fale Conosco</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->
            </div>
            <!-- /wp:group -->',
        )
    );
}
add_action('init', 'vitapro_clinic_register_block_patterns');
