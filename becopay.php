<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://becopay.com
 * @since             1.1.2
 * @package           Becopay
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Becopay Payment Gateway
 * Plugin URI:        https://becopay.com/en/io/#Woocommerce-Becopay-Gateway
 * Description:       A woocommerce payment gateway for becopay.
 * Version:           1.1.1
 * Author:            Becopay Team <io@becopay.com>
 * Author URI:        https://becopay.com/
 * License:           Apache-2.0
 * License URI:       https://github.com/becopay/Woocommerce-Becopay-Gateway/LICENSE.txt
 * Text Domain:       becopay
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.1.2
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BECOPAY_VERSION', '1.1.2' );


/**
 * WooCommerce requirement configuration
 */
define('BECOPAY_ID','becopay-gateway');//Unique ID for your gateway
define('BECOPAY_ICON',plugin_dir_url(__FILE__).'/public/image/becopay.png'); // Gateway icon
define('BECOPAY_TITLE','Becopay'); // Title of the payment method shown on the front page
define('BECOPAY_DESCRIPTION','Pay via becopay: pay economically with cryptocurrency'); // Description for the payment method shown on the front page.
define('BECOPAY_PANEL_DESCRIPTION','Allow customers to pay cryptocurrency'); // Description for the payment method shown on the admin page.
define('BECOPAY_MERCHANT_CURRENCY','IRR'); // Merchant default currency.

/**
 * Plugin update checking requirement configuration
 */
define('BECOPAY_UPDATE_CHECK_LINK','https://github.com/becopay/Woocommerce-Becopay-Gateway');
define('BECOPAY_SLUG','Woocommerce-Becopay-Gateway');//Slug name

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/classBecopayActivator.php
 */
function activate_becopay() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/classBecopayActivator.php';
	BecopayActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/classBecopayDeactivator.php
 */
function deactivate_becopay() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/classBecopayDeactivator.php';
	BecopayDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_becopay' );
register_deactivation_hook( __FILE__, 'deactivate_becopay' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/classBecopay.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_becopay() {

	$plugin = new Becopay();
	$plugin->run();

}
run_becopay();
