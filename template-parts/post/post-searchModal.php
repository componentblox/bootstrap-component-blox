<?php
/**
 * The template for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-transparent border-0">
        <div class="text-end py-3 text-white" data-bs-dismiss="modal" aria-label="Close"><?php echo bcb_icon('x-lg');?></div>
        <div class="modal-body p-2 border bg-white">
          <?php get_template_part('searchform');?>
        </div>
      </div>
  </div>
</div>