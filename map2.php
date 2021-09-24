<!DOCTYPE html>
<html>
<head>
	 
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<meta http-equiv="refresh" content="15;">
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>
  <script src="~/Scripts/leaflet-0.7.3.js"></script>
<link href="~/Content/leaflet.css" rel="stylesheet" />
<script src="~/Scripts/jquery-1.10.2.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
 
  
.marker-pin {
width: 30px;
height: 30px;
border-radius: 50% 50% 50% 0;
background: #c30b82;
position: absolute;
transform: rotate(-45deg);
left: 50%;
top: 50%;
margin: -10px 0 0 -13px;
}

.marker-pin::after {
content: '';
width: 24px;
height: 24px;
margin: 3px 0 0 3px;
background: #fff;
position: absolute;
border-radius: 50%;
}

.custom-div-icon i {
position: absolute;
width: 22px;
font-size: 22px;
left: 0;
right: 0;
margin: 10px auto;
text-align: center;
}

.custom-div-icon i.awesome {
margin: 12px auto;
font-size: 17px;
}

.another-popup .leaflet-popup-content-wrapper {
background: #FFCC22;
color: black;
font-size: 12px;
line-height: 10px;
border-radius: 10px;
}

.another-popup .leaflet-popup-tip{
background: #FFCC22;
}
</style>

<body>
	<?php
		include 'carnumer.php';
		 ini_set('date.timezone','Asia/Taipei');	
		 $sdate = date("Y~m~d");
		 $stime = date("h~m");
		  				 
		//----- 定義要擷取的網頁地址
		// $url1 = 'http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=1906270011&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url2 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId=2010260204&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url3 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId=2010260206&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url4 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId=2010260205&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url5 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId=2010260203&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$url6 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId=2010260202&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		// $url = "http://211.23.243.109:6060/GetGpsHistoryTrack/100?DeviceId=1906270011&BeginTime=2020~11~18~00~00~00&EndTime=2020~11~18~23~59~59"; 
		// echo $url.'<br>';


		// $json1 = file_get_contents($url1);
		$json2 = file_get_contents($url2);
		$json3 = file_get_contents($url3);
		$json4 = file_get_contents($url4);
		$json5 = file_get_contents($url5);
		$json6 = file_get_contents($url6);
		// print_r($json);
		// $json_data = json_decode($json, true);
		// echo "My token: ". $json_data;
		// echo "My token: ". $json_data["GpsHistoryTrackInfo"];
		// $json_data2 = json_decode($json_data, true);
		// echo "My token: ". $json_data2["tm"];

//OpenStreetMap 
		// $arr1 = json_decode($json1, true);
		$arr2 = json_decode($json2, true);
		$arr3 = json_decode($json3, true);
		$arr4 = json_decode($json4, true);
		$arr5 = json_decode($json5, true);
		$arr6 = json_decode($json6, true);
		
		// $arr1_2 =$arr1["GpsHistoryTrackInfo"];
		$arr2_2 =$arr2["GpsHistoryTrackInfo"];
		$arr3_2 =$arr3["GpsHistoryTrackInfo"];
		$arr4_2 =$arr4["GpsHistoryTrackInfo"];
		$arr5_2 =$arr5["GpsHistoryTrackInfo"];
		$arr6_2 =$arr6["GpsHistoryTrackInfo"];
		
		// $count1=count($arr1_2)-1;
		$count2=count($arr2_2)-1;
		$count3=count($arr3_2)-1;
		$count4=count($arr4_2)-1;
		$count5=count($arr5_2)-1;
		$count6=count($arr6_2)-1;
		 
		// if($count<0){
			// echo "目前無資料";
		// }else{
		// echo $count.'<br>';
		// echo '緯度：'.$arr1["GpsHistoryTrackInfo"][$count1]["la"].'<br>';
		// echo '經度：'.$arr1["GpsHistoryTrackInfo"][$count1]["lo"].'<br>';
		// $la1=$arr1["GpsHistoryTrackInfo"][$count1]["la"];
		if($count2>0){
			$la2=$arr2["GpsHistoryTrackInfo"][$count2]["la"];
			$lo2=$arr2["GpsHistoryTrackInfo"][$count2]["lo"];
		}
		else{
			$la2="null";$lo2="null";
		}
		if($count3>0){
			$la3=$arr3["GpsHistoryTrackInfo"][$count3]["la"];
			$lo3=$arr3["GpsHistoryTrackInfo"][$count3]["lo"];
		}
		else{
			$la3="null";$lo3="null";
		}
		 if($count4>0){
			$la4=$arr4["GpsHistoryTrackInfo"][$count4]["la"];
			$lo4=$arr4["GpsHistoryTrackInfo"][$count4]["lo"];
		}
		else{
			$la4="null";$lo4="null";
		}
		 if($count5>0){
			$la5=$arr5["GpsHistoryTrackInfo"][$count5]["la"];
			$lo5=$arr5["GpsHistoryTrackInfo"][$count5]["lo"];
		}
		else{
			$la5="null";$lo5="null";
		}
		 if($count6>0){
			$la6=$arr6["GpsHistoryTrackInfo"][$count6]["la"];
			$lo6=$arr6["GpsHistoryTrackInfo"][$count6]["lo"];
		}
		else{
			$la6="null";$lo6="null";
		}
		 
	 
?>
	<div id="mapid" style="width: 600px; height: 600px;"></div>
	
	<script type="text/javascript">
	//社區群資料
		var cars = [ 'KLE-5592', '788-UG','785-UG','233-VG','787-VG' ];
	var LocsA = [
	{ "record_id": 1, "lat": <?=$la2?>, "lon": <?=$lo2?>, "title": cars[0], "html": " ", "priority_no": 5, "colorcode": "#FF3333" },
	{ "record_id": 2, "lat": <?=$la3?>, "lon":<?=$lo3?> , "title": cars[1], "html": " ", "priority_no": 1, "colorcode": "#FF3333" },
	{ "record_id": 3, "lat": <?=$la4?>, "lon": <?=$lo4?>, "title": cars[2], "html": " ", "priority_no": 2, "colorcode": "#FF3333" },
	{ "record_id": 4, "lat": <?=$la5?>, "lon":<?=$lo5?> , "title": cars[3], "html": " ", "priority_no": 3, "colorcode": "#FF3333" },
	{ "record_id": 5, "lat": <?=$la6?>, "lon": <?=$lo6?>, "title": cars[4], "html": " ", "priority_no": 4, "colorcode": "#FF3333" }
	];
	//
	// 建立 Leaflet 地圖
	var map = L.map('mapid', {
	closePopupOnClick: false
	}).on('click', function () { /*this.closePopup();*/ });

	var PositionX0 = 23.1133103;
	var PositionY0 = 120.3355552;
	// 設定經緯度座標
	map.setView(new L.LatLng(PositionX0, PositionY0), 10);

	// 設定圖資來源
	var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
	var osm = new L.TileLayer(osmUrl/*, {minZoom: 8, maxZoom: 20}*/);
	map.addLayer(osm);
	
	var myIcon = L.icon({
	iconUrl: '001.png',
	iconSize: [50, 50], // size of the icon
	//shadowSize: [50, 64], // size of the shadow
	//iconAnchor: [PositionX0, PositionY0], // point of the icon which will correspond to marker's location
	//shadowAnchor: [4, 62], // the same for the shadow
	//popupAnchor: [PositionX0, PositionY0-220] // point from which the popup should open relative to the iconAnchor
	});

	var marker0 = L.marker([PositionX0, PositionY0]  ).addTo(map);

	//popup0 跟 marker0 各自獨立(兩者沒用bindPopup()做綁定)
	var popup0 = L.popup({
	className: 'another-popup',
	autoClose: false, 
	closeButton: false, //closeButton若改為true，則一旦popup0被關掉了，就沒辦法透過marker0打開
	//autoClose: false
	})
	.setLatLng([PositionX0, PositionY0])
	.setContent('<p style="text-align:center">全興</p>')
	.openOn(map);
	
	/*
	var circle = L.circle([PositionX0, PositionY0], // 圓心座標
	5000, // 半徑（公尺）
	{
	color: 'red', // 線條顏色
	fillColor: '#f03', // 填充顏色
	fillOpacity: 0.1 // 透明度
	}
	).addTo(map);
	*/

	var caricon = L.icon({
						iconUrl: 'http://map.chansing.com.tw/car.png',
						iconSize: [100, 80],
						popupAnchor: [0, -20]
					});		
	var marker;
	var custom_icon;
	var polyPos = [];

	$.each(LocsA.sort(function (a, b) { return a.priority_no - b.priority_no}), function (index, element) {
	if (element.lat != "" && element.lat != null && element.lon != "" && element.lon != null) { //沒加這X行就會把有問題GPS座標加入，整個地圖會壞掉(無法縮放及拖拉)
	if (element.priority_no == 0) //使用預設圖標
	{
	//marker = L.marker([element.lat, element.lon], {icon: caricon} ).addTo(map).bindPopup(element.title).openPopup();
	//marker;
	marker = L.marker([element.lat, element.lon], { icon: caricon }).addTo(map);
	marker.bindPopup(element.title, {
		autoClose: false, 
	closeOnClick: false
	}).openPopup();
	}
	else
	{
	polyPos.push([ parseFloat(element.lat), parseFloat(element.lon)]);
	custom_icon = L.divIcon({
	className: 'custom-div-icon',
	html: "<div style='background-color:" + element.colorcode + ";' class='marker-pin'></div><i class='fa-alph'>" + element.priority_no + "</i>",
	iconSize: [30, 42],
	//iconAnchor: [15, 42],
	popupAnchor: [element.lon -120 , element.lon - 130] //popup的顯示座標
	});
	marker = L.marker([element.lat, element.lon], { icon: caricon }).addTo(map);
	marker.bindPopup(element.title, {
		autoClose: false, 
	closeOnClick: false
	}).openPopup();
	}
	}
	});
	/*
	var polyline = L.polygon(polyPos, {
	color: 'blue', // 線條顏色
	fillColor: 'blue', // 填充顏色
	fillOpacity: 0.1 // 透明度
	}).addTo(map);
	*/

</script>
</body>
</html>