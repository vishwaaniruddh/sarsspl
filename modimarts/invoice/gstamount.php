<?php
function getGstincluded($amount,$percent,$cgst,$sgst){
   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2);
   $percentsgst =  number_format($gst_amount/2, 2);
   $display="<p>";
   if($cgst&&$sgst){
      $gst = $percentcgst + $percentsgst;
      $display .= " CGST = ".$percentcgst." SGST = " . $percentsgst;
   }elseif($cgst){
      $gst = $percentcgst;
      $display .= " CGST = ".$percentcgst;
   }else{
      $gst = $percentsgst;
      $display .= " SGST = ".$percentsgst;
   }
   $withoutgst = number_format($amount - $gst_amount,2);
   $withgst = number_format($withoutgst + $gst_amount,2);
   $display .="</p>";
   $display .="<p>".$withoutgst . " + " . $gst . " = " . $withgst."</p>";
   return $display;
}
function getGstexcluded($amount,$percent,$cgst,$sgst){
   $gst_amount = ($amount*$percent)/100;
   $amountwithgst = $amount + $gst_amount;   
   $percentcgst = number_format($gst_amount/2, 2);
   $percentsgst =  number_format($gst_amount/2, 2);
   $display="<p>";
   if($cgst&&$cgst){
      $gst = $percentcgst + $percentsgst;
      $display .= " CGST = ".$percentcgst." SGST = " . $percentsgst;
   }elseif($cgst){
      $gst = $percentcgst;
      $display .= " CGST = ".$percentcgst;
   }else{
      $gst = $percentsgst;
      $display .= " SGST = ".$percentsgst;
   }
   $display .="</p>";
   $display .="<p>".$amount . " + " . $gst . " = " . $amountwithgst."</p>";
   return $display;
}

function simplegstincluded($amount,$percent){
   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 3);
   $percentsgst = number_format($gst_amount/2, 3);
   $withoutgst = number_format($amount - $gst_amount,2);
   $total = number_format($withoutgst+$gst_amount, 2);
   
   $display="<p>".$withoutgst." + ".number_format($gst_amount,2)." ( CGST = ".$percentcgst." SGST = " . $percentsgst." ) = " . $total."</p>";
   return $display;
}

function simplegstexcluded($amount,$percent){
   $gst_amount = ($amount*$percent)/100;
   $total = number_format($amount+$gst_amount, 2);
   $percentcgst = number_format($gst_amount/2, 3);
   $percentsgst = number_format($gst_amount/2, 3);
   
   $display="<p>".$amount." + ".number_format($gst_amount,2)." ( CGST = ".$percentcgst." SGST = " . $percentsgst." ) = " . $total."</p>";
   return $display;
}

echo simplegstincluded(531, 18);
echo simplegstexcluded(531, 118);
echo "GST Included Already ";
echo getGstincluded(15,5,true,true); 
echo "GST Included After ";
echo getGstexcluded(531,18,true,true);

?>