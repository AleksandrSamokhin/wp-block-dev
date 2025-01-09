<?php
/**
 * Plugin Name: WP Block Dev
 * Plugin URI: https://deothemes.com
 * Description: Gutenberg Blocks for WordPress
 * Version: 0.1
 * Requires at least: 5.5
 * Tested up to: 6.7
 * Author: DeoThemes
 * Author URI: https://deothemes.com
 * Text Domain: wp-block-dev
 * License: GPL v2 or later
 * License URI: http: //www.gnu.org/licenses/gpl-2.0.txt
 * 
 * @package WP Block Dev
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WP_BLOCK_DEV_VERSION', '0.1' );
define( 'WP_BLOCK_DEV_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_BLOCK_DEV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_BLOCK_DEV_PLUGIN_BASE', plugin_basename( __FILE__ ) );

if ( ! class_exists( 'WPBlockDev' ) ) :
	/**
	* Main WPBlockDev Class.
	*
	* @since 1.0.0
	*/
	final class WPBlockDev {

		/**
		 * This plugin's instance.
		 *
		 * @var WPBlockDev
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		* Main WPBlockDev Instance.
		*
		* Insures that only one instance of WPBlockDev exists in memory at any one
		* time. Also prevents needing to define globals all over the place.
		*
		* @since 1.0.0
		* @static
		* @return object|WPBlockDev The one true WPBlockDev
		*/
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WPBlockDev ) ) {
				self::$instance = new WPBlockDev();
				self::$instance->init();
				self::$instance->includes();
			}
			return self::$instance;
		}

		/**
		 * Load actions
		 *
		 * @return void
		 */
		private function init() {
			add_filter( 'block_categories_all', array( $this, 'register_block_categories' ), 10, 2 );
			// add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			// add_action( 'enqueue_block_editor_assets',  array( $this, 'enqueue_editor_scripts' ) );
		}

		/**
		 * Register blocks categories
		 */
		public function register_block_categories( $categories ) {
			return array_merge(
				$categories,
					array(
						array(
							'slug' => 'wp-block-dev-category',
							'title' => __( 'WP Block Dev', 'wp-block-dev' )
						)
					)
				);
		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @since 1.0.0
		 * @return void
		 */
		private function includes() {
		}

	}

endif;

/**
 * The main function for that returns WPBlockDev
 *
 * The main function responsible for returning the one true WPBlockDev
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $WPBlockDev = WPBlockDev(); ?>
 *
 * @since 1.0.0
 * @return object|WPBlockDev The one true WPBlockDev Instance.
 */
function WPBlockDev() {
	return WPBlockDev::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	add_action( 'plugins_loaded', 'WPBlockDev', 90 );
} else {
	WPBlockDev();
}