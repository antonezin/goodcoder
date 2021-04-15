		<?php
			$title = "GoodCoder | Уроки"; 
			require_once('app/header.php');
			$sql = "SELECT * FROM gc_lessons ORDER BY id DESC";
			$lessons = mysqli_query($link, $sql);
		?>

		<div class="wrapper">

		<content class="content">

			<div class="karta content__block"> <a href="/ "><i class="fa fa-home " aria-hidden="true"></i> Главная  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="/lessons "><i class="fa fa-graduation-cap" aria-hidden="true"></i> Уроки  </a></div>

			<div class="lessons content__block">

				<?php while($lessonss = mysqli_fetch_assoc($lessons)){ ?>

						<div class="new_block">
								
								<h1 class="mobile"> <a href="/lessons/<?=$lessonss['id']?>"> <?=mb_strimwidth($lessonss['name'], 0, 40, "..."); ?> </a> </h1> 
								<h1 class="decktop"> <a href="/lessons/<?=$lessonss['id']?>"> <?php echo mb_strimwidth($lessonss['name'], 0, 35, "...");?> </a> </h1> 
								<a href="/lessons/<?=$lessonss['id']?>"> <img src="<?php echo $lessonss['img'];?>"> </a>
								<p> <a href="/lessons/<?=$lessonss['id']?>"> <?php echo mb_strimwidth($lessonss['text'], 0, 60, "...");?> </a></p>
						
						</div>	

				<?php }  ?>

				

			</div>

		</content>

		<?php require_once ('app/sitebar.php'); ?>
			
		</div>

	<?php require_once('app/footer.php') ?>