<?php
// enqueue bootstrap 4
function wp_add_script() {
    wp_enqueue_style('bootstrap_4_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
    wp_enqueue_script('jquery3', 'https://code.jquery.com/jquery-3.3.1.slim.min.js', null, null, true);
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery3'), null, true);
    wp_enqueue_script('bootstrap_4_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery3', 'popper'), null, true);
    if ( is_welcome() && !is_404() ) {
        wp_enqueue_style('welcome', get_template_directory_uri(). '/welcome_css.php', null, null);
    }
    // wp_enqueue_script('dropdown', get_template_directory_uri() . '/dropdown.js', null, null, true);
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
function register_my_menus() {
    register_nav_menus(
      array(
        'main-menu' => __( 'main-menu' ),
        'lang-change' => __( 'lang-change' )
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

// Enable support for Post Thumbnails on posts and pages.
add_theme_support( 'post-thumbnails', array( 'post' ) );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
    global $post;
    return '<a class="post-link" href="'. get_permalink($post->ID) . '"> ...Read the full article</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// call a content
function call($slug = '') {
    while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/page/content', $slug );
    }
}

// call without loops
function call_without_loops($slug = '') {
    get_template_part( 'template-parts/page/content', $slug );
}

// register sidebar
function tna_widgets_init() {
    register_sidebar( array(
        'name' => __( 'sidebar', 'tnaagrigroup' ),
        'id' => 'sidebar',
        'description' => __( 'Widgets in this area will be shown on all page.', 'tnaagrigroup' ),
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'tna_widgets_init' );

// fix pagination to not fall into 404
function my_post_count_queries( $query ) {
    if (!is_admin() && $query->is_main_query()){
      if(is_home()){
         $query->set('posts_per_page', 1);
      }
    }
  }
add_action( 'pre_get_posts', 'my_post_count_queries' );

// check what value logo have to use
function site_value() {
    $url = bloginfo('url');
    if ( stripos( $url, 'th' ) !== false ) {
        return $url . '/th/';
    } else {
        return $url;
    }
}

// check what button value could use
function button_value() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if (stripos($current_url, 'th') !== false) {
        echo('อ่านต่อ');
    } else {
        echo('Read more');
    }
}

// check what path should use
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

// check what category should use
function static_cat_name() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if (stripos($current_url, 'th') !== false) {
        return 'posts-th';
    } else {
        return 'posts';
    }
}

// this too
function cat_name($post_cat) {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    if (stripos($current_url, 'th') !== false) {
        return $post_cat .= '-th';
    } else {
        return $post_cat;
    }
}

// check welcome slug
function is_welcome() {
    global $post;
    $slug = $post->post_name;

    if ( preg_match( '/welcome/', $slug ) ) {
        return true;
    }
}

// modify a "more" text
function modify_read_more_link() {
    $post_slug = get_post_field( 'post_name', get_post() );
    return '<a href="/'. $post_slug .'" class="btn btn-info btn-sm mb-3">Detail</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

// remove p from a
function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('acf_the_content', 'filter_ptags_on_images');
add_filter('the_content', 'filter_ptags_on_images');

// Title
function title() {
    if (is_front_page() && ! is_home()) {
        echo (bloginfo('name'));
        echo " | ";
        echo (bloginfo('description'));
    } else {
        echo (wp_title(''));
        echo (" | ");
        echo (bloginfo('name'));
    }
}
?>
