<?php
$url = 'https://tw.rter.info/capi.php';
$contents = file_get_contents($url);
$test2 = json_encode($contents, JSON_PRETTY_PRINT);
HEADER('Content-Type: application/json; charset=utf-8');
 //print_r($test2 );
//echo $contents;

$arr = explode("},", $contents);
$c=count($arr);
$i=0;
$twd="";
$jpy="";
   

while($i<$c)
{
     if(strpos($arr[$i], "USDJPY"))
	{
	 	// echo $arr[$i]."\n";
		$jpy=$arr[$i];break;
	}
	else if(strpos($arr[$i], "USDTWD") ){
	  	//echo $arr[$i]."\n";
		$twd=$arr[$i];
		
	}
	
	$i++;
}
$twdarr = explode(", ", $twd);
$twdarr2=explode("Exrate",$twdarr[0]);
$twdarr3=explode(":",$twdarr2[1]);

$jpyarr = explode(", ", $jpy);
$jpyarr2=explode("Exrate",$jpyarr[0]);
$jpyarr3=explode(":",$jpyarr2[1]);
//echo $twdarr2[1]."\n";
$w=0.275;
if($jpyarr3[1]!=null)
{echo $twdarr3[1]/$jpyarr3[1]; }
else{
  echo $w;  
}
/**/

?>