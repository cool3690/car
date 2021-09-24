<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once ("head.php"); ?>		
</head>
<body>
	<style>
		body {
			background-image: url("image/cs1-3-2.png");
		}
	</style>
	
	<?php include_once ("navbar.php"); ?>
			
	<!-- <img src="image/stitle2.png" class="img-fluid" style="width:100%;"> -->
	<div class="container" style="padding-bottom:8%">
		<div class="row mt-5">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="text-center"><i class="fas fa-square fa-rotate-45 mr-3" style="font-size:10px;"></i><span class="ml-3 mr-4" style="font-size:26px;font-weight:bold;">公益活動</span><i class="fas fa-square fa-rotate-45 mr-3" style="font-size:10px;"></i></div>
			</div>

			<?php
				$i=1;
				$j=2;
				$z=1001;
				for ($i=1;$i<99;$i++){
					$file = 'picture/charity/'.$i.'/1.jpg';
					if (file_exists($file)) {
						echo '<div class="mr-3 ml-4 mt-5" id="p1_ds">	
								<img src="picture/charity/'.$i.'/1.jpg" alt="李英桐" class="mt-4 mr-4 ml-4" style="width:280px;height:200px;">
							<div class="card-body">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12">';
								switch ($i) {
									case 1:
										$text="2019/03/15<br />特教交通接送方案討論";
										break;
									case 2:
										$text="2019/04/06<br />許石音樂會";
										break;
									case 3:
										$text="2019/04/14<br />愛在山上路跑活動與特教結合";
										break;
									case 4:
										$text="2019/05/12<br />參訪日本大阪特教學校";
										break;
									case 5:
										$text="2020/01/01<br />臺南市民族管絃樂團巡演";
										break;
								}								
								
								echo '
									<h5 class="card-title"><p class="card-text text-white" style="font-size:20px;">'.$text.'</p></h5>
							
									<div class="text-right">
										<form method="POST" action="charity_pic.php" enctype="multipart/form-data">
											<input type="hidden" name="id" value="'.$i.'">
											<button type="submit" class="btn" name="submit" value="1" style="color:#019858;">more ></button>
										</form>	
									</div>
								</div>
							</div>
						</div>';
					}else{
						break;
					}
				}			
			?>
	
		</div>
	</div>	
	
	<?php include_once ("footer.php"); ?>
	
</body>
</html>
