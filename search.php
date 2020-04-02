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
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title mb-5"><?php printf( esc_html__( 'Search', 'bootstrap-component-blox' ), '<span>' . get_search_query() . '</span>' );?></h1>
                    </div>
                    <?php 
                        get_template_part('loop');
                        get_template_part('pagination'); 
                    ?>
                </div>
            </div>
        </div>
        
    </article>
</main>

<?php get_footer(); ?>