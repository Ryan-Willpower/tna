<?php
    get_header();
    global $post;
    $slug = $post->post_name;

    if ( preg_match( '/crop/', $slug ) ) {
        while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/page/content', 'product'  );
        }
    } else {
        while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/page/content' , '');
        }
    }
    get_footer();
?>