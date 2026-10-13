<?php
/* Template Name: Confirmation */
if (!bcb_ui_enabled()) {
    get_template_part('template-parts/confirmation/confirmation', 'legacy');
    return;
}
get_header();
get_template_part('template-parts/confirmation/confirmation', 'page');
get_footer();
