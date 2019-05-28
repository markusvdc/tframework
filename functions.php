<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
    load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image') );
    // 'quote', 'status', 'video', 'audio', 'chat'
}

require get_template_directory() . '/functions/post-type.php';
// require get_template_directory() . '/functions/ajax-pagination.php';

/*==========================================
	Customizações começam aqui
==========================================*/

/*==========================================
	Remover itens do admin menu
==========================================*/
function remove_menus(){
    // remove_menu_page( 'themes.php' );
    // remove_menu_page( 'edit-comments.php' );
    // remove_menu_page( 'tools.php' );
    // remove_menu_page( 'index.php' );
    // remove_menu_page( 'site-migration-export' );
}
add_action( 'admin_menu', 'remove_menus' );

/*==========================================
	Remove style inline das galeria de post
==========================================*/
add_filter( 'use_default_gallery_style', '__return_false' );

/*==========================================
	Altera quantidade de caracteres do excerpt
==========================================*/
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/*==========================================
	Altera a reticências do excerpt para link 'ver mais'
==========================================*/
function wpdocs_excerpt_more( $more ) {
    return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'leia mais', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/*==========================================
	Mostra as taxonomies customizadas 
==========================================*/
function awesome_get_terms( $postID, $term ){
	$terms_list = wp_get_post_terms($postID, $term); 
	$output = '';
					
	$i = 0;
	foreach( $terms_list as $term ){ $i++;
		if( $i > 1 ){ $output .= ', '; }
		$output .= '<a href="' . get_term_link( $term ) . '">'. $term->name .'</a>';
	}
	
	return $output;
}