<?php 
/**
 * The search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<?php get_header();?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            
			<h1 class="page-title mb-5"><?php printf( esc_html__( 'Search', 'bootstrap-component-blox' ), '<span>' . get_search_query() . '</span>' );?></h1>

			<?php 
                get_template_part('loop');
                get_template_part('pagination'); 
            ?>
        
        </div>
        
        <div class="col-md-4">
            <?php get_sidebar();?>
        </div>
        
    </div>
</div>

<?php get_footer();?>