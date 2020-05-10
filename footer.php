<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

$arr = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
		'target' => array(),
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
);

bcb_before_footer();

get_template_part('footer-widgets');
if(get_theme_mod('navbar_search')) { 
	get_template_part('searchmodal');
}?>
	
	<footer class="text-center p-3 <?php echo esc_html(get_theme_mod('footer_classes'));?>" role="contentinfo">
		<div class="site-info"><?php if(get_theme_mod('footer_credit')){ echo wp_kses(get_theme_mod('footer_credit'), $arr, 'bootstrap-component-blox');} else {?>&copy;<?php echo esc_html(date('Y'));?> <?php esc_html_e('Copyright' , 'bootstrap-component-blox');?> <a href="<?php echo esc_url( __( 'https://componentblox.com/', 'bootstrap-component-blox' ) ); ?>"><?php esc_html_e('Component Blox.' , 'bootstrap-component-blox');?></a> <?php esc_html_e('Powered by' , 'bootstrap-component-blox');?> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bootstrap-component-blox' ) ); ?>">
			<?php 
			printf( esc_html__( 'WordPress', 'bootstrap-component-blox' )); ?></a> &amp; <a href="<?php echo esc_url( __( 'https://getbootstrap.com/', 'bootstrap-component-blox' ) ); ?>" title="Bootstrap"> <?php esc_html_e('Bootstrap' , 'bootstrap-component-blox');?></a>.<?php }?>
		</div>
	</footer>
    <?php wp_footer(); ?>
    <?php get_template_part('footer' , 'scripts');?>
	</body>
</html>