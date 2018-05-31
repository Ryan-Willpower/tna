<?php
    get_header();
    global $post;
    $slug = $post->post_name;

    if ( $slug != 'about-us' || $slug != 'contact-us') {
        while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/page/content', str_replace('-th', '', $slug) );
        }
    } else {
        while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/page/content' , '');
        }
    }
    get_footer();
?>