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


<main id="main-container" role="main" class="container-fluid px-0">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title mb-4"><?php printf( esc_html__( 'Search Results', 'bootstrap-component-blox' ), '<span>' . get_search_query() . '</span>' );?></h1>
                    </div>
                </div>
                <?php get_template_part('template-parts/post/post' , 'loop');?>
                
                <?php if (paginate_links()) {?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <?php get_template_part('template-parts/post/post' , 'pagination');?>
                    </div>
                </div>
                <?php }?>
            
            </div>
        </div>
        
    </article>
</main>

<?php get_footer(); ?>