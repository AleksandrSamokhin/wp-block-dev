<?php
/**
 * Register Properties Custom Post Type.
 *
 * @package WP Block Dev
 */

if ( ! defined( 'ABSPATH' )) {
	exit;
}

/**
 * Register Properties Custom Post Type.
 *
 * @since 1.0.0
 */
class WPBlockDev_Properties_CPT {

	/**
	* This plugin's instance.
	*
	* @var WPBlockDev_Properties_CPT
	*/
	private static $instance;

	/**
	* Initiator
	*
	* @return object initialized object of class.
	*/
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * The Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
	}


	/**
	 * Register post type
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x('Properties', 'Post Type General Name', 'wp-block-dev'),
			'singular_name'         => _x('Property', 'Post Type Singular Name', 'wp-block-dev'),
			'menu_name'            => __('Properties', 'wp-block-dev'),
			'name_admin_bar'       => __('Property', 'wp-block-dev'),
			'archives'             => __('Property Archives', 'wp-block-dev'),
			'attributes'           => __('Property Attributes', 'wp-block-dev'),
			'parent_item_colon'    => __('Parent Property:', 'wp-block-dev'),
			'all_items'            => __('All Properties', 'wp-block-dev'),
			'add_new_item'         => __('Add New Property', 'wp-block-dev'),
			'add_new'             => __('Add New', 'wp-block-dev'),
			'new_item'            => __('New Property', 'wp-block-dev'),
			'edit_item'           => __('Edit Property', 'wp-block-dev'),
			'update_item'         => __('Update Property', 'wp-block-dev'),
			'view_item'           => __('View Property', 'wp-block-dev'),
			'view_items'          => __('View Properties', 'wp-block-dev'),
			'search_items'        => __('Search Property', 'wp-block-dev'),
    );
    
    $args = array(
			'label'               => __('Property', 'wp-block-dev'),
			'labels'              => $labels,
			'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
			'taxonomies'          => array('property_location'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-admin-home',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'query_var'           => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
    );
    
    register_post_type('property', $args);

		$labels = array(
			'name'                       => _x('Locations', 'Taxonomy General Name', 'wp-block-dev'),
			'singular_name'              => _x('Location', 'Taxonomy Singular Name', 'wp-block-dev'),
			'menu_name'                  => __('Location', 'wp-block-dev'),
			'all_items'                  => __('All Locations', 'wp-block-dev'),
			'parent_item'                => __('Parent Location', 'wp-block-dev'),
			'parent_item_colon'          => __('Parent Location:', 'wp-block-dev'),
			'new_item_name'              => __('New Location Name', 'wp-block-dev'),
			'add_new_item'               => __('Add New Location', 'wp-block-dev'),
			'edit_item'                  => __('Edit Location', 'wp-block-dev'),
			'update_item'                => __('Update Location', 'wp-block-dev'),
			'view_item'                  => __('View Location', 'wp-block-dev'),
			'separate_items_with_commas' => __('Separate locations with commas', 'wp-block-dev'),
			'add_or_remove_items'        => __('Add or remove locations', 'wp-block-dev'),
			'choose_from_most_used'      => __('Choose from the most used', 'wp-block-dev'),
			'search_items'               => __('Search Locations', 'wp-block-dev'),
    );
    
    $tax_args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'              => true,
    );
    
    register_taxonomy( 'property_location', array('property'), $tax_args );

	}

}

$WPBlockDev_Properties_CPT = WPBlockDev_Properties_CPT::get_instance();
