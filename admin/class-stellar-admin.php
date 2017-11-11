<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://xlm.mwplug.com
 * @since      1.0.0
 *
 * @package           Stellar Lumens 
 * @subpackage Stellar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package           Stellar Lumens 
 * @subpackage Stellar/admin
 * @author     MWPLUG
 */
class Stellar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
                
                                      /**
                 * Register a custom menu page.
                 */
                include( plugin_dir_path( __FILE__ ) . 'woocommerce-gateway-offline.php'); 
                function wpdocs_register_my_staller_menu_page(){
                    add_menu_page( 
                        __( 'Custom Menu Title', 'textdomain' ),
                        'Staller',
                        'manage_options',
                        'stellarpage',
                        'my_stellar_menu_page',
                        plugins_url( '/stellar/images/icon.png' ),
                        6
                    ); 
                }
                add_action( 'admin_menu', 'wpdocs_register_my_staller_menu_page' );

                /**
                 * Display a custom menu page
                 */
                function my_stellar_menu_page(){
                     include( plugin_dir_path( __FILE__ ) . 'partials/stellar-admin-display.php'); 
                }
                

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
		 * defined in Stellar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Stellar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/stellar-admin.css', array(), $this->version, 'all' );

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
		 * defined in Stellar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Stellar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/stellar-admin.js', array( 'jquery' ), $this->version, false );

	}

}
