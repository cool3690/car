<?php     
	  
  $scar=$_POST['scar'];
        $date=$_POST['date'];
       $time=$_POST['time'];
      //      echo $scar;
              //  $scar="233-VG";
              date_default_timezone_set('Asia/Taipei');
              //$date=date('Ymd');
              //$time=date('Hms');
              // $time="08";

                //$date="20210705";
              $fileList = glob($scar.'/'.$date.'/'.$time.'/*');
              $fileListexist=count(glob($scar.'/'.$date.'/'.$time.'/*'));
         
              if($fileListexist > 0){
     //CH1-------
     $fileList2= glob($scar.'/'.$date.'/'.$time.'/CH1'.'/*');
     foreach($fileList2 as $key => $datetime){
             $show=explode("/",$datetime);
             echo  $show[4].',';
     }

  echo ':';
             //CH2------------------------------------------------------------------------------------------------------

             $fileList5 = glob($scar.'/'.$date.'/'.$time.'/CH2'.'/*');

             foreach($fileList5 as $key5 => $filename5){
   $show=explode("/",$filename5);
   echo  $show[4].',';
             }
             //////CH3
             echo ':';
             $fileList5 = glob($scar.'/'.$date.'/'.$time.'/CH3'.'/*');

             foreach($fileList5 as $key5 => $filename5){
   $show=explode("/",$filename5);
   echo  $show[4].',';
             }
             ///////CH4
             echo ':';
             $fileList5 = glob($scar.'/'.$date.'/'.$time.'/CH4'.'/*');

             foreach($fileList5 as $key5 => $filename5){
   $show=explode("/",$filename5);
   echo  $show[4].',';
             }
              }

      ?>
