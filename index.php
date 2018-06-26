<?php get_header(); ?>

<div class="post-content my-5">
    <div class="container">
        <h4>News & Event</h4>
        <?php
            $cat_name = static_cat_name();
            if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
            elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
            else { $paged = 1; }
            $args = array( 'posts_per_page' => 4, 'category_name' => $cat_name,'paged' => $paged, 'post_type' => 'post' );
            $postslist = new WP_Query( $args );
            if ( $postslist->have_posts() ) :
                while ( $postslist->have_posts() ) : $postslist->the_post();
        ?>
            <div class="posts my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <a class="post-link" href="<?php the_permalink(); ?>">
                            <?php the_title('<h5 class="news-title">', '</h5>'); ?>
                        </a>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-lg-4">
                        <?php the_post_thumbnail([300, 300], ['class' => "rounded mx-2 my-auto"]); ?>
                    </div>
                    <div class="col-lg-8 pt-1">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        <?php
                endwhile;
            next_posts_link( 'Older Entries', $postslist->max_num_pages );
            previous_posts_link( 'Next Entries &raquo;' );
            wp_reset_postdata();
            endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
