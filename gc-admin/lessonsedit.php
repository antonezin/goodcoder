<?php 
		session_start();

		require_once('../app/include/functions.php');

		if ($_SESSION['is_admin'] != 1) {
			header("Location: /gc-admin");
		}

		if($_GET['delete']){
			$id = $_GET['delete'];
			$id = formatstr($id);
			if (is_numeric($id)) { 
				header("Location: /gc-admin/lessons.php");
				$sql = "DELETE FROM gc_lessons WHERE id=" . $id;
				$new = mysqli_query($link, $sql);
				exit;
			}else{
				echo "Hack Loh";
				exit;
			}
		}


		if($_GET['tutor_id'] == ''){
			header("Location: /gc-admin");
		}


		if (isset($_GET['exit'])){ 
		session_destroy(); 
		header("Location: /gc-admin"); 
		exit;
		}


		$tutor_id = $_GET['tutor_id'];
		if(is_numeric($tutor_id)){
			if( !is_numeric(formatstr($tutor_id)) ) exit();
			$sql = "SELECT * FROM gc_lessons WHERE id = " . $tutor_id;
			$tutor = mysqli_query($link, $sql);

			if(mysqli_num_rows($tutor) == 0){echo "Такой новости нет"; exit;}

		}else{
			echo "Hack Loh";
			exit;
		}

		if($_POST['titleinput']){
			$title = $_POST['title'];
			$title = formatstr($title);
			$sql = "UPDATE gc_lessons SET name="."'".$title."'"." WHERE id=".$_GET['tutor_id'];
			$tutor = mysqli_query($link, $sql);
			header("Location: /gc-admin/lessonsedit.php?tutor_id=".$_GET['tutor_id']); 
		}


		if($_POST['textinput']){
			$text = $_POST['text'];
			
			$sql = "UPDATE gc_lessons SET text="."'".$text."'"." WHERE id=".$_GET['tutor_id'];
			$tutor = mysqli_query($link, $sql);
			header("Location: /gc-admin/lessonsedit.php?tutor_id=".$_GET['tutor_id']); 
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
						$sql = "UPDATE gc_lessons SET img='/public/data/".$mkktime.'.'.pathinfo($_FILES['picture']['name'])['extension']."'"." WHERE id=".$_GET['tutor_id'];
						$tutor = mysqli_query($link, $sql);
						header("Location: /gc-admin/lessonsedit.php?tutor_id=".$_GET['tutor_id']);
						echo "Файл загружен <br>";
					}else{

						echo "Файл не загружен ошибка " ;
					}

				}else{
					echo "Ошибка при загрузке файла!";
				}
			}
		}


		if($_POST['category_lessons_id']){
			$category = $_POST['category_lessons_id'];
			$sql = "UPDATE gc_lessons SET category="."'".$category."'"." WHERE id=".$_GET['tutor_id'];
			mysqli_query($link, $sql);
			header("Location: /gc-admin/lessonsedit.php?tutor_id=".$_GET['tutor_id']); 
		}


		$categoryidquery = "SELECT * FROM gc_categorylessons";
		$categoryidquery = mysqli_query($link, $categoryidquery);
	
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


		<h1>Редактирование урока</h1>
		<hr>
		<div style="margin: 25px 0;">


		<?php while($tutorr = mysqli_fetch_assoc($tutor) ){ ?>
			<div class="exit"> 
				<a href="/gc-admin/lessons.php">Назад</a>
				<a style="margin-left: 10px;" href="?delete=<?=$tutorr['id']?>"> Удалить запись </a>  
				<a target="_blank" style="margin-left: 13px;" href="/lessons/<?=$tutorr['id']?>">Смотреть урок на сайте</a> 
			</div>
								



			<h2 style="margin-top: 50px;">Наименование урока</h2>
									
									


			<form style="display: flex; margin-bottom: 25px;" method="POST"> 
				<input name="title" style="padding: 15px 0; width: 100%; background: #222; color: #fff; border: none; outline: none;" type="" name="" value="<?php echo $tutorr['name']; ?>"><br> 
				<input style="padding: 0 10px; background: #666; outline: none; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="titleinput" value="Сменить наименование">
			</form>


			<h2>Выбор категории</h2>
								<form style="margin-bottom: 25px; " method="POST">
									
									<select style="padding: 10px; outline: none; background: #222; color: #fff;" id="category_lessons_id" name="category_lessons_id">
										<?php while($categoryidqueryy = mysqli_fetch_assoc($categoryidquery) ){ ?>
											 <option value="<?=$categoryidqueryy['id']; ?>"> <?=$categoryidqueryy['name']; ?> </option>
										<?php }  ?>
									</select>

									<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="category" value="Сменить категорию">
								</form>

									
			<div class="newsedit">
				
		
				<form class="picture1" method="POST">
					<h2>Текст новости</h2>
					<textarea name="text" rows="40" style="resize: none; width: 100%; max-width: 100%;"> <?php echo $tutorr['text'];?> </textarea> <br>
					<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="textinput" value="Изменить текст новости"> 
				</form>


				<div class="picture2">
					<h2>Превью новости</h2>

					<img style="max-width: 100%;" src="<?=$tutorr['img'];?>"> 
											
					<form enctype="multipart/form-data" method="POST">
						<p style="margin: 10px 0;">Допускается формат  изображений такой как .webp .jpg размером 800x500</p>
						<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="file" name="picture">
						<input style="padding: 10px; outline: none; background: #666; color: #fff; text-transform: uppercase; font-weight: 600;" type="submit" name="upload" value="Сменить превью"> 
					</form>

				</div>
		
			<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
			<script> $("select#category_lessons_id").val("<?php echo $tutorr['category']; ?>"); </script>

					

		<?php }  ?>


			</div>

	</div>


</div>

	
	

</body>
</html>