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
        ?>
        <div class="col-md-6 nutri">
            <?php the_title('<h5 class="mb-3"><span class="cat-icon mr-3"><i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i></span>', '</h5>'); ?>
            <?php the_content()?>
            <?php $post_slug = get_post_field( 'post_name', get_post() ); ?>
        </div>
        <?php
            endforeach;
            wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>
