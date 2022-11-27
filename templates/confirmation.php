<?php

/* Template Name: Confirmation */

get_header('blank');?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			
			<!-- Confirmation -->
			<div class="modal fade" aria-hidden="true" id="bcb-confirmation" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content bg-white position-relative shadow-sm rounded-10 border-0">
						<div data-bs-dismiss="modal" class="position-absolute top-0 rounded-circle start-100 translate-middle bg-white d-flex align-items-center justify-content-center shadow-sm" style="width: 30px; height: 30px"><i class="fa-solid fa-xmark"></i></div>
						<div class="modal-body px-4 py-5">
							<div class="text-center">
								<svg class="checkmark mb-3" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
									<circle class="checkmark-bg" cx="26" cy="26" fill="none" r="25"></circle>
									<path class="checkmark-check" d="M14.1 27.2l7.1 7.2 16.7-16.8" fill="none"></path>
								</svg>
								<h4 class="pa-text-primary fw-bold"><?php echo get_the_title();?></h4>
								<p class="mb-0 fs-5 fw-500"><?php get_the_content();?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</article>
</main>

<?php
if(bcb_check_template_name('confirmation.php')) {?>
<script>

	// get confirmation modal
	let bcbConfirmation = document.getElementById('bcb-confirmation');
	
	// show confirmation modal function
	function bcbLoadModal() {
		jQuery('#bcb-confirmation').modal('show');
	}

	// delay show confirmation modal function
	setTimeout(bcbLoadModal , 1000);
	
	// redirect to homepage after closing modal
	bcbConfirmation.addEventListener('hidden.bs.modal', event => {
		window.location.href = "/";
	})

</script>
<?php }?>

<?php get_footer('blank');?>