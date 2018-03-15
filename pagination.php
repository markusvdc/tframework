<?php
global $wp_query;

$big = 999999999; // need an unlikely integer

$args = array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type' => 'list',
    'prev_next' => false
);

?>
<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
    <span class="arquivo">pagination.php</span>
    <div class="pagination">
        <?php previous_posts_link( '<' ); ?>
        <?php echo paginate_links( $args ); ?>
        <?php next_posts_link( '>' ); ?>
    </div>
<?php } ?>
