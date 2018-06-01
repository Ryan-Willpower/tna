<?php get_header(); ?>

    <div class="container my-5">
        <?php the_title('<h4 class="page-title ml-1">', '</h4>'); ?>
        <div class="jumbotron my-2">
        <?php 
            $content = get_the_content();
            $content = preg_replace("/<img[^>]+\>/i", " ", $content);         
            $content = apply_filters('the_content', $content);
            $content = str_replace(']]>', ']]>', $content);
            echo $content; 
        ?>
        </div>
        <div class="row">

    <?php
        $args = array( 'post_type' => 'attachment', 'numberposts' => 16, 'post_status' => null, 'post_parent' => $post->ID, 'order' => 'ASC' );
        $attachments = get_posts( $args );
        if ( $attachments ) :
            foreach ( $attachments as $attachment ) :
                $custom_url         = get_post_meta( $attachment->ID, '_gallery_link_url', true );
                $image_title        = get_the_title( $attachment->ID );
    ?>
            <div class="col-md-6 col-lg-4 my-3">
                <div class="img-thumbnail text-center category">
                    <a href="<?php echo $custom_url; ?>" class="image-link">
                    <div class="image p-3 border border-light">
                        <?php echo wp_get_attachment_image( $attachment->ID, array(200, 200) ); ?>
                    </div>
                    <div class="category-title">
                        <p><?php echo $image_title; ?></p>
                    </div> <!-- end class title -->
                    </a> <!-- end anchor -->
                </div> <!-- end class img-thumbnail -->
            </div> <!-- end col-4 -->
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>