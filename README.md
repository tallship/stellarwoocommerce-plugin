# stellarwoocommerce-plugin
This is a plugin for wordpress woocommerce use at checkout

This is the first version and it will be update with more features soon.

ROAD MAP
1, Add QRCODE
2, Timer setting in Wooocommerce


For now the initial timer is set at 180 seocnds  and second try at 120 seconds.
you can change this in the public/partials/stellar-public-display.php

line 84-93 
you will have something like this 
///////////////////////////////////////////////
var count = 180;
  var score = 1;  
  function timer()
  {
  
  if (count <= 0)
  {
      if(score == 1){
        score = 2;
        count = 120;
        
/////////////////////////////////////////////


here you will be able to change the timer from 180 and 120 to whatever you want.
        
