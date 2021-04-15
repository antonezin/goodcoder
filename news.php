		<?php
			$title = "GoodCoder | Новости"; 
			require_once('app/header.php');
			$sql = "SELECT id, text, name, image FROM gc_new ORDER BY id DESC";
			$new = mysqli_query($link, $sql);
		?>

		<div class="wrapper">

		<content class="content">

			<div class="karta content__block"> <a href="/ "><i class="fa fa-home " aria-hidden="true"></i> Главная  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="/news "><i class="fa fa-hacker-news " aria-hidden="true"></i> Новости  </a> </div>

			<div class="new content__block">

				<?php while($news = mysqli_fetch_assoc($new) ){ ?>

					
						<div class="new_block">
							
								<h1 class="mobile"> <a href="/news/<?=$news['id']?>"> <?=mb_strimwidth($news['name'], 0, 40, "..."); ?> </a> </h1> 
								<h1 class="decktop"> <a href="/news/<?=$news['id']?>"> <?php echo mb_strimwidth($news['name'], 0, 30, "...");?> </a> </h1> 
								<a href="/news/<?=$news['id']?>"> <img src="<?php echo $news['image'];?>"> </a>
								<p> <a href="/news/<?=$news['id']?>"> <?php echo mb_strimwidth($news['text'], 0, 60, "...");?> </a></p>
						
						</div>	
					

				<?php }  ?>

			</div>

		</content>

		<?php require_once ('app/sitebar.php'); ?>
			
		</div>

	<?php require_once('app/footer.php') ?>