<?php
    get_header();
    $args1 = array( 'post_type' => 'attachment', 'post_status' => null, 'post_parent' => $post->ID, 'order' => 'ASC' );
    $attachments = get_posts( $args1 );
    global $post;
    $slug = $post->post_name;
?>

<div class="container my-5 nutri">
    <div class="cat-jumbotron jumbotron">
        <div class="row">
            <div class="col-xl-1 text-center mr-2">
                <?php
                foreach ( $attachments as $attachment ) :
                echo wp_get_attachment_image( $attachment->ID, array(200, 200) );
                endforeach;?>
            </div>
            <div class="col-md-12 col-xl-10">
                <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            $content = get_the_content();
                            $content = preg_replace("/<img[^>]+\>/i", " ", $content);
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]>', $content);
                            echo $content;
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
            $args2 = array( 'posts_per_page' => 10, 'category_name' => cat_name($slug), 'order'=> 'ASC', 'orderby' => 'ID');
            $postslist = get_posts( $args2 );
            foreach ( $postslist as $post ) :
            setup_postdata( $post );
            $post_slug = get_post_field( 'post_name', get_post() );
        ?>
        <div class="col-md-4 nutri">
            <div class="d-flex flex-column text-center">
                <a href="/<?php echo $post_slug; ?>"><?php the_post_thumbnail([300, 300], null); ?></a>
                <?php the_title('<a class="nutri-link" href="/'.$post_slug.'"><h5 class="mb-3 my-5"><span class="cat-icon mr-3"><i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i></span>', '</h5></a>'); ?>
            </div>
        </div>
        <?php
            endforeach;
            wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>
