<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://xlm.mwplug.com
 * @since      1.0.0
 *
 * @package           Stellar Lumens 
 * @subpackage Stellar/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package           Stellar Lumens 
 * @subpackage Stellar/includes
 * @author     MWPLUG
 */
class Stellar_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
                
             global $wpdb;
             $table_name = "stellar";
             $sql = "DROP TABLE IF EXISTS $table_name;";
             $wpdb->query($sql);
             delete_option("my_plugin_db_version");
	}

}
