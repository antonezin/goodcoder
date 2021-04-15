<?php $title = "GoodCoder | Развивайся с нами"; ?>

<?php require_once('app/header.php'); ?> 

																	<?php 
																		$sql = "SELECT id, text, name, image FROM gc_new ORDER BY id DESC LIMIT 4";
																		$new = mysqli_query($link, $sql);
																	?>

		<div class="wrapper">



			<content class="content">

				

				<div class="new content__block">
					
					<div class="name_block"> <p> <i class="fa fa-hacker-news" aria-hidden="true"> </i> Новости </p> <a href="/news"> Все новости => </a> </div> 

					
					<?php while ($news = mysqli_fetch_assoc($new)) { ?>
						<div class="new_block">
								
								<h1 class="mobile"> <a href="/news/<?=$news['id']?>"> <?=mb_strimwidth($news['name'], 0, 30, "..."); ?> </a> </h1> 
								<h1 class="decktop"> <a href="/news/<?=$news['id']?>"> <?php echo mb_strimwidth($news['name'], 0, 30, "...");?> </a> </h1> 
								<a href="/news/<?=$news['id']?>"> <img src="<?php echo $news['image'];?>"> </a>
								<p> <a href="/news/<?=$news['id']?>"> <?php echo mb_strimwidth($news['text'], 0, 60, "...");?> </a></p>
						
						</div>	
					<?php } ?>
					

				</div>


																	<?php 
																		$sql = "SELECT id, text, name, img FROM gc_lessons ORDER BY id DESC LIMIT 16";
																		$lessons = mysqli_query($link, $sql);
																	?>


				<div class="lessons content__block">
					
					<div class="name_block"> <p> <i class="fa fa-graduation-cap" aria-hidden="true"> </i> Уроки </p> <a href="/lessons"> Все уроки => </a> </div> 

					
					<?php while ($lessonss = mysqli_fetch_assoc($lessons)){ ?>
						<div class="new_block">
								
								<h1 class="mobile"> <a href="/lessons/<?=$lessonss['id']?>"> <?=mb_strimwidth($lessonss['name'], 0, 30, "..."); ?> </a> </h1> 
								<h1 class="decktop"> <a href="/lessons/<?=$lessonss['id']?>"> <?=mb_strimwidth($lessonss['name'], 0, 30, "...");?> </a> </h1> 
								<a href="/lessons/<?=$lessonss['id']?>"> <img src="<?=$lessonss['img'];?>"> </a>
								<p> <a href="/lessons/<?=$lessonss['id']?>"> <?php echo mb_strimwidth($lessonss['text'], 0, 60, "...");?> </a></p>
						
						</div>	
					<?php } ?>
				

				</div>


			</content>	

			<?php require_once ('app/sitebar.php'); ?>

		</div>



<?php include('app/footer.php') ?>
	






