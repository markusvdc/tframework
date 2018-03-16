<?php get_header(); ?>
<div class="arquivo">page.php</div>
<section id="post-<?php the_ID(); ?>" <?php post_class('gpage'); ?>>

    <!--
    ==========================================
    Page variables
    ==========================================
    -->

    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();

        $title = get_the_title();
        $thumbnail = get_the_post_thumbnail();
        $content = get_the_content();

    endwhile; endif;
    ?>

    <!--
    ==========================================
	Start HTML
	==========================================
    -->

    <header>
        <h1><?php echo $title; ?></h1>
        <?php echo $thumbnail; ?>
    </header>

    <div class="content-gpage">
        <?php echo $content; ?>
    </div>

</section>
<?php get_footer(); ?>
