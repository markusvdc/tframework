<?php get_header(); ?>
<span class="arquivo">search.php</span>
<section class="search">
    <?php
    if ( have_posts() ) :
    ?>
        <div class="results-search">
            <header>
                <h1>Resultados para: <?php echo get_search_query() ?></h1>
            </header>

            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'entry' );
            endwhile;
            ?>
        </div>
        <?php 
        get_template_part( 'pagination' );
        ?>
    <?php
    else :
    ?>
        <div class="nothing-search">
            <h2 class="entry-title">Nenhum resultado encontrado.</h2>
            <p>Sua busca não retornou resultados, tente novamente com outros termos.</p>
        </div>
    <?php
    endif;
    ?>
</section>
<?php get_footer(); ?>
