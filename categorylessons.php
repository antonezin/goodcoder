		<?php
			$categorylessons = $_GET['categorylessonsname'];
			

			$title = "GoodCoder | Уроки категория ->".$categorylessons; 
			require_once('app/header.php');
			
			if($categorylessons==0){header("Location: /");}


			$categorylessons = mysqli_real_escape_string($link, $categorylessons);
			$categorylessons = formatstr($categorylessons);
			if (!is_numeric($categorylessons)) {header("Location: /"); exit; }

			$sql="SELECT * FROM gc_lessons WHERE category = '" .  $categorylessons . "'";
			$lessons = mysqli_query($link, $sql);


			$sqlcat = "SELECT * FROM gc_categorylessons WHERE id = '" .  $categorylessons . "'";
			$sqlcat = mysqli_query($link, $sqlcat);
			$sqlcat = mysqli_fetch_assoc($sqlcat);
		?>

		<div class="wrapper">

		<content class="content">

		<div class="karta content__block"> <a href="/ "><i class="fa fa-home " aria-hidden="true"></i> Главная  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="/lessons "><i class="fa fa-graduation-cap" aria-hidden="true"></i> Уроки  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href=""> КАТЕГОРИЯ: <?=$sqlcat['name']?> </a> </div>

			<div class="lessons content__block">
	
			<?php
				if(mysqli_num_rows($lessons)==0){
					echo "<p style='font-size: 20px;'> Кактегория пуста </p>";
				}
			?>
				<?php while($lessonss = mysqli_fetch_assoc($lessons)){ ?>

						<div class="new_block">
								
								<h1 class="mobile"> <a href="/lessons/<?=$lessonss['id']?>"> <?=mb_strimwidth($lessonss['name'], 0, 35, "..."); ?> </a> </h1> 
								<h1 class="decktop"> <a href="/lessons/<?=$lessonss['id']?>"> <?php echo mb_strimwidth($lessonss['name'], 0, 35, "...");?> </a> </h1> 
								<a href="/lessons/<?=$lessonss['id']?>"> <img src="<?php echo $lessonss['img'];?>"> </a>
								<p> <a href="/news/<?=$news['id']?>"> <?php echo mb_strimwidth($lessonss['text'], 0, 60, "...");?> </a></p>
						
						</div>	

				<?php }  ?>

				

			</div>

		</content>

		<?php require_once ('app/sitebar.php'); ?>
			
		</div>

	<?php require_once('app/footer.php') ?>