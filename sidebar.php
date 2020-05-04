<?php 
/**
 * The sidebar template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<aside id="sidebar" class="sidebar" role="complementary">
	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-area-1')) ?>
</aside>

