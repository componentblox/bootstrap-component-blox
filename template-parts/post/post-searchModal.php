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
    <div class="modal-content">
      <div class="modal-body">
        <?php get_template_part('searchform');?>
      </div>
    </div>
  </div>
</div>