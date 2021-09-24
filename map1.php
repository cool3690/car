<!DOCTYPE html>
<html>
<head>
	 
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<meta http-equiv="refresh" content="45;">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
  <?php
  	include 'carnumer.php';
	$num="KLG-6582";
 	if(isset($_GET['num'])){
				 $num = $_GET['num'];
			 }
?>
<body>
      <div id="mapid6" style="width: 600px; height: 600px;"></div>
	 
	<!--
	<center><br>
			<form method="post" action="map1.php" id="login_index"  >
            
                   <select name="mycar" id="mycar" style="width: 300px" onchange="submit(this.value);">
    
    <option value="0"  >KLE-5592</option>
    <option value="1"   >788-UG</option>
    <option value="2"  >785-UG</option>
    <option value="3"  >233-VG</option>
    <option value="4"   >787-VG</option>
    
</select><br> 
  </form> 
  -->
  
  
		 
		
		<!--
		
			<div class="col-sm-12 col-md-3 col-lg-3 mt-3">	
				<div id="mapid5" style="width: 95%; height: 300px;"></div>
			</div>
			-->
	 
		<?php
		 
		//if(isset($_POST['mycar']) ){$num=$_POST['mycar'];
		//setcookie("mycar", $num); 
 
		//}
	//	else if(isset($_COOKIE['mycar'])){$num=$_COOKIE['mycar'];}
		 
		//if(isset($_POST['mycar']) ||isset($_COOKIE['mycar'])){
			
			//$num=$_POST['mycar'];
		
		
							ini_set('date.timezone','Asia/Taipei');	
							$sdate = date("Y~m~d");
							$stime = date("h~m");
						//	$car_id=array( "2010260204","2010260206","2010260205","2010260203","2010260202");
		//----- 定義要擷取的網頁地址
		/* 
		// $url1 = 'http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=1906270011&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url2 = 'http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=2010260204&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url3 = 'http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=2010260206&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url4 = 'http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=2010260205&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url5 = 'http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=2010260203&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		*/
		$url6 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId='.$car_num[$num].'&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		// $url = "http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=1906270011&BeginTime=2020~11~18~00~00~00&EndTime=2020~11~18~23~59~59"; 
		// echo $url.'<br>';
 
		$json6 = file_get_contents($url6);
		 

//OpenStreetMap 
	 
		$arr6 = json_decode($json6, true);
	 
		$arr6_2 =$arr6["GpsHistoryTrackInfo"];
		
		$count6=count($arr6_2)-1;
	 
		 
		$la6=$arr6["GpsHistoryTrackInfo"][$count6]["la"];
		
		 
	 
		$lo6=$arr6["GpsHistoryTrackInfo"][$count6]["lo"];
		
				 
	
		echo "
			<script>			
				  
			 
				var cars = [ 'KLE-5592', '788-UG','785-UG','233-VG','787-VG' ];
				var mymap = L.map('mapid6').setView([$la6, $lo6], 13);
	
				var caricon = L.icon({
					iconUrl: 'http://map.chansing.com.tw/car.png',
					iconSize: [100, 80],
					popupAnchor: [0, -20]
				});		

				L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					maxZoom: 18,
					id: 'mapbox/streets-v11',
					tileSize: 512,
					zoomOffset: -1
				}).addTo(mymap);
				var marker = L.marker([$la6, $lo6], {icon: caricon}).addTo(mymap).bindPopup($num).openPopup();
				// -------------------------------------------------------------------------------------------------------------------------------------
						
			</script>
		";
		// }
		//}
		?>
</body>
</html>