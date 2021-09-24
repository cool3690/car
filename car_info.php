 
  <?php
  	include 'carnumer.php';
	$num="KLG-6582";
 	if(isset($_GET['num'])){
				 $num = $_GET['num'];
			 }
    
		ini_set('date.timezone','Asia/Taipei');	
        $sdate = date("Y~m~d");
        $stime = date("h~m");
		
		$url6 = 'http://52.155.115.220:6060/GetGpsHistoryTrack/100?DeviceId='.$car_num[$num].'&BeginTime='.$sdate.'~00~00~00&EndTime='.$sdate.'~23~59~59'; 
		
		$json6 = file_get_contents($url6);
		 
		$arr6 = json_decode($json6, true);
	 
		$arr6_2 =$arr6["GpsHistoryTrackInfo"];
		
		$count6=count($arr6_2)-1;
	 
		 if($count6>0){
             $la6=$arr6["GpsHistoryTrackInfo"][$count6]["la"];
            $lo6=$arr6["GpsHistoryTrackInfo"][$count6]["lo"];
            $sp=$arr6["GpsHistoryTrackInfo"][$count6]["sp"];
            $cr=$arr6["GpsHistoryTrackInfo"][$count6]["cr"];
            echo $la6.",".$lo6.",".$sp.",".$cr;
         }
		else{
            echo "無資料,,,";
        }
		?>
 