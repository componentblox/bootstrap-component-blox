<form class="container search" method="get" action="<?php echo home_url();?>" role="search">
	<div class="row">
		<div class="col-12 px-0">
			<div class="input-group">
				<input type="search" name="s" class="form-control search-input" placeholder="Search for..." value="<?php the_search_query(); ?>">
				<button class="btn btn-dark search-submit rounded-0" type="submit" role="button"><?php _e( 'Search', 'bootstrap-component-blox' ); ?></button>
			</div>
		</div>
	</div>
</form>
