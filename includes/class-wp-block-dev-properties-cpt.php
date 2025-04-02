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

		add_filter( 'block_bindings_source_value', array( $this, 'format_currency' ), 10, 5 );
		
		// Add new hooks for taxonomy image field
		add_action( 'property_location_add_form_fields', array( $this, 'add_location_taxonomy_image_field' ) );
		add_action( 'property_location_edit_form_fields', array( $this, 'edit_location_taxonomy_image_field' ) );
		add_action( 'created_property_location', array( $this, 'save_location_taxonomy_image' ) );
		add_action( 'edited_property_location', array( $this, 'save_location_taxonomy_image' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_media_files' ) );
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

		// Register post meta
		register_post_meta( 'property', 'price', [
			'label' => esc_html__( 'Price', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'bedrooms', [
			'label' => esc_html__( 'Bedrooms', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'bathrooms', [
			'label' => esc_html__( 'Bathrooms', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'area_size', [
			'label' => esc_html__( 'Area Size', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'address', [
			'label' => esc_html__( 'Address', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'type', [
			'label' => esc_html__( 'Type', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'price_per_sqft', [
			'label' => esc_html__( 'Price per sq ft', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

		register_post_meta( 'property', 'year_built', [
			'label' => esc_html__( 'Year built', 'deoblocks' ),
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		] );

	}

	/**
	 * Format currency
	 */
	public function format_currency( $value, $name, $args, $block, $attribute_name ) {
		$key = $args['key'] ?? null;
		if ( $key === 'price' || $key === 'price_per_sqft' ) {
			return '$' . number_format((float)$value, 0, '.', ',');
		} elseif ( $key === 'area_size' ) {
			if ( is_singular( 'property' ) ) {
				return number_format((float)$value, 0, '.', ',');
			}
			return number_format((float)$value, 0, '.', ',') . esc_html__(' Sq. Ft.', 'wp-block-dev');
		}
		return $value;
	}

	/**
	 * Load media files needed for image uploader
	 */
	public function load_media_files() {
		wp_enqueue_media();
		wp_enqueue_script(
			'location-taxonomy-image',
			plugins_url( '../assets/js/location-taxonomy-image.js', __FILE__ ),
			array( 'jquery' ),
			'1.0.0',
			true
		);
	}

	/**
	 * Add image field to taxonomy add form
	 */
	public function add_location_taxonomy_image_field() {
		?>
		<div class="form-field term-image-wrap">
			<?php wp_nonce_field('location_taxonomy_image_nonce', 'location_taxonomy_image_nonce'); ?>
			<label for="location-taxonomy-image"><?php esc_html_e( 'Image', 'wp-block-dev' ); ?></label>
			<input type="hidden" id="location-taxonomy-image" name="location_taxonomy_image" class="custom_media_url" value="">
			<div id="location-taxonomy-image-wrapper" style="max-width:300px;"></div>
			<p>
				<input type="button" class="button button-secondary location_taxonomy_media_button" id="location_taxonomy_media_button" name="location_taxonomy_media_button" value="<?php esc_attr_e( 'Add Image', 'wp-block-dev' ); ?>">
			</p>
		</div>
		<?php
	}

	/**
	 * Add image field to taxonomy edit form
	 */
	public function edit_location_taxonomy_image_field( $term ) {
		$image_id = get_term_meta( $term->term_id, 'location_taxonomy_image', true );
		?>
		<tr class="form-field term-image-wrap">
			<th scope="row"><label for="location-taxonomy-image"><?php esc_html_e( 'Image', 'wp-block-dev' ); ?></label></th>
			<td>
				<?php wp_nonce_field('location_taxonomy_image_nonce', 'location_taxonomy_image_nonce'); ?>
				<input type="hidden" id="location-taxonomy-image" name="location_taxonomy_image" value="<?php echo esc_attr( $image_id ); ?>">
				<div id="location-taxonomy-image-wrapper" style="max-width:300px;">
				<?php if ( $image_id ) : ?>
					<?php echo wp_get_attachment_image( absint($image_id), 'thumbnail' ); ?>
				<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary location_taxonomy_media_button" id="location_taxonomy_media_button" name="location_taxonomy_media_button" value="<?php esc_attr_e( 'Add Image', 'wp-block-dev' ); ?>">
					<input type="button" class="button button-secondary location_taxonomy_media_remove" id="location_taxonomy_media_remove" name="location_taxonomy_media_remove" value="<?php esc_attr_e( 'Remove Image', 'wp-block-dev' ); ?>" <?php echo !$image_id ? 'style="display:none;"' : ''; ?> />
				</p>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save taxonomy image
	 */
	public function save_location_taxonomy_image( $term_id ) {
		// Verify nonce
		if (!isset($_POST['location_taxonomy_image_nonce']) || 
			!wp_verify_nonce($_POST['location_taxonomy_image_nonce'], 'location_taxonomy_image_nonce')) {
			return;
		}

		// Check if user has permissions
		if (!current_user_can('manage_categories')) {
			return;
		}

		if (isset($_POST['location_taxonomy_image'])) {
			update_term_meta($term_id, 'location_taxonomy_image', absint($_POST['location_taxonomy_image']));
		} else {
			delete_term_meta($term_id, 'location_taxonomy_image');
		}
	}

}

$WPBlockDev_Properties_CPT = WPBlockDev_Properties_CPT::get_instance();
