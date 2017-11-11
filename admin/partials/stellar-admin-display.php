<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://xlm.mwplug.com
 * @since      1.0.0
 *
 * @package           Stellar Lumens 
 * @subpackage Stellar/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<?php
$success=0;
$table_name = "stellar";
if(isset($_REQUEST['submit'])){
    global $wpdb;
    $api_key = $_REQUEST['api_key'];
//    $App_credit_charge_per_each_use = $_REQUEST['App_credit_charge_per_each_use'];
    $wpdb->query("DELETE FROM $table_name");
    $wpdb->query("INSERT INTO $table_name (api_key) VALUES ('$api_key')"  );
    $success=1;
}

global $wpdb;
$result = $wpdb->get_results ( "SELECT * FROM $table_name" );
$api_key = $result[0]->api_key;
        


?>

<h1>Stellar</h1>
<?php
if($success==1){?>
<div class="alert alert-success col-md-7">
  <strong>Success!</strong> Data inserted successfully.
</div>
<?php }?>
<form method="post">
  <div class="row col-md-6">
    <h4>Stay up to date with the latest from MWPLUG <br />
    <a href="xlm.mwplug.com">Stellar Lumen version </a>
    <br />
    <a href="mwplug.com">Mobius version </a><br />
    <b> Support: info@mwplug.com<br />
    Donate :GDM4HME3REOISXX4NK5NE3ZGGVAM47O5XDYNKF7F7AYMBCMP2CFGSIQP</b> </h4>
</div>
</form>
<br/><br/>
