<?php 
/**
 * The search form template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<form class="cb_search position-relative" method="get" action="<?php echo esc_url(home_url('/'));?>" role="search">
	<input class="<?php $searchClasses;?>" type="text" name="s" placeholder="Search..." value="<?php the_search_query(); ?>">
	<button type="submit" role="button" aria-label="magnifying glass icon" class="fa fa-search"></button>
</form>