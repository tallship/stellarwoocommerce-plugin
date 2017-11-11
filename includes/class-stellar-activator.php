<?php

/**
 * Fired during plugin activation
 *
 * @link       http://xlm.mwplug.com
 * @since      1.0.0
 *
 * @package           Stellar Lumens 
 * @subpackage Stellar/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package           Stellar Lumens 
 * @subpackage Stellar/includes
 * @author     MWPLUG
 */
class Stellar_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
                
                global $wpdb;
                $your_table_name="stellar";
 
                // create the ECPT metabox database table
                if($wpdb->get_var("show tables like '$your_table_name'") != $your_table_name) 
                {
                        $sql = "CREATE TABLE " . $your_table_name . " (
                        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                        `api_key` text NOT NULL,
                        UNIQUE KEY id (id)
                        );";

                        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
                        dbDelta($sql);
                }
	}

}
