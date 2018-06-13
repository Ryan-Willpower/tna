<?php
    get_header();
    global $post;
    $slug = $post->post_name;

    if ( preg_match( '/crop/', $slug ) ) {
        call('product');
    } else if ( preg_match( '/nutri/', $slug ) ) {
        call_without_loops('nutri');
    } else {
        call();
    }
    
    get_footer();
?>