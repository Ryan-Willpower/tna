<?php
// enqueue bootstrap 4
function wp_add_script() {
    wp_enqueue_style('bootstrap_4_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
    wp_enqueue_script('jquery3', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', null, null, true);
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery3'), null, true);
    wp_enqueue_script('bootstrap_4_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery3', 'popper'), null, true);
    wp_enqueue_script('dropdown', get_template_directory_uri() . '/dropdown.js', null, null, true);
}
add_action('wp_enqueue_scripts', 'wp_add_script');

// required nav-walker
    if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
        // file does not exist... return an error.
        return new WP_Error( 'class-wp-bootstrap-navwalker.php-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'class-wp-bootstrap-navwalker.php' ) );
    } else {
        // file exists... require it.
        require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    }

// register main menu
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Main Menu' ) );
}
add_action( 'init', 'register_my_menu' );

function register_my_menus() {
    register_nav_menus(
      array(
        'main-menu' => __( 'main-menu' ),
      )
    );
}
add_action( 'init', 'register_my_menus' );

// search file by name
function get_attachment_url_by_title( $title ) {
    global $wpdb;

    $attachments = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_title = '$title' AND post_type = 'attachment' ", OBJECT );
    //print_r($attachments);
    if ( $attachments ){
        $attachment_url = $attachments[0]->guid;
    } else {
        return 'image-not-found';
    }

    return $attachment_url;
}

// add font-awesome
function include_fa() {
	wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/95396b5442.js'); 
}
add_action('wp_enqueue_scripts','include_fa');

function button_value() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if (stripos($current_url, 'th') !== false) {
        echo('อ่านต่อ');
    } else {
        echo('Read more');
    }
}
function news_link() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if (stripos($current_url, 'th') !== false) {
        $page = get_page_by_path('news-events-th');
    } else {
        $page = get_page_by_path('news-events');
    }
    the_permalink($page);
}
function static_cat_name() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if (stripos($current_url, 'th') !== false) {
        return 'posts-th';
    } else {
        return 'posts';
    }
}
?>