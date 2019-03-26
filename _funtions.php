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
    global $content_width;
    if ( ! isset( $content_width ) ) $content_width = 640;
    register_nav_menus(
        array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
    );
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
    wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
    if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
    if ( $title == '' ) {
        return '&rarr;';
    } else {
        return $title;
    }
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
    return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
    register_sidebar( array (
        'name' => __( 'Sidebar Widget Area', 'blankslate' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
function blankslate_custom_pings( $comment )
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
    if ( !is_admin() ) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}

/*
	==========================================
	Customizações começam aqui
	==========================================
*/

/*
	==========================================
	Remover itens do admin menu
	==========================================
*/
function remove_menus(){
    // remove_menu_page( 'themes.php' );
    // remove_menu_page( 'edit-comments.php' );
    // remove_menu_page( 'tools.php' );
    // remove_menu_page( 'index.php' );
    // remove_menu_page( 'site-migration-export' );
}
add_action( 'admin_menu', 'remove_menus' );

/*
	==========================================
	Remove style inline das galeria de post
	==========================================
*/
add_filter( 'use_default_gallery_style', '__return_false' );

/*
	==========================================
	Altera quantidade de caracteres do excerpt
	==========================================
*/
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/*
	==========================================
	Altera a reticências do excerpt para link 'ver mais'
	==========================================
*/
function wpdocs_excerpt_more( $more ) {
    return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'leia mais', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/*
	==========================================
	Portfolio Custom Post Type
	==========================================
*/
function portfolio_custom_post_type (){
	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio',
		'add_new' => 'Adicionar portfolio',
		'all_items' => 'Todos portfolios',
		'add_new_item' => 'Adicionar portfolio',
		'edit_item' => 'Editar portfolio',
		'new_item' => 'Novo portfolio',
		'view_item' => 'Ver portfolio',
		'search_item' => 'Procurar portfolio',
		'not_found' => 'Nenhum portfolio encontrado',
        'featured_image' => 'Imagem',
		'set_featured_image' => 'Selecionar imagem',
		'remove_featured_image' => 'Remover imagem',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			// 'thumbnail',
            // 'excerpt',
			// 'revisions',
			// 'custom-fields',
		),
		// 'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false,
        'menu_icon'   => 'dashicons-portfolio',
	);
	register_post_type('portfolio',$args);
}
add_action('init','portfolio_custom_post_type');

/*
	==========================================
	Banner Custom Post Type
	==========================================
*/
function banner_custom_post_type (){
	$labels = array(
		'name' => 'Banners',
		'singular_name' => 'Banner',
		'add_new' => 'Adicionar novo',
		'all_items' => 'Todos os banners',
		'add_new_item' => 'Adicionar banner',
		'edit_item' => 'Editar banner',
		'new_item' => 'Novo banner',
		'view_item' => 'Ver banner',
		'search_item' => 'Procurar banner',
		'not_found' => 'Nenhum banner encontrado',
		'attributes' => 'Atributos',
		'featured_image' => 'Imagem',
		'set_featured_image' => 'Selecionar imagem',
		'remove_featured_image' => 'Remover imagem',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'publicly_queryable' => false,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'thumbnail',
			'page-attributes',
		),
		'menu_position' => 6,
		'exclude_from_search' => true,
        'menu_icon'   => 'dashicons-format-image',
	);
	register_post_type('banner',$args);
}
add_action('init','banner_custom_post_type');

/*
	==========================================
	Clientes Custom Post Type
	==========================================
*/
function cliente_custom_post_type (){
	$labels = array(
		'name' => 'Clientes',
		'singular_name' => 'Clientes',
		'add_new' => 'Adicionar novo',
		'all_items' => 'Todos os clientes',
		'add_new_item' => 'Adicionar cliente',
		'edit_item' => 'Editar cliente',
		'new_item' => 'Novo cliente',
		'view_item' => 'Ver cliente',
		'search_item' => 'Procurar cliente',
		'not_found' => 'Nenhum cliente encontrado',
		'attributes' => 'Atributos',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'publicly_queryable' => false,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			// 'editor',
			'page-attributes',
		),
		'menu_position' => 6,
		'exclude_from_search' => true,
        'menu_icon'   => 'dashicons-groups',
	);
	register_post_type('cliente',$args);
}
add_action('init','cliente_custom_post_type');

/*
	==========================================
	Portfolio Custom Taxonomies
	==========================================
*/
function portfolio_custom_taxonomies() {
	$labels = array(
		'name' => 'Tipos',
		'singular_name' => 'Tipo',
		'search_items' => 'Search Tipos',
		'all_items' => 'All Tipos',
		'edit_item' => 'Editar Tipo',
		'update_item' => 'Atualizar Tipo',
		'add_new_item' => 'Adicionar novo Tipo',
		'new_item_name' => 'Novo nome Tipo',
		'menu_name' => 'Tipos',
		'not_found' => 'Nenhum tipo encontrado',
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tipo' ),
	);

	register_taxonomy('field', array('portfolio'), $args);
}
add_action( 'init' , 'portfolio_custom_taxonomies' );

//teste