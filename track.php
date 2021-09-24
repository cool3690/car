<!DOCTYPE html>
<html>
<head>
	<title>Quick Start - Leaflet</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
<body>

<div id="mapid" style="width: 800px; height: 600px;"></div>
	<?php
		include 'carnumer.php';
		ini_set('date.timezone','Asia/Taipei');	
		$sdate = date("Y~m~d");
		$stime = date("h~m");
		//----- 定義要擷取的網頁地址
		$url = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId=2010260202&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		// $url = "http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=1906270011&BeginTime=2020~11~18~00~00~00&EndTime=2020~11~18~23~59~59"; 
		// echo $url.'<br>';


		$json = file_get_contents($url);
		// print_r($json);
		// $json_data = json_decode($json, true);
		// echo "My token: ". $json_data;
		// echo "My token: ". $json_data["GpsHistoryTrackInfo"];
		// $json_data2 = json_decode($json_data, true);
		// echo "My token: ". $json_data2["tm"];
 $content='';
//OpenStreetMap 
		$arr = json_decode($json, true);
		
		$arr2 =$arr["GpsHistoryTrackInfo"];
		$count=count($arr2)-1;
		foreach ($arr2 as $key => $value){
			if($key<$count){
			$content.='['.$value["la"].','.$value["lo"].'],';
			}else{
			$content.='['.$value["la"].','.$value["lo"].']';
			// echo $content;
			}
		}
echo"
		
			<script>

				var mymap = L.map('mapid').setView([23.112923, 120.3381856], 13);

				L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					maxZoom: 18,
					id: 'mapbox/streets-v11',
					tileSize: 512,
					zoomOffset: -1
				}).addTo(mymap);
				
				var polyline = new L.Polyline([$content],
				{
				  color: 'red',
				  weight: 5,
				  opacity: 1 }).
				addTo(mymap);				
			</script>
";
		?>
</body>
</html>