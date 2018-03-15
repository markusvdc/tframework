<?php get_header(); ?>
<div class="arquivo">page.php</div>
<section id="post-<?php the_ID(); ?>" <?php post_class('gpage'); ?>>
    <!-- gpage = generic page -->
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
        <div class="content-gpage">
            <?php the_content(); ?>
        </div>
    <?php
    endwhile; endif;
    ?>
</section>
<?php get_footer(); ?>
