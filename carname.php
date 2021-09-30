<?php
 
//$scar=$_POST['scar'];
	//https://211.23.243.112/video/233-VG/20210917/07/CH1/
	
	 $scar="233-VG";
	date_default_timezone_set('Asia/Taipei');
	$date=date('Ymd');
	$time=date('H');
	//$time="08";
	 
    // $date="20210922";
	$fileList = glob($scar.'/'.$date.'/*');
	$fileListexist=count(glob($scar.'/'.$date.'/'.$time.'/CH1/*'));
 //echo $scar.'/'.$date.'/'.$time.'/*'.$fileListexist;
	if($fileListexist > 0){
		 $fileList2= glob($scar.'/'.$date.'/'.$time.'/CH1/*');
	
		 
	  
//CH1------------------------------------------------------------------------------------------------------
    	foreach($fileList2 as $key => $datetime){
            
             $show=explode("/",$datetime);
             echo  $show[4].',';
		}
 
        echo ':';
//CH2------------------------------------------------------------------------------------------------------
 
$fileList5= glob($scar.'/'.$date.'/'.$time.'/CH2/*');
 
foreach($fileList5 as $key5 => $filename5){
 
		$show=explode("/",$filename5);
	echo  $show[4].',';
}
//////CH3	
echo ':';
$fileList3 = glob($scar.'/'.$date.'/'.$time.'/CH3/*');
 
foreach($fileList3 as $key3 => $filename3){
	 
	$show=explode("/",$filename3);
	echo  $show[4].',';
}	
///////CH4
echo ':';
$fileList4 = glob($scar.'/'.$date.'/'.$time.'/CH4/*');
 
foreach($fileList4 as $key4 => $filename4){
	 
	$show=explode("/",$filename4);
	echo  $show[4].',';
}	
		  
	} 
 
 

?>