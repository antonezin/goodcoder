	<?php 
		$lessons_id = $_GET['lessons_id'];
		$title = "GoodCoder | Туториал ".$lessons_id; 
		require_once('app/header.php');

		$lessons_id = mysqli_real_escape_string($link, $lessons_id);
		$lessons_id = formatstr($lessons_id);
		if( !is_numeric($lessons_id) ) {header("Location: /"); exit; };

		$sql = "SELECT * FROM gc_lessons WHERE id = " . $lessons_id;
		$tutor = mysqli_query($link, $sql);
	?>


		<div class="wrapper">

		
			<content class="content">

				<div class="karta content__block"> <a href="/ "><i class="fa fa-home " aria-hidden="true"></i> Главная  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="/lessons "><i class="fa fa-graduation-cap" aria-hidden="true"></i> Уроки  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href=""> Туториал <?=$lessons_id; ?> </a> </div>

				<div class="story_model">


					<?php if(mysqli_num_rows($tutor) != 0){ ?>
			
						<?php while($tutorr = mysqli_fetch_assoc($tutor) ){ ?>
							<div class="story">
								<h1><?=$tutorr['name']; ?> </h1>
								<img src="<?=$tutorr['img'];?>">
								<p><?=$tutorr['text'];?></p>
							</div>
						<?php }  ?>

							<!-- Put this script tag to the <head> of your page -->
						<script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>

						<script type="text/javascript">
						  VK.init({apiId: 7718593, onlyWidgets: true});
						</script>

						<!-- Put this div tag to the place, where the Comments block will be -->
						<div style="border: 2px solid #f05454; clear: both;" id="vk_comments"></div>
						<script type="text/javascript">
						VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
						</script>


					<?php }else{ ?>
							<div class="story">

								<center> <img style="max-width: 100%; min-width: 100%; margin: 0 0px 20px 0;" src="/public/img/error_lessons.png"> </center>

								<h1> Возможные причины: </h1>
								<p>  Урок удален по просьбе правообладателя </p>
								<p>  Урок устарел не содержит в себе определенную ценность </p>
								<p>  Урок содержит в себе недостоверную информацию </p>
								<p>  Урок удален админом </p>


							</div>


						<?php	} ?>

						
						
					
				</div>

			</content>

			<?php require_once ('app/sitebar.php'); ?>
			
		</div>

			
	<?php include('app/footer.php') ?>