<?php 

require_once('../app/include/functions.php'); 
session_start();
if ($_SESSION['is_admin'] != 1) {
		header("Location: /gc-admin");
	}


if (isset($_GET['exit'])){ 
		session_destroy(); 
		header("Location: /gc-admin"); 
		exit;
	}

	
	if($_GET['adlessons']){
		if($_GET['adlessons']==ad){
			$sql = "INSERT INTO gc_lessons(name, text, img, category) values('', '', '', '1')";
			mysqli_query($link, $sql);
			header("Location: /gc-admin/lessons.php"); 
			exit;
		}
		else{
			exit;
		}
	}

	if($_GET['deleted']){
			$id = $_GET['deleted'];
			$id = formatstr($id);
			if (is_numeric($id)) { 
				header("Location: /gc-admin/lessons.php");
				$sql = "DELETE FROM gc_categorylessons WHERE id=" . $id;
				$new = mysqli_query($link, $sql);
				
				exit;
			}else{
				echo "Hack Loh";
				exit;
			}
		}


	if($_POST['categorylessonsad']){

		$name = $_POST['categorylessonsad'];
		$sql = "INSERT INTO gc_categorylessons (name) values('".$name."')";
		mysqli_query($link, $sql);
		header("Location: /gc-admin/lessons.php");
		exit;
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=500px">
	<link rel="stylesheet" type="text/css" href="cssinit.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font-awesome.min.css">
	<title> GoodCoder АП | Уроки </title>
</head>
<body>




	<div class="container">
		


	<?php require_once('main-menu.php'); ?> 



	<div class="content">
	
	<?php 

		$sql = "SELECT * FROM gc_lessons ORDER BY id";
		$sql = formatstr($sql);
		$lessons = mysqli_query($link, $sql);

	?>

	<?php 
			$sql = "SELECT DISTINCT id, name FROM gc_categorylessons";
			$category_news = mysqli_query($link, $sql);
		?>




	<div class="header">

	<div class="logo">
		<a href="/gc-admin/signin.php"> <img src="../favicon.ico"> </a>
	</div>

		<p> Здравствуй <?= $_SESSION['gc_users'] ?>,  добро пожаловать в админ панель <a class="lil" target="_blank" href="/"> GoodCoder </a></p>

	<div class="exit">
		<a href="?exit">Выход</a>
	</div>

</div>




	<div style="padding: 20px;">

		<h1>Уроки</h1>
		<hr>
		<div style="margin: 25px 0;">
			
				<div class="news">

					<?php while ($lessonss = mysqli_fetch_assoc($lessons)){ ?>
						<a style="height: 95%;" href="/gc-admin/lessonsedit.php?tutor_id=<?=$lessonss['id']?>">
							<div style="text-align: center;  height: 95%; display: flex; justify-content: center; align-items: center; flex-direction: column; background: #f05454; padding: 10px; ">
								<h4> ID <?=$lessonss['id']?> </h4>	
								<hr style="width: 100%;">
								<h4> <?=$lessonss['name']?> </h4>		
							</div>
						</a>
					<?php } ?>

					<a style="height: 95%;"  href="?adlessons=ad">
							<div style="height: 95%; display: flex; justify-content: center; align-items: center; font-size: 50px; background: #f05454; padding: 10px;">
								<p>+</p> 
							</div>
						</a>

				</div>
		</div>



<h1 style="margin-top: 50px;">Категории уроков</h1>
				<hr style="margin-bottom: 25px;">
				
				<div style="margin-bottom: 50px; grid-auto-rows: auto;" class="news"> 
					<?php while ($category_newss = mysqli_fetch_assoc($category_news)){ ?>
								<div style="text-align: center; position: relative; display: flex; justify-content: center; align-items: center; flex-direction: column; background: #f05454; padding: 10px; ">
									
									<div style="position: absolute; right: 2px; top: 1px;"> <a href="?deleted=<?=$category_newss['id']?>"> <i class="fa fa-times" aria-hidden="true"></i> </a> </div>

									<h4> ID <?=$category_newss['id']?> </h4>	
									<hr style="width: 100%;">
									<h4> <?=$category_newss['name']?> </h4>		
								</div>
					<?php } ?>


					<form style="display: flex; flex-direction: column; justify-content: space-between;" method="POST">
						<input style="outline: none; padding: 15px; color: #000; background: #fff;" type="text" name="categorylessonsad">
						<input style="outline: none; padding: 15px; background: #f05454; color: #fff; width: 100%;" type="submit" name="" value="Добавить категорию" name="namecategory">
					</form>
	
				</div>

	</div>

	
</body>
</html>