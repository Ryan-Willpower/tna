<?php
get_header();
while ( have_posts() ) :
    the_post();
 ?>
<div class="container homepage my-5">
	<div class="row">
		<div class="col-lg-8">
			<section>
				<?php the_content(); ?>
			</section>
			<article>
				<?php
					$cat_name = static_cat_name(); //  return category name
					global $post;
					$args = array( 'posts_per_page' => 3, 'category_name' => $cat_name, 'order'=> 'DESC', 'orderby' => 'ID');
					$postslist = get_posts( $args );
					foreach ( $postslist as $post ) :
						setup_postdata( $post ); 
				?> 
						<div class="posts container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<a class="post-link" href="<?php the_permalink(); ?>">
										<?php the_title('<h5 class="title">', '</h5>'); ?>
									</a>
								</div>
								<div class="w-100"></div>
								<div class="col-lg-4">
									<?php the_post_thumbnail(array(205, 205), array('class' => "rounded mx-2 my-auto")); ?>
								</div>
								<div class="col-lg-7 col-xl-8 offset-lg-1 offset-xl-0 pt-1">  
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
				<?php
					endforeach; 
					wp_reset_postdata();
				?>
				<div class="d-flex justify-content-end">
					<a 	class="btn btn-success"
						href="
						<?php news_link(); // same as button_value but return in value ?>">
					<?php button_value(); //choose if link is th or not ?></a>
				</div>
			</article>
		</div> <!-- col-sm-8 -->
		<div class="col-lg-3 offset-md-1 my-5 top-sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div> <!-- row -->
</div> <!-- container, content -->
<?php endwhile; ?>
<?php get_footer(); ?>