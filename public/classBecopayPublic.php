<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://becopay.com
 * @since      1.0.0
 *
 * @package    Becopay
 * @subpackage Becopay/public
 */


/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Becopay
 * @subpackage Becopay/public
 * @author     Becopay Team <io@becopay.com>
 */
class BecopayPublic {

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
	 * @param      string    $becopay       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $becopay, $version ) {

		$this->becopay = $becopay;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->becopay, plugin_dir_url( __FILE__ ) . 'css/becopay-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->becopay, plugin_dir_url( __FILE__ ) . 'js/becopay-public.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Require BecopayGateway class file
     *
     * @since    1.0.0
     */
    public function init_gateway(){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/classBecopayGateway.php';
    }

    /**
     * Defining BecopayGateway class
     * @param $methods
     * @return array
     *
     * @since    1.0.0
     */
    public function load_gateway($methods){
        $methods[] = 'BecopayGateway';
        return $methods;
    }
}
