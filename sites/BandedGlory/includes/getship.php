<?php
$szip=$_GET["szip"];
$scity=$_GET["scity"];
$service=$_GET["service"];

  $Url = join("&", array("http://www.ups.com/using/services/rave/qcostcgi.cgi?accept_UPS_license_agreement=yes",
   "10_action=3",
   "13_product=".$service,
   "14_origCountry=US",
   "15_origPostal=92704",
   "origCity=Santa Ana",
   "19_destPostal=".$szip,
   "20_destCity=".$scity,
   "22_destCountry=US",
   "23_weight=3",
   "47_rateChart=Regular+Daily+Pickup",
   "48_container=00",
   "49_residential=01",
   "25_length=5",
   "26_width=5",
   "27_height=5"));

   $Resp = fopen($Url, "r");
   while(!feof($Resp))
   {   
      $Result = fgets($Resp, 500);
      $Result = explode("%", $Result);
      $Err = substr($Result[0], -1);

      switch($Err)
      {
         case 3:
         $ResCode = $Result[8];
         break;
         case 4:
         $ResCode = $Result[8];
         break;
         case 5:
         $ResCode = $Result[1];
         break;
         case 6:
         $ResCode = $Result[1];
         break;
      }
   }
   fclose($Resp);
   if(!$ResCode)
   {
      $ResCode = "An error occured.";
   }
   echo $ResCode;
//}


?>