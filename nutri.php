<?php
/*
	Template Name: nutri
	Template Post Type: page
*/
    get_header(); 
    $args1 = array( 'post_type' => 'attachment', 'post_status' => null, 'post_parent' => $post->ID, 'order' => 'ASC' );
    $attachments = get_posts( $args1 );
    global $post;
    $slug = $post->post_name;
?>

    <div class="container my-5">
        <div class="mx-2 my-3">
            <?php the_title('<h3 class="page-title">', '</h3>'); ?>
        </div>
        <div class="row">
            <div class="col-lg-3 my-3">
                <?php 
                foreach ( $attachments as $attachment ) :
                echo wp_get_attachment_image( $attachment->ID, array(200, 200), false, array('class' => 'img-thumbnail') );
                endforeach;?>
            </div>
            <div class="col-lg-9 h-100">
                <?php 
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            $content = do_shortcode(get_the_content());
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

<?php get_footer(); ?>