<?php
function post_type_mensalistas() {
	$labels = array(
		'name'                => _x( 'Mensalista', 'Post Type General Name', 'parkimetro' ),
		'singular_name'       => _x( 'Mensalista', 'Post Type Singular Name', 'parkimetro' ),
		'menu_name'           => __( 'Mensalistas', 'parkimetro' ),
		'name_admin_bar'      => __( 'Mensalista', 'parkimetro' ),
		'parent_item_colon'   => __( 'Parent Mensalista:', 'parkimetro' ),
		'all_items'           => __( 'Mensalista', 'parkimetro' ),
		'add_new_item'        => __( 'Adicionar Novo', 'parkimetro' ),
		'add_new'             => __( 'Adicionar Novo', 'parkimetro' ),
		'new_item'            => __( 'Nova Mensalista', 'parkimetro' ),
		'edit_item'           => __( 'Editar Mensalista', 'parkimetro' ),
		'update_item'         => __( 'Atualizar Mensalista', 'parkimetro' ),
		'view_item'           => __( 'Visualizar Mensalista', 'parkimetro' ),
		'search_items'        => __( 'Buscar Mensalista', 'parkimetro' ),
		'not_found'           => __( 'Not found', 'parkimetro' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'parkimetro' ),
	);
	$args = array(
		'label'               => __( 'Mensalista', 'parkimetro' ),
		'description'         => __( 'Mensalista', 'parkimetro' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'author'),
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
        'map_meta_cap'        => true,
	);
	register_post_type( 'mensalista', $args );
}
// Hook into the 'init' action
add_action( 'init', 'post_type_mensalistas', 0 );