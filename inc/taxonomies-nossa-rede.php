<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_rede_taxonomies', 0 );

// create two taxonomies, Municípios and Estabelecimentos for the post type "book"
function create_rede_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Municípios', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Município', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Municípios', 'textdomain' ),
		'all_items'         => __( 'All Municípios', 'textdomain' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __( 'Edit Município', 'textdomain' ),
		'update_item'       => __( 'Update Município', 'textdomain' ),
		'add_new_item'      => __( 'Add New Município', 'textdomain' ),
		'new_item_name'     => __( 'New Município Name', 'textdomain' ),
		'menu_name'         => __( 'Municípios', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'municipio' ),
	);

	register_taxonomy( 'municipio', array( 'rede' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Estabelecimentos', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Estabelecimento', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Estabelecimentos', 'textdomain' ),
		'popular_items'              => __( 'Popular Estabelecimentos', 'textdomain' ),
		'all_items'                  => __( 'All Estabelecimentos', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Estabelecimento', 'textdomain' ),
		'update_item'                => __( 'Update Estabelecimento', 'textdomain' ),
		'add_new_item'               => __( 'Add New Estabelecimento', 'textdomain' ),
		'new_item_name'              => __( 'New Estabelecimento Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate Estabelecimentos with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove Estabelecimentos', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used Estabelecimentos', 'textdomain' ),
		'not_found'                  => __( 'No Estabelecimentos found.', 'textdomain' ),
		'menu_name'                  => __( 'Estabelecimentos', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'		=> true,
		'show_admin_column'		=> true,
		'show_tagcloud'			=> false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'estabelecimento' ),
	);

	register_taxonomy( 'estabelecimento', 'rede', $args );
}
