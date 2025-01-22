<?php
/**
 * Register blocks.
 *
 * @package WP Block Dev
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load registration for our blocks.
 *
 * @since 1.0.0
 */
class WPBlockDev_Register_Blocks {

	/**
	* This plugin's instance.
	*
	* @var WPBlockDev_Register_Blocks
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
		add_action( 'init', array( $this, 'register_blocks' ), 99 );
	}

	/**
	* Register block type
	*/
	public function register_block_type( $block, $options = array() ) {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		register_block_type(
			WP_BLOCK_DEV_PLUGIN_DIR . '/build/blocks/' . $block,
			$options
		);
	}

	/**
	* Register blocks.
	*
	* @access public
	*/
	public function register_blocks() {
		$this->register_block_type( 'accordion' );
		$this->register_block_type( 'slider' );
		$this->register_block_type( 'slider/slide' );
		$this->register_block_type( 'term-query' );
	}

}

$WPBlockDev_Register_Blocks = WPBlockDev_Register_Blocks::get_instance();