<span class="arquivo">entry.php</span>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
    <header>
        <h2 class="title-entry"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

        <?php
        if ( !is_search() ) :
        ?>
            <div class="author-entry"><?php the_author_posts_link(); ?></div>
            <div class="date-entry"><?php the_time( get_option( 'date_format' ) ); ?></div>
        <?php
        endif;
        ?>
    </header>
    <section class="excerpt-entry">
        <?php
        the_excerpt();
        ?>
    </section>
    <ul class="attributes-entry">
        <li>Post type: <?php echo get_post_type() ?></li>
        <li>Post format: <?php echo get_post_format() ?></li>
    </ul>
    <?php
    if ( !is_search() ) :
    ?>
        <footer>
            <div class="category-entry">Categorias: <?php the_category( ', ' ); ?></div>
            <?php
                if ( get_post_type() == 'portfolio' || is_tax('portfolio-categoria') ) :
            ?>
                    <div class="category-entry">Categorias taxonomy: <?php echo awesome_get_terms( $post->ID, 'portfolio-categoria' ); ?></div>
            <?php
                endif;
            ?>
            <div class="tag-entry"><?php the_tags('Tags: '); ?></div>
        </footer>
    <?php
    endif;
    ?>
</article>
