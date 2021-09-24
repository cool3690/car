<!DOCTYPE html>
<html>
<head>
	 
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<meta http-equiv="refresh" content="50;">
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
$num="KLG-6582";
include 'carnumer.php';
 if(isset($_GET['num'])){
				 $num = $_GET['num'];
			 }
?>
	<?php
		 ini_set('date.timezone','Asia/Taipei');	
		 $sdate = date("Y~m~d");
		 $stime = date("h~m");
	  $i=0;
	 foreach($car_num as $key=>$value){
		$url[$i] = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId='.$value.'&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		$json[$i] = file_get_contents($url[$i]);
		$arr[$i] = json_decode($json[$i], true);
		$arr2_[$i] =$arr[$i]["GpsHistoryTrackInfo"];
		$count[$i]=count($arr2_[$i])-1;


if($count[$i]>0){
			$la[$i]=$arr[$i]["GpsHistoryTrackInfo"][$count[$i]]["la"];
			$lo[$i]=$arr[$i]["GpsHistoryTrackInfo"][$count[$i]]["lo"];
			
		}
		else{
			$la[$i]="null";$lo[$i]="null";
			if($num==$key){
				echo $value.'目前不在線上';
			}
		}
		if($num==$key){$num2=$i;}
	$car_arr[$i]=$key;

		$i++;
	}
	$count=$i;	
	  
	 
?> 
<div id="mapid" style="width: 600px; height: 600px;"></div>
 
<script type="text/javascript">
//社區群資料n=1
var cars = [
<?php
for($i=0;$i<$count;$i++){?>
	  '<?=$car_arr[$i];?>',
	<?php
	}?>
];
	var LocsA = [
		<?php
		 for($i=0;$i<$count;$i++){
			 
		?>
	{ "record_id":<?=$i?>, "lat": <?=$la[$i]?>, "lon": <?=$lo[$i]?>, "title": cars[<?=$i?>], "html": " ", "priority_no": 0, "colorcode": "#FF3333" },
 	<?php
		}?>
];
	
 
	LocsA[<?=$num2?>]["priority_no"]=10;
	//
	// 建立 Leaflet 地圖
	var map = L.map('mapid', {
	closePopupOnClick: false
	}).on('click', function () { /*this.closePopup();*/ });

	var PositionX0 = LocsA[<?=$num2?>]["lat"];
	var PositionY0 = LocsA[<?=$num2?>]["lon"];
	// 設定經緯度座標
	map.setView(new L.LatLng(PositionX0, PositionY0), 10);

	// 設定圖資來源
	var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
	var osm = new L.TileLayer(osmUrl , {minZoom: 13, maxZoom:15} );
	map.addLayer(osm);
	 
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
	 
	});
	marker = L.marker([element.lat, element.lon], { icon: caricon }).addTo(map);
	marker.bindPopup(element.title, {
		autoClose: false, 
	closeOnClick: false
	}).openPopup();
	}
	}
	});
	 
</script>
</body>
</html>