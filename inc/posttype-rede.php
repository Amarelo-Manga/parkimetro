<?php
function post_type_rede() {
	$labels = array(
		'name'                => _x( 'Nossa Rede', 'Post Type General Name', 'parkimetro' ),
		'singular_name'       => _x( 'Nossa Rede', 'Post Type Singular Name', 'parkimetro' ),
		'menu_name'           => __( 'Nossa Rede', 'parkimetro' ),
		'name_admin_bar'      => __( 'Nossa Rede', 'parkimetro' ),
		'parent_item_colon'   => __( 'Parent Rede:', 'parkimetro' ),
		'all_items'           => __( 'Rede', 'parkimetro' ),
		'add_new_item'        => __( 'Adicionar Novo', 'parkimetro' ),
		'add_new'             => __( 'Adicionar Novo', 'parkimetro' ),
		'new_item'            => __( 'Nova Rede', 'parkimetro' ),
		'edit_item'           => __( 'Editar Rede', 'parkimetro' ),
		'update_item'         => __( 'Atualizar Rede', 'parkimetro' ),
		'view_item'           => __( 'Visualizar Rede', 'parkimetro' ),
		'search_items'        => __( 'Buscar Rede', 'parkimetro' ),
		'not_found'           => __( 'Not found', 'parkimetro' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'parkimetro' ),
	);
	$args = array(
		'label'               => __( 'Nossa Rede', 'parkimetro' ),
		'description'         => __( 'Nossa Rede', 'parkimetro' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'municipio', 'bancos' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'rede', $args );
}
// Hook into the 'init' action
add_action( 'init', 'post_type_rede', 0 );