<?php get_header(); ?>

<div class="arquivo">page-teste.php</div>
<section id="post-<?php the_ID(); ?>" <?php post_class('teste'); ?>>

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
    Banner variables
    ==========================================
    -->

    <?php
    $args = array(
        'post_type' => 'banner',
        'orderby' => 'menu_order',
        'order'   => 'ASC'
    );

    $loop = new WP_Query( $args );
    if( $loop->have_posts() ) :
    ?>
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();
            ?>
                <?php
                $data['id'] = get_the_ID();
                $data['title'] = get_the_title();
                $data['thumbnail'] = get_the_post_thumbnail();
                $banners[] = $data;
                unset($data);
                ?>
            <?php
            endwhile;
            ?>
    <?php
    endif;
    ?>

    <!--
    ==========================================
    Cliente variables
    ==========================================
    -->

    <?php
    $args = array(
        'post_type' => 'cliente',
        'orderby' => 'menu_order',
        'order'   => 'ASC'
    );

    $loop = new WP_Query( $args );
    if( $loop->have_posts() ) :
    ?>
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();
            ?>
                <?php
                $data['id'] = get_the_ID();
                $data['title'] = get_the_title();
                $clientes[] = $data;
                unset($data);
                ?>
            <?php
            endwhile;
            ?>
    <?php
    endif;
    ?>

	<!--
    ==========================================
	Start HTML
	==========================================
    -->

    <header>
        <h1><?php echo $title ?></h1>
        <?php echo $thumbnail ?>
    </header>

    <ul class="banner-teste">
        <?php
        foreach ($banners as $banner) :
        ?>
            <li><?php echo $banner['thumbnail'] ?></li>
        <?php
        endforeach;
        ?>
    </ul>

    <ul class="cliente-teste">
        <?php
        foreach ($clientes as $cliente) :
        ?>
            <li><?php echo $cliente['title'] ?></li>
        <?php
        endforeach;
        ?>
    </ul>

    <div class="content-teste">
        <?php echo $content ?>
    </div>

    <?php
        // echo "<pre>";
        // print_r($clientes);
        // echo "</pre>";
    ?>

</section>

<?php get_footer(); ?>
