<?php 

/**
 * The file Contains all propertyes & attributes of all the Custom Posts Type and Taxonomies used in the 'Reveal' Theme
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );


add_action( 'init', 'codexin_custompost_type' );
/**
 * Function to register all the Custom Post Types
 *
 * @since 1.0
 */
function codexin_custompost_type() {

	/**
	 * Custom Post Type -  Testimonial
	 *
	 */

 	// Creating the Labels for Testimonial Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Testimonial', 'codexin' ),
		'singular_name'			=> esc_html__( 'Testimonial', 'codexin' ),
		'add_new'				=> esc_html__( 'Add New', 'codexin' ),
		'all_items'				=> esc_html__( 'All Testimonial', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add New', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Testimonial', 'codexin' ),
		'new_item'				=> esc_html__( 'New Testimonial', 'codexin' ),
		'view_item'				=> esc_html__( 'View Testimonial', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Testimonial Post', 'codexin' ),
		'not_found'				=> esc_html__( 'No Testimonial Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Testimonial In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Testimonial', 'codexin' )

	);

 	// Creating an Aruments Array that Store all argumens of Testimonial Custom Post
 	$args = array(
		'labels'				=> $labels,
		'menu_icon'				=> 'dashicons-admin-customizer',
		'public'				=> true,
		'has_archive'			=> true,
		'publicly_queryable'	=> true,
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability-type'		=> 'post',
		'hierarchical'			=> true,
		'supports'				=> array(
									'title',
									'editor',
									'excerpt',
									'thumbnail'
								),
		'taxonomies'			=> array( '' ),
		'menu_position'			=> 11,
		'exclude_from_search'	=> false
	);

	// Registering the Testimonial Custom Post
 	register_post_type( 'testimonial', $args );


	/**
	 * Custom Post Type -  Clients
	 *
	 */

 	// Creating the Labels for Clients Custom Post
 	$labels = array(
		'name'					=> esc_html__( 'Clients', 'codexin' ),
		'singular_name'			=> esc_html__( 'Clients', 'codexin' ),
		'add_new'				=> esc_html__( 'Add New', 'codexin' ),
		'all_items'				=> esc_html__( 'All Clients', 'codexin' ),
		'add_new_item'			=> esc_html__( 'Add New', 'codexin' ),
		'edit_item'				=> esc_html__( 'Edit Clients', 'codexin' ),
		'new_item'				=> esc_html__( 'New Clients', 'codexin' ),
		'view_item'				=> esc_html__( 'View Clients', 'codexin' ),
		'search_item'			=> esc_html__( 'Search Clients Post', 'codexin' ),
		'not_found'				=> esc_html__( 'No Clients Found', 'codexin' ),
		'not_found_in_trash' 	=> esc_html__( 'No Clients In Trash', 'codexin' ),
		'parent_item_colon'		=> esc_html__( 'Parent Clients', 'codexin' )

	);

 	// Creating an Aruments Array that Store all argumens of Clients Custom Post
 	$args = array(
		'labels'				=> $labels,
		'menu_icon'				=> 'dashicons-universal-access-alt',
		'public'				=> true,
		'has_archive'			=> false,
		'publicly_queryable'	=> false,
		'query_var'				=> true,
		'rewrite'				=> true,
		'capability-type'		=> 'post',
		'hierarchical'			=> true,
		'supports'				=> array(
									'title',
									'thumbnail'
								),
		'taxonomies'			=> array( '' ),
		'menu_position'			=> 12,
		'exclude_from_search'	=> false
	);

	// Registering the Clients Custom Post
 	register_post_type( 'clients', $args );

} // End codexin_custompost_type()


add_action( 'init', 'codexin_cpt_taxonomies' );
/**
 * Function to register all the Custom Taxonomies for Custom Post Type
 *
 * @since 1.0
 */
function codexin_cpt_taxonomies() {

	/**
	 * Custom Taxonomy for Portfolio Custom Post
	 *
	 */

	// // Adding new taxonomy (hierarchical)
	// $labels = array(
	// 	'name' 				=> esc_html__( 'Portfolio Categories', 'codexin' ),
	// 	'singular_name' 	=> esc_html__( 'Portfolio Category', 'codexin' ),
	// 	'search_items' 		=> esc_html__( 'Search Portfolio Category', 'codexin' ),
	// 	'all_items' 		=> esc_html__( 'All Portfolio Categories', 'codexin' ),
	// 	'parent_item' 		=> esc_html__( 'Parent Portfolio Category', 'codexin' ),
	// 	'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'codexin' ),
	// 	'edit_item' 		=> esc_html__( 'Edit Portfolio Category', 'codexin' ),
	// 	'update_item' 		=> esc_html__( 'Update Portfolio Category', 'codexin' ),
	// 	'add_new_item' 		=> esc_html__( 'Add New Portfolio Category', 'codexin' ),
	// 	'new_item_name' 	=> esc_html__( 'New Portfolio Category Name', 'codexin' ),
	// 	'menu_name' 		=> esc_html__( 'Portfolio Categories', 'codexin' )
	// );

	// $args = array(
	// 	'hierarchical' 		=> true,
	// 	'labels' 			=> $labels,
	// 	'show_ui' 			=> true,
	// 	'has_archive'		=> true,
	// 	'show_admin_column' => true,
	// 	'query_var' 		=> true,
	// 	'rewrite' 			=> array( 'slug' => 'portfolio-category' )
	// );

	// // Registering the hierarchical Taxonomy
	// register_taxonomy( 'portfolio-category', array( 'portfolio' ), $args );

	// // Registering new taxonomy NON hierarchical
	// register_taxonomy( 'portfolio_tags', 'portfolio', array(
	// 		'label' 		=> esc_html__( 'Portfolio Tags', 'codexin' ),
	// 		'rewrite' 		=> array( 'slug' => 'portfolio-tags' ),
	// 		'hierarchical' 	=> false
	// 	)
	// );
}


/**
 * Creating Custom Place Holders for the Custom Post Types
 */
add_filter( 'enter_title_here', 'codexin_title_placeholder', 0, 2 );
/**
 * Function to Create Custom Title Placeholders for the Custom Post Types
 *
 * @since 1.0
 */
function codexin_title_placeholder( $title , $post ) {
	if( $post->post_type == 'testimonial' ) {
		$cx_title = esc_html__( 'Enter Testimonial Title', 'codexin' );
		return $cx_title;
	} elseif( $post->post_type == 'clients' ) {
		$cx_title = esc_html__( 'Enter Client Name', 'codexin' );
		return $cx_title;
	}
	return $title;
}