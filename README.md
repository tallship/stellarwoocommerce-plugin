# stellarwoocommerce-plugin
This is a plugin for wordpress woocommerce use at checkout

This is the first version and it will be update with more features soon.

### ROAD MAP ###
* __Add QRCODE__
* __Timer setting in Wooocommerce__


For now the initial timer at checkout is set at 180 seocnds  and second try at 120 seconds.
you can change this in the public/partials/stellar-public-display.php

line 84-93 
you will have something like this 
### /////////////////////////////////////////////// ###
var count = 180;
  var score = 1;  
  function timer()
  {
  
  if (count <= 0)
  {
      if(score == 1){
        score = 2;
        count = 120;
        
 ### ///////////////////////////////////////////// ###


here you will be able to change the timer at checkout from 180 and 120 to whatever you want.
        
