<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://becopay.com
 * @since      1.0.0
 *
 * @package    Becopay
 * @subpackage Becopay/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Becopay
 * @subpackage Becopay/admin
 * @author     Becopay Team <io@becopay.com>
 */
class BecopayAdmin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $becopay    The ID of this plugin.
	 */
	private $becopay;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $becopay       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $becopay, $version ) {

		$this->becopay = $becopay;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BecopayLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BecopayLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->becopay, plugin_dir_url( __FILE__ ) . 'css/becopay-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BecopayLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BecopayLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->becopay, plugin_dir_url( __FILE__ ) . 'js/becopay-admin.js', array( 'jquery' ), $this->version, false );

	}

}
