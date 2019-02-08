<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
          echo "<h3 style='text-align:center'> Thank You. Your order status is ". $status .".</h3>";
          echo "<h4 style='text-align:center>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4 style='text-align:center>We have received a payment of Rs. " . $amount .;
          echo "<h4 style='text-align:center>This page will automatically redirect in 5 seconds." .;
		   }


?>	


<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv= "refresh" content="5; URL=https://google.com">
  </head>
</html>
