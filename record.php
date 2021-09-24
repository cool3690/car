 



<!DOCTYPE html>

<html lang="en">

<head>

	<title>Bootstrap Example</title>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	 
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

</head>

<body>
<?php 

require_once("db_login.php");
include 'carnumer.php';
    if ($_POST['car']!="") { 

	   $token = "uatg8slsz0D2Y7XRGml19RoZkZP8E6B1mowh95pzQHj";
	   $car=$_POST['car'];

	   $date=$_POST['date'];

	   $time=$_POST['time'];

	   $place=$_POST['place'];
	   ini_set('date.timezone','Asia/Taipei');	
	   $sdate = date("Y~m~d");
	   $stime = date("h~m");
	   /*
	    $car="788-UG";
	    $place="chansing";
	    $date="20210521";
	    $time="0933";
	    */
	   if($car=="KLE-5592"){$num=0;}
	   else if($car=="788-UG"){$num=1;}
	   else if($car=="785-UG"){$num=2;}
	   else if($car=="233-VG"){$num=3;}
	   else if($car=="787-VG"){$num=4;}
	   $car_id=array( "2010260204","2010260206","2010260205","2010260203","2010260202");


		$url6 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId='.$car_num[$car].'&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 

		$json6 = file_get_contents($url6);


		//OpenStreetMap 

		$arr6 = json_decode($json6, true);

		$arr6_2 =$arr6["GpsHistoryTrackInfo"];

		$count6=count($arr6_2)-1;
		
		$la6=$arr6["GpsHistoryTrackInfo"][$count6]["la"];
		
		$lo6=$arr6["GpsHistoryTrackInfo"][$count6]["lo"];

	 

	   $message ="\n車牌:".$car."\n日期:".$date."\n時間:".$time."\n地點:".$place."\n經度: ".$la6."\n緯度: ".$lo6;

	   $curl = curl_init(); 

	   curl_setopt($curl, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 

	   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 

	   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 

	   curl_setopt($curl, CURLOPT_POST, 1); 

	   curl_setopt($curl, CURLOPT_POSTFIELDS, "message=$message"); 

	   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 

	   $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$token.'',); 

	   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 

	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 

	   $result = curl_exec($curl); 

	   // if(curl_error($curl)) { 

		   // echo 'error:' . curl_error($curl); 

	   // } 

	   // else { 

		   // $result_ = json_decode($result, true); 

		   // echo "status : ".$result_['status']; 

		   // echo "message : ". $result_['message']; 

	   // } 

	   curl_close($curl);  

	$sql="insert into clsm_report (car,date,time,place,la,lo) values ('$car','$date','$time','$place','$la6','$lo6')";

$q=mysqli_query($db, $sql);



print(json_encode($output));

mysql_close();

    }

?>

</body>

</html>