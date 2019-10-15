<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

$footer_credit = get_theme_mod('footer_credit');
$footer_classes = get_theme_mod('footer_classes');
$child_theme_directory = get_stylesheet_directory();

get_template_part('footer-widgets');?>
	
	<footer class="text-center py-3 <?php echo esc_html($footer_classes);?>" role="contentinfo">
		<div class="site-info"><?php if($footer_credit){echo ($footer_credit);} else {?>&copy;<?php echo esc_html(date('Y'));?> Copyright <a href="https://theme.componentblox.com"><?php bloginfo('name'); ?></a>. <?php esc_html('Powered by ', 'bootstrap-component-blox'); ?><a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//getbootstrap.com/" title="Bootstrap"> Bootstrap</a>.<?php }?></div>
	</footer>
    <?php wp_footer(); ?>

    <?php if(file_exists($child_theme_directory . '/footer-scripts.php')) { get_template_part('footer' , 'scripts');}?>

	</body>
</html>
