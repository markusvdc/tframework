<?php get_header(); ?>
<div class="arquivo">single.php</div>
<article class="bpost">
    <!-- bpog = blog post -->
    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
    ?>
        <header>
            <h1><?php the_title(); ?></h1>
            <?php
            if ( has_post_thumbnail() ) :
                the_post_thumbnail();
            endif;
            ?>
        </header>
        <div class="content-bpost">
            <?php the_content(); ?>
        </div>
        <ul class="attributes-bpost">
            <li>Post type: <?php echo get_post_type() ?></li>
            <li>Post format: <?php echo get_post_format() ?></li>
        </ul>
        <div class="pagination-bpost">
            <?php previous_post_link( '%link', '< %title' ); ?>
            <?php next_post_link( '%link', '%title >' ); ?>
        </div>
    <?php
    endwhile; endif;
    ?>
</article>
<?php get_footer(); ?>
