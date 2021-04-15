<?php 
		session_start();
		require_once('../app/include/functions.php');

		if($_GET['delete']){
			$id = $_GET['delete'];
			$id = formatstr($id);
			if (is_numeric($id)) { 
				header("Location: /gc-admin/news.php");
				$sql = "DELETE FROM gc_new WHERE id=" . $id;
				$new = mysqli_query($link, $sql);
				
				exit;
			}else{
				echo "Hack Loh";
				exit;
			}
		}


		if($_GET['story_id'] == ''){
			header("Location: /gc-admin");
		}


		if ($_SESSION['is_admin'] != 1) {
			header("Location: /gc-admin");
		}

		if (isset($_GET['exit'])){ 
		session_destroy(); 
		header("Location: /gc-admin"); 
		exit;
		}


		$news_id = $_GET['story_id'];
		if(is_numeric($news_id)){
			if( !is_numeric(formatstr($news_id)) ) exit();
			$sql = "SELECT * FROM gc_new WHERE id = " . $news_id;
			$new = mysqli_query($link, $sql);

			if(mysqli_num_rows($new) == 0){echo "Такой новости нет"; exit;}

		}else{
			echo "Hack Loh";
			exit;
		}

	
		if($_POST['titleinput']){
			$title = $_POST['title'];
			$title = formatstr($title);
			$sql = "UPDATE gc_new SET name="."'".$title."'"." WHERE id=".$_GET['story_id'];
			$new = mysqli_query($link, $sql);
			header("Location: /gc-admin/newsedit.php?story_id=".$_GET['story_id']); 
		}


		if($_POST['textinput']){
			$text = $_POST['text'];
			
			$sql = "UPDATE gc_new SET text="."'".$text."'"." WHERE id=".$_GET['story_id'];
			$new = mysqli_query($link, $sql);
			header("Location: /gc-admin/newsedit.php?story_id=".$_GET['story_id']); 
		}


		if($_POST['upload']){
			
			if($_SERVER['REQUEST_METHOD']=='POST'){

				if($_FILES['picture']['error'] == 0){
					
					$filetmp = $_FILES['picture']['tmp_name'];
					$dir = __DIR__;
					$dir = substr($dir, 0, -8);
					$mkktime = mktime();
					$newput = $dir.'public/data/'.$mkktime.'.'.pathinfo($_FILES['picture']['name'])['extension'];
					
					if(move_uploaded_file($filetmp, $newput)){
						$sql = "UPDATE gc_new SET image='/public/data/".$mkktime.'.'.pathinfo($_FILES['picture']['name'])['extension']."'"." WHERE id=".$_GET['story_id'];
						$new = mysqli_query($link, $sql);
						header("Location: /gc-admin/newsedit.php?story_id=".$_GET['story_id']);
						echo "Файл загружен <br>";
					}else{

						echo "Файл не загружен ошибка " ;
					}

				}else{
					echo "Ошибка при загрузке файла!";
				}
			}
		}


		if($_POST['category_news_id']){
			$category = $_POST['category_news_id'];
			$sql = "UPDATE gc_new SET category="."'".$category."'"." WHERE id=".$_GET['story_id'];
			$new = mysqli_query($link, $sql);
			header("Location: /gc-admin/newsedit.php?story_id=".$_GET['story_id']); 
		}


		$categoryidquery = "SELECT * FROM gc_categorynew";
		$categoryidquery = mysqli_query($link, $categoryidquery);
	
?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=500px">
	<link rel="stylesheet" type="text/css" href="cssinit.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font-awesome.min.css">
	<title> GoodCoder АП | Редактирование новости </title>
</head>
<body>




	<div class="container">
		


	<?php require_once('main-menu.php'); ?> 



	<div class="content">
	
	




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

		<h1>Редактирование новости</h1>
		<hr>

		<div style="margin: 25px 0;">
			
			
	<?php while($news = mysqli_fetch_assoc($new) ){ ?>
		
		<div> 
			<div class="exit">
			<a href="/gc-admin/news.php">Назад</a>
			<a style="margin-left: 10px;" href="?delete=<?=$news['id']?>"> Удалить запись </a>  
			<a target="_blank" style="margin-left: 13px;" href="/news/<?=$news['id']?>">Смотреть новость на сайте</a> 
			</div>
		</div><br>
							



								<h2 style="margin-top: 50px;">Наименование новости</h2>
								
							
								<form style="display: flex; margin-bottom: 25px;" method="POST"> 
									<input name="title" style="padding: 15px 0; width: 100%; background: #222; color: #fff; border: none; outline: none;" type="" name="" value="<?php echo $news['name']; ?>"><br> 
									<input style="padding: 0 10px; background: #666; outline: none; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="titleinput" value="Сменить наименование">
								</form>

								<h2>Выбор категории</h2>
								<form style="margin-bottom: 25px; " method="POST">
									
									<select style="padding: 10px; outline: none; background: #222; color: #fff;" id="category_id_new" name="category_news_id">
										<?php while($categoryidqueryy = mysqli_fetch_assoc($categoryidquery) ){ ?>
											 <option value="<?=$categoryidqueryy['id']; ?>"> <?=$categoryidqueryy['name']; ?> </option>
										<?php }  ?>
									</select>

									<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="category" value="Сменить категорию">
								</form>


								<div class="newsedit">
									
									<form class="picture1" method="POST">
										<h2>Текст новости</h2>
										<textarea name="text" rows="40" style="resize: none; width: 100%; max-width: 100%;"> <?php echo $news['text'];?> </textarea> <br>
										<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="textinput" value="Изменить текст новости"> 
									</form>
								



									<div class="picture2">
										<h2>Превью новости</h2>
											<img style="max-width: 100%;" src="<?=$news['image'];?>"> 
										
											<form enctype="multipart/form-data" method="POST">
												<p style="margin: 10px 0;">Допускается формат  изображений такой как .webp .jpg размером 800x500</p>
												<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="file" name="picture">
												<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="upload" value="Сменить превью"> 
											</form>
									</div>

								</div>



								<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
								<script> $("select#category_id_new").val("<?php echo $news['category']; ?>"); </script>

								
	<?php }  ?>




		</div>

	</div>

	
</body>
</html>