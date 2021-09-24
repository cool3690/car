<?php
require_once("db.php");
$date=date("Y/m/d");
	$license_plate=$_POST['license_plate'];
	 
  
$sql_login="SELECT driver FROM `car` where license_plate='$license_plate'";
$q=mysqli_query($db,$sql_login);
	 
   
while($e=mysqli_fetch_assoc($q))
$output[]=$e;
print(json_encode($output));
mysqli_close($q);
?>