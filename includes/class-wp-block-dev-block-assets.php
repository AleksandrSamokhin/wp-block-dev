<?php
/**
 * Load assets for our blocks.
 *
 * @package WP Block Dev
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load general assets for our blocks.
 *
 * @since 1.0.0
 */
class WPBlockDev_Block_Assets {
	/**
	 * Plugin's instance.
	 *
	 * @var WPBlockDev_Block_Assets
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
		add_filter( 'render_block', array( $this, 'blocks_scripts' ), 10, 2 );
	}

	/**
	* Loads the asset file for the given script or style.
	* Returns a default if the asset file is not found.
	*
	* @param string $filepath The name of the file without the extension.
	*
	* @return array The asset file contents.
	*/
	public function get_asset_file( $filepath ) {
		$asset_path = WP_BLOCK_DEV_PLUGIN_DIR . $filepath . '.asset.php';

		return file_exists( $asset_path )
			? include $asset_path
			: array(
				'dependencies' => array(),
				'version'      => WP_BLOCK_DEV_PLUGIN_VERSION,
			);
	}

	/**
	 * Blocks scripts
	 */
	public function blocks_scripts( $block_content, $block ) {
		if ( empty( $block['blockName'] ) ) {
			return $block_content;
		}

		if ( 'wp-block-dev/slider' === $block['blockName'] ) {
			$asset_file = $this->get_asset_file( 'build/js/swiper/index' );
			wp_enqueue_script(
				'wp-block-dev-swiper',
				WP_BLOCK_DEV_PLUGIN_URL . 'build/js/swiper/index.js',
				array(),
				$asset_file['version'],
				true
			);
		}

		return $block_content;

	}

}

$WPBlockDev_Block_Assets = WPBlockDev_Block_Assets::get_instance();
