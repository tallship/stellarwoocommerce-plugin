<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://xlm.mwplug.com
 * @since      1.0.0
 *
 * @package           Stellar Lumens 
 * @subpackage Stellar/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php 

//global $wpdb;
//
//$appTable =  "mobius";
//global $wpdb;
//$result = $wpdb->get_results ( "SELECT * FROM ".$appTable );
//$api_key = $result[0]->api_key;
//$app_uid = $result[0]->app_uid;
//$app_credit_charge_per_each_use = $charge_val;


?>
<?php
    $str_1 = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str_2 = 'aBcEeFgHiJkLmNoPqRstUvWxYz0123456789';
    $memo = substr(str_shuffle($str_1),0, 1) . substr(str_shuffle($str_2),0, 11);
    // $memo = 'yeBU78sMXZJ5';

?>
<div class="container">
  <div class="row">
   <div class="col-md-12 played-games">
    <h4 class="section-title">Pay to above wallet with memo <strong><label id="memo_lbl"><?php echo $memo; ?></label></strong></h4>
    <form class="form-group">
        <label for="waiting_loader" id="waiting_loader">Waiting for your transaction.&nbsp;&nbsp;<span id="timing_instruction">
      </span> </label>
    </form>
  </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar-sdk/0.7.3/stellar-sdk.js"></script>

<script type="text/javascript">
    
  
  var memo_element = document.getElementById("memo_lbl");
  memo_element.innerHTML= randomString(12, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
  // memo_element.innerHTML = "v5o1kXhtLbyw";
  var current_selected_method = '';
  // When radio button is clicked. 
  jQuery("input[name='payment_method']").change(function(){
    
    current_selected_method = jQuery(this).val();
    if(jQuery(this).val() == "stellar_gateway") {
          var counter=setInterval(timer, 1000);
          // jQuery('#place_order').attr('disabled','disabled');
          var checkout_btn = "input[name='woocommerce_checkout_place_order']";
    jQuery(checkout_btn).on('click',function()
    {
     
    if(current_selected_method == "stellar_gateway") {
         var previous_text = jQuery(this).val();
         jQuery(checkout_btn).val("Please wait ...");
         var paymentTo = jQuery("#wallet_address_lbl").html();
         var memo = jQuery("#memo_lbl").html();
         checkStellarPaymentStatus(paymentTo,memo);
    }
     });
    }else{
      jQuery('#place_order').removeAttr('disabled','disabled');
      
    }
});
  
  var count = 180;
  var score = 1;  
  function timer()
  {
  
  if (count <= 0)
  {
      if(score == 1){
        score = 2;
        count = 120;
        var paymentTo = jQuery("#wallet_address_lbl").html();
        var memo = jQuery("#memo_lbl").html();
        checkStellarPaymentStatus(paymentTo,memo);
        document.getElementById("waiting_loader").innerHTML= "<button type='button' id='get_memo_code' onclick='change_memo_code()'>Get another memo</button>";
        jQuery('#place_order').removeAttr('disabled','disabled');
        jQuery('#memo_lbl').html('');
      }
      else{
        //clearInterval(counter);
        var paymentTo = jQuery("#wallet_address_lbl").html();
        var memo = jQuery("#memo_lbl").html();
        checkStellarPaymentStatus(paymentTo,memo);
        document.getElementById("waiting_loader").innerHTML= " <h3>Time Expired! </h3>";
        memo_element.innerHTML = '';
        jQuery('#place_order').removeAttr('disabled','disabled');
        return;
      }
  }


 document.getElementById("timing_instruction").innerHTML=count + " Seconds remaining..."; // watch for spelling
 count=count-1;
}
function change_memo_code() {
    memo_element.innerHTML= randomString(12, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    document.getElementById("waiting_loader").innerHTML= " Waiting for your transaction.&nbsp;&nbsp;<span id='timing_instruction'></span>";
   jQuery('#place_order').attr('disabled','disabled');
    timer();
}
function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}

    jQuery.ajaxQ = (function(){
    var id = 0, Q = {};

    jQuery(document).ajaxSend(function(e, jqx){
      jqx._id = ++id;
      Q[jqx._id] = jqx;
    });
    jQuery(document).ajaxComplete(function(e, jqx){
      delete Q[jqx._id];
    });

    return {
      abortAll: function(){
        var r = [];
        jQuery.each(Q, function(i, jqx){
          r.push(jqx._id);
          jqx.abort();
        });
        return r;
      }
    };

  })();

  jQuery(document).ready(function()
  {
    //when stellar already selected on load time
    var selected_payment_method = jQuery('input[name=payment_method]:checked').val();
    var checkout_btn = "input[name='woocommerce_checkout_place_order']";
    if(selected_payment_method == "stellar_gateway"){
         jQuery('#place_order').attr('disabled','disabled');
         var paymentTo = jQuery("#wallet_address_lbl").html();
         var memo = jQuery("#memo_lbl").html();
         var counter=setInterval(timer, 1000);
         var previous_text = jQuery(this).val();
         jQuery(checkout_btn).val("Please wait ...");
         // checkStellarPaymentStatus(paymentTo,memo);
    }
  
    /*jQuery(checkout_btn).on('click',function()
    {
    if(selected_payment_method == "stellar_gateway" && current_selected_method == '') {
         var previous_text = jQuery(this).val();
         jQuery(checkout_btn).val("Please wait ...");
         var paymentTo = jQuery("#wallet_address_lbl").html();
         var memo = jQuery("#memo_lbl").html();
         jQuery(checkout_btn).attr('disabled','disabled');
         var counter=setInterval(timer, 1000);
         checkStellarPaymentStatus(paymentTo,memo);
    }
     }); */
  }); 

  function checkStellarPaymentStatus(paymentTo,memo)
  {
    var server = new StellarSdk.Server('https://horizon.stellar.org');
    var api_url = "<?php echo  plugins_url( 'stellar_api.php', dirname(__FILE__) )   ?>"; 
    var accountId = paymentTo;
    if(!isPublicKeyValid(accountId))
    {
      alert('Invalid wallet address.');
      return;
    }
    var reference_number = memo;
    var payments = server.transactions().forAccount(accountId).limit(100);
    var lastToken = loadLastPagingToken();
    var recordCounter = 1;
    if (lastToken) {
      payments.cursor(lastToken);
    }

    records = [];

    server.transactions()
      .forAccount(paymentTo)
      .limit(100)
      .call()
      .then(function (accountResult) {
        records = accountResult.records;
        // console.log(records.length);
        jQuery.ajaxQ.abortAll();
        jQuery.each(accountResult.records,function(index,value)
        {
          payment = value;
          // console.log(payment);
          // if(payment.to == paymentTo)
          {
            var transactionLink = payment._links.self.href;
            // console.log("transaction link is "+transactionLink);
            var splitTransaction = transactionLink.split("/");
            var transactionHash = splitTransaction[(splitTransaction.length-1)];
            server.transactions()
            .transaction(transactionHash)
            .call()
            .then(function (transactionResult) {
              console.log(transactionResult);
              if(typeof transactionResult.memo!='undefined' && transactionResult.memo==reference_number)
              {
                // console.log(jQuery("form[name='checkout']").length);
                jQuery("form[name='checkout']").submit();
              }
              else if(recordCounter==records.length)
              {
                // alert('Payment is not made.');
                // jQuery.ajaxQ.abortAll();
                /*jQuery.ajax({
                url : api_url,
                data : {action:"delete-last-mobius-order"},
                success : function(response){
                  // alert("OID is "+response);
                }
                });*/
              }

            })
            .catch(function (err) {
              console.log(err)
            })
          }
          recordCounter++;
        });
      })
      .catch(function (err) {
        console.error(err);
    });
  }

  function isPublicKeyValid(accountId)
  {
    // var accountId = 'GCEZWKCA5VLDNRLN3RPRJMRZOX3Z6G5CHCGSNFHEYVXM3XOJMDS674JZ';
    var strKey = StellarSdk.StrKey;
    var server = new StellarSdk.Server('https://horizon.stellar.org');
    return strKey.isValidEd25519PublicKey(accountId);
  }

  function loadLastPagingToken() {
    if(typeof window.lastToken!='undefined' && window.lastToken!='')
    {
      return window.lastToken;
    }
    else
    {
      return '';
    }
  }

</script>
