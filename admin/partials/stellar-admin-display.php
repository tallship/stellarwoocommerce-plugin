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
    <div class="row col-md-7">
  <div class="form-group">
    <label for="email">Api key:</label>
    <input type="text" class="form-control" name="api_key" value="<?php echo $api_key; ?>" id="api_key">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  
    </div>
<div class="row col-md-6">
    <h4>Note : Use [staller_front] shortcode in which page you want to display</h4>
</div>
</form>
<br/><br/>
