<?php
    /*
        Template Name: welcome
        Template Post Type: page
    */
    get_header();
?>

<body>
    <div class="main container d-flex justify-content-center align-items-center flex-column">
        <img class="img-fluid" src="<?php echo get_attachment_url_by_title("tna-welcome"); ?>" alt=logo>
        <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                the_content();
            }
        }
        ?>
        <div class="button w-50">
            <div class="line"></div>
            <?php $site = str_replace('welcome', '', site_url()); ?>
            <div class="d-flex justify-content-between">
                <a href="<?php echo $site . '/th'; ?>" class="btn btn-success">Thai</a>
                <a href="<?php echo $site; ?>" class="btn btn-success">English</a>
            </div>
        </div>
    </div>
    
</body>

<?php get_footer(); ?>