<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title(); ?></title>
        <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php wp_head(); ?>
    </head>
    <body>
        <!-- Language bar : .lang-bar-->
        <div class="w-100 lang-bar">
            <div class="container h-100 d-flex justify-content-end align-items-center">
                <a class="mr-3" href="#">thai</a>
                <a href="#">eng</a>
            </div>
        </div>
        <!-- main menus -->
        <nav class="navbar navbar-light navbar-expand-lg justify-content-between">
            <div class="container">
                <!-- logo -->
                <a class="navbar-brand" href="<?php echo home_url() ?>">
                    <img src="<?php echo get_attachment_url_by_title('tna-logo'); ?>">
                </a>
                <!-- button that appears when screen is less than ipad size -->
                <button class="btn btn-sm navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    menu <span class="navbar-toggler-icon"></span>
                </button>
                <!-- nav-walking turn!! -->
                    <?php
                wp_nav_menu( array(
                    'theme_location'  => 'main-menu',
                    'depth'           => 2,
                    'container'       => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'main-menu',
                    'menu_class'      => 'navbar-nav ml-auto text-dark',
                    'link_before'     => '<span class="leaf-icon pr-2"><i class="fa fa-leaf" aria-hidden="true"></i></span>',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker()
                ) );
                ?>
            </div>
        </nav>
        <?php 
            if (! is_404() ) {
                echo do_shortcode('[rlslider id=30]');
            }
        ?>