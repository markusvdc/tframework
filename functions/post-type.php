<?php
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
