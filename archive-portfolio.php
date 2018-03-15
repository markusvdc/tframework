<?php get_header(); ?>
<span class="arquivo">archive-portfolio.php</span>
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
    <?php
    get_template_part( 'pagination' );
    ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
