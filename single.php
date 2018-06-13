<?php get_header(); ?>

<div class="container my-5 post-content">
    <?php 
        the_title('<h5 class="title">', '</h5>');
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    ?>
</div>

<?php get_footer(); ?>