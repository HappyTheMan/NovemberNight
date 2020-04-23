<?php
  $hour = date("h")+5;
  $min = date("i");
  $mins = date("i")+30;

	$zone = date("A");
  if($mins > 60)
  {
    $hour++;
    $min = 30 - (60 - $min);
  }
  else
  {
    $min =$mins;
  }
  if ($min < 10) {
    $min = "0".$min;
  }
  echo $hour.":".$min." ". $zone;
 ?>
