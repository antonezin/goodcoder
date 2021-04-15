		<?php
			$categorynew = $_GET['categorynewname'];
			if ($categorynew==0) {header("Location: /");}

			$title = "GoodCoder | Новости категория". $categorynew; 
			require_once('app/header.php');

			$categorynew = mysqli_real_escape_string($link, $categorynew);
			$categorynew = formatstr($categorynew);
			if (!is_numeric($categorynew)) {header("Location: /"); exit;}

			$sql="SELECT * FROM gc_new WHERE category = '" .  $categorynew . "'";
			$new = mysqli_query($link, $sql);

			$sqlcat="SELECT * FROM gc_categorynew WHERE id = '" .  $categorynew . "'";
			$sqlcat= mysqli_query($link, $sqlcat);
			$sqlcat = mysqli_fetch_assoc($sqlcat);

		?>

		<div class="wrapper">

		<content class="content">

			<div class="karta content__block"> <a href="/ "><i class="fa fa-home " aria-hidden="true"></i> Главная  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="/news "><i class="fa fa-hacker-news " aria-hidden="true"></i> Новости  </a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <a href="">Категория: <?=$sqlcat['name']?></a>  </div>

			<div class="new content__block">

				<?php
					if(mysqli_num_rows($new)==0){
						echo "<p style='font-size: 20px;'> Кактегория пуста </p>";
					}
				?>

				<?php while($news = mysqli_fetch_assoc($new) ){ ?>

					
						<div class="new_block">
								
								<h1 class="mobile"> <a href="/news/<?=$news['id']?>"> <?=mb_strimwidth($news['name'], 0, 30, "..."); ?> </a> </h1> 
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