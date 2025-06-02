
<?php
/**
 * Main template file for VitaPro Clinic
 * 
 * This file is used as a fallback when a more specific template
 * is not available. In FSE themes, this is minimal since most
 * templating is handled by block templates.
 *
 * @package VitaPro_Clinic
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wp-site-blocks">
    <?php echo do_blocks('<!-- wp:template-part {"slug":"header","area":"header","tagName":"header"} /-->'); ?>
    
    <main class="wp-block-group" style="margin-top:0;margin-bottom:0">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php
                    if (is_singular()) {
                        echo do_blocks('<!-- wp:post-title {"level":1} /-->');
                    }
                    echo do_blocks('<!-- wp:post-content /-->');
                    ?>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <div class="wp-block-group" style="padding-top:3rem;padding-bottom:3rem">
                <h1><?php esc_html_e('Nada encontrado', 'vitapro-clinic'); ?></h1>
                <p><?php esc_html_e('Parece que não conseguimos encontrar o que você está procurando.', 'vitapro-clinic'); ?></p>
            </div>
            <?php
        endif;
        ?>
    </main>
    
    <?php echo do_blocks('<!-- wp:template-part {"slug":"footer","area":"footer","tagName":"footer"} /-->'); ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
