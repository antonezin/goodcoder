	<?php 

		$news_id = $_GET['news_id'];
		$news_id = trim($news_id);

		$title = "GoodCoder | Рассказ ".$news_id; 
		require_once('app/header.php');

		$news_id = mysqli_real_escape_string($link, $news_id);
		$news_id = formatstr($news_id);
		
		if (!is_numeric($news_id)) {header("Location: /"); exit; }

		$sql = "SELECT * FROM gc_new WHERE id = " . "'" . $news_id . "'";
		$new = mysqli_query($link, $sql);

	?>

		<div class="wrapper">

		
			<content class="content">

				<div class="karta content__block"> <a href="/ "><i class="fa fa-home " aria-hidden="true"></i> Главная  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="/news "><i class="fa fa-hacker-news " aria-hidden="true"></i> Новости  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="">РАССКАЗ <?=$news_id?></a> </div>

				<div class="story_model">


					<?php if(mysqli_num_rows($new) != 0){ ?>

						<?php while($news = mysqli_fetch_assoc($new) ){ ?>
							<div class="story">
								<h1><?php echo $news['name']; ?> </h1>
								<img src="<?php echo $news['image'];?>">
								<p><?php echo $news['text'];?></p>
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
					
					<?php } else{ ?>
						
						<div class="story">

								<center> <img style="max-width: 100%; min-width: 100%; margin: 0 0px 20px 0;" src="/public/img/error_news.png"> </center>

								<h1> Возможные причины: </h1>
								<p>  — Новость удалена по просьбе правообладателя </p>
								<p>  — Новость содержит в себе недостоверную информацию </p>
								<p>  — Новость удалена админом </p>


						</div>	
						
					<?php } ?>

				</div>

			</content>

			<?php require_once ('app/sitebar.php'); ?>
			
		</div>

			
	<?php include('app/footer.php') ?>