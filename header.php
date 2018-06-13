<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php wp_title(); ?></title>
        <?php if ( !is_welcome() ) : ?>
        <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body>
    <?php if ( !is_welcome() && !is_404() ) : ?>
        <!-- Language bar : .lang-bar-->
        <div class="w-100 lang-bar">
            <div class="container h-100 d-flex justify-content-end align-items-center">
                <?php
                    wp_nav_menu( array(
                        'theme_location'        => 'lang-change',
                        'container'             => '',
                        'menu_class'            => 'nav'
                    ));
                ?>
            </div>
        </div>
        <!-- main menus -->
        <nav class="navbar navbar-light navbar-expand-lg justify-content-between">
            <div class="container">
                <!-- logo -->
                <a class="navbar-brand" href="<?php echo home_url() ?>">
                    <img class="normal" src="<?php echo get_attachment_url_by_title('tna-logo'); ?>">
                    <img class="mobile" src="<?php  echo get_attachment_url_by_title('tna-logo-mobile');  ?>">
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
        <!-- do a slide shortcode if not 404 page -->
        <?php 
            if (!is_welcome() && ! is_404() ) {
                echo do_shortcode('[rlslider id=35]');
            }
        ?>
        <?php endif; ?>