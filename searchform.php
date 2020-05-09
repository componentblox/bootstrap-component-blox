<?php 
/**
 * The search form template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<form class="search position-relative" method="get" action="<?php echo esc_url(home_url('/'));?>" role="search">
	<input type="text" name="s" placeholder="Search..." value="<?php the_search_query(); ?>">
	<button type="submit" role="button" aria-label="search" class="fa fa-search"></button>
</form>