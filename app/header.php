<?php 
	require_once('include/functions.php'); 
	
?>



<?php 
	$sql = "SELECT * FROM gc_menu_vertical";
	$sql = formatstr($sql);
	$menu = mysqli_query($link, $sql);
?>

<?php 
	$sql = "SELECT * FROM gc_menu_vertical";
	$sql = formatstr($sql);
	$menud = mysqli_query($link, $sql);
?>

<?php 
	$sql = "SELECT DISTINCT id, name FROM gc_categorynew";
	$category_newsl = mysqli_query($link, $sql);
?>

<?php 
	$sql = "SELECT DISTINCT id, name FROM gc_categorylessons";
	$sql = formatstr($sql);
	$category_lessonsl = mysqli_query($link, $sql);
?>


<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php style(); ?>
		<title><?=$title?></title>
	</head>

<body id="scroll">


	<div class="menu__mobile__burger">
					
					<div class="head_link">
						<?php while( $menuss = mysqli_fetch_assoc($menud) ){ ?>
						<li> <a href="<?php echo $menuss['href'] ?> "><i class="fa <?php echo $menuss['ico'] ?> " aria-hidden="true"></i> <?php echo $menuss['text'] ?>  </a> </li>
						<?php }  ?>
					</div>

					<div class="category__link">
						<p>Категории новостей</p>

						<?php while( $categoryl = mysqli_fetch_assoc($category_newsl) ){ ?>
						<a href="/categorynew/<?=$categoryl['id']?>"> <?=$categoryl['name']?> </a>
						<?php }  ?>

					</div>

					<div class="category__link">
						<p>Категории уроков</p>
						
						<?php while( $categoryl = mysqli_fetch_assoc($category_lessonsl) ){ ?>
						<a href="/categorylessons/<?=$categoryl['id']?>"> <?=$categoryl['name']?> </a>
						<?php }  ?>

					</div>

					<div class="menu_page_mobile">
						<nav>
							<ul>
								<li> <a class="lola" href="/oproekte">О проекте</a> </li>
								<li> <a class="lola" href="/otchety">Отчеты</a> </li>
							</ul>
						</nav>
					</div>	
	</div>
					

					

<div class="page">


<header class="header">

		<div class="center">
				<div class="logo"> <a href="/">  G<span>oo</span>dC<span>o</span>d<span>e</span>r </a> </div>
				
					
				<div class="burger__button">
					<span></span>
				</div>	
				
				<div class="menu_page">
						<nav>
							<ul>
								<li> <a class="lola" href="/oproekte">О проекте</a> </li>
								<li> <a class="lola" href="/otchety">Отчеты</a> </li>
							</ul>
						</nav>
				</div>	

		</div>

		<div class="menu__mobile">  

			<?php while( $menus = mysqli_fetch_assoc($menu) ){ ?>

					<li> <a href="<?php echo $menus['href'] ?> "><i class="fa <?php echo $menus['ico'] ?> " aria-hidden="true"></i> <?php echo $menus['text'] ?>  </a> </li>

			<?php }  ?>

		</div>

</header>







