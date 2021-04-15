<?php 
	$sql = "SELECT * FROM gc_menu_vertical";
	$sql = formatstr($sql);
	$menu = mysqli_query($link, $sql);
?>



<?php 
	$sql = "SELECT DISTINCT id, name FROM gc_categorynew";
	$category_news = mysqli_query($link, $sql);
?>

<?php 
	$sql = "SELECT DISTINCT id, name FROM gc_categorylessons";
	$sql = formatstr($sql);
	$category_lessons = mysqli_query($link, $sql);
?>


<div class="sitebar">

	<div id="items" class="sitebar__items">
		
		<div class="sitebar__block">
			
			<menu>
				<ul>
					<?php while( $menus = mysqli_fetch_assoc($menu) ){ ?>

					<li> <a href="<?php echo $menus['href'] ?> "><i class="fa_fa_fa fa <?php echo $menus['ico'] ?> " aria-hidden="true"></i> <?php echo $menus['text'] ?>  </a> </li>

					<?php }  ?>
				</ul>
			</menu>

		</div>


		<div class="sitebar__block">
			<div class="category__news__and__lessons">

				<h1> Категории новостей </h1>

				<div class="category__news">
					<?php while( $category = mysqli_fetch_assoc($category_news) ){ ?>
						<a href="/categorynew/<?=$category['id']?>"> <?=$category['name']?> </a>	
					<?php }  ?>
				</div>	

				<h1> Категории уроков </h1>

				<div class="category__news">
					<?php while( $category = mysqli_fetch_assoc($category_lessons) ){ ?>
						<a href="/categorylessons/<?=$category['id']?>"> <?=$category['name']?> </a>	
					<?php }  ?>
				</div>	

			</div>	
		</div>

	</div>
	
</div>