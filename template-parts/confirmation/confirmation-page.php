<?php /** Branded, editable confirmation without a JavaScript dependency. */ ?>
<main id="main-container" class="bcb-confirmation">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('bcb-confirmation-content'); ?>>
            <h1><?php the_title(); ?></h1>
            <div class="entry-content"><?php the_content(); ?></div>
            <a class="btn btn-primary bcb-confirmation-home" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return home', 'bootstrap-component-blox'); ?></a>
        </article>
        <?php endwhile; ?>
    </div>
</main>
