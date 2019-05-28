<?php get_header(); ?>
<span class="arquivo">index.php</span>
<section id="blog">
    <h1>
    <?php
    if ( is_archive() ) {
        the_archive_title();
    }else {
        echo "Blog";
    }
    ?>
    </h1>
    <div class="results-blog">
        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
            get_template_part( 'entry' );
        endwhile; endif;
        ?>
    </div>
    <!-- <a class="btn-sunset-load sunset-load-more" data-page="1" data-url="<?php // echo admin_url('admin-ajax.php'); ?>">
        <span class="sunset-icon sunset-loading"></span>
        <span class="text">Load More</span>
    </a> -->
    <?php
    get_template_part( 'pagination' );
    ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
