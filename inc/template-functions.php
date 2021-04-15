<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Teri_Shelton
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function terishelton_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'terishelton_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function terishelton_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'terishelton_pingback_header' );

// Portfolio Custom Post Type
function create_post_type() {
	$labels = array(
		'name' => __( 'Portfolio', 'terishelton' ),
        'singular_name' => __( 'Portfolio Item', 'terishelton' ),
		'add_new_item' => __('Add New Portfolio Item', 'terishelton'),
		'edit_item' => __('Edit Portfolio Item', 'terishelton'),
		'new_item' => __('New Portfolio Item', 'terishelton'),
		'view_item' => __('View Portfolio Item', 'terishelton'),
		'view_items' => __('View Portfolio', 'terishelton'),
		'search_items' => __('Search Portfolio', 'terishelton')
	);
	
	$args = array (
		'labels' => $labels,
		'description' => __('Portfolio for terishelton', 'terishelton'),
		'public' => true,
		'publicly_queryable' => true,
      	'has_archive' => false,
		'capability_type' => 'post',
		'menu_icon' => 'dashicons-images-alt2',
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
		'rewrite' => array('slug' => 'portfolio', 'with_front' => true)
	);
	
	register_post_type( 'portfolio', $args);
}
add_action( 'init', 'create_post_type' );

// Portfolio tags
function create_portfolio_taxonomy() {
	register_taxonomy(
		'tags',
		'portfolio',
		array(
			'labels' => array(
				'name' => _x( 'Portfolio Tags', 'taxonomy general name', 'terishelton' ),
				'singular_name' => _x( 'Portfolio Tag', 'taxonomy singular name', 'terishelton' ),
				'search_items' => __( 'Search Tags', 'terishelton' ),
				'popular_items' => __( 'Popular Tags', 'terishelton' ),
				'all_items' => __( 'All Tags', 'terishelton' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Tags', 'terishelton' ),
				'update_item' => __( 'Update Tag', 'terishelton' ),
				'add_new_item' => __( 'Add New Tag', 'terishelton' ),
				'new_item_name' => __( 'New Tag Name', 'terishelton' ),
				'separate_items_with_commas' => __( 'Separate tags with commas', 'terishelton' ),
				'add_or_remove_items' => __( 'Add or remove tags', 'terishelton' ),
				'choose_from_most_used' => __( 'Choose from the most used tags', 'terishelton' ),
				'not_found' => __( 'No tags found.', 'terishelton' ),
				'menu_name' => __( 'Portfolio Tags', 'terishelton' ),
			),
			'rewrite' => false,
			'public' => true,
			'hierarchical' => false,
		)
	);
}
add_action( 'init', 'create_portfolio_taxonomy' );