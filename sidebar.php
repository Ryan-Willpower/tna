<div class="jumbotron sidebar">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
				<div id="sidebar" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div><!-- .widget-area -->
	<?php endif; ?>
</div>