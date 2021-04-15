<?php
	
	session_start();
	if ($_SESSION['is_admin'] != 1) {
		header("Location: /gc-admin");
	}

	if (isset($_GET['exit'])){ 
		session_destroy(); 
		header("Location: /gc-admin"); 
		exit;
	}


	require_once('../app/include/functions.php');
	

	if ($_SESSION['is_admin'] != 1){
		
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$key = '6LfPHiwaAAAAAOBEXL7rYX9wsqVYex6XZKGNyx2R';
		$query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
		$data = json_decode(file_get_contents($query));


		$login = $_POST['login'];
		$password = $_POST['password'];

		$login = mysqli_real_escape_string($link, $login);
		$login = formatstr($login);

		$password = mysqli_real_escape_string($link, $password);
		$password = formatstr($password);
	}


	

	if($_POST['auth']){


		if(!$login){
			$_SESSION['msg']='Введите логин!'; 
			header("Location: /gc-admin"); 
			exit;
		}
		

		if(!$password){
			$_SESSION['msg']='Введите пароль!'; 
			header("Location: /gc-admin"); 
			exit;
		}


		//if($data->success == false){ 
			//$_SESSION['msg']='Пройдите проверку на робота!'; 
			//header("Location: /gc-admin"); 
			//exit;
		//}

		
		$sql = "SELECT * FROM gc_users WHERE login = '$login' AND admin = '1'";
		$admin_panel = mysqli_query($link, $sql);
		$admin_panel = mysqli_fetch_assoc($admin_panel);

		$_SESSION['gc_users'] = $admin_panel['fio'];

		if(count($admin_panel) == 0) { 
			$_SESSION['msg']='Логин или пароль не совпадают!';  
			header("Location: /gc-admin"); 
			exit; 
		}

		if( !password_verify($password, $admin_panel['password']) ){
			$_SESSION['msg']='Логин или пароль не совпадают!';  
			header("Location: /gc-admin"); 
			exit;
		}
		else{
			$_SESSION['is_admin'] = 1;
		}

	}


	


?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=500px">
	<link rel="stylesheet" type="text/css" href="cssinit.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font-awesome.min.css">
	<title> GoodCoder АП | Основаня информация </title>
</head>
<body>




	<div class="container">
		


	<?php require_once('main-menu.php'); ?> 



	<div class="content">
	
	<?php 

		$sql = "SELECT * FROM gc_lessons ORDER BY id";
		$sql = formatstr($sql);
		$lessons = mysqli_query($link, $sql);


		$sql = "SELECT * FROM gc_new ORDER BY id";
		$sql = formatstr($sql);
		$news = mysqli_query($link, $sql);

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

		<h1>Основная информация</h1>
		<hr>

		<div style="margin: 25px 0;">
			
			<div class="init">

				<div style="border-radius: 8px; text-align: center; display: flex; justify-content: center; align-items: center; font-size: 25px; background: #f05454; padding: 10px;">
					<p>Кол-во уроков <br> <?php echo mysqli_num_rows($lessons); ?> </p> 
				</div>


				<div style="border-radius: 8px; text-align: center; display: flex; justify-content: center; align-items: center; font-size: 25px; background: #f05454; padding: 10px;">
					<p>Кол-во новостей <br>  <?php echo mysqli_num_rows($news); ?> </p> 
				</div>
				
				<div style="border-radius: 8px; display: flex; flex-direction: column; font-size: 25px; background: #f05454; padding: 10px;">
					
					<p>Категории новостей <br>
						<menu style="text-align: left; list-style-type: none; margin-left: 8px;">

							<?php while( $category = mysqli_fetch_assoc($category_news) ){ ?>
								<li> <a style="margin: 0 10px;" href="/categorynew/<?=$category['id']?>"> <?=$category['name']?> </a> </li>
							<?php }  ?>

						</menu>

				</div>

				<div style="border-radius: 8px; display: flex; flex-direction: column; font-size: 25px; background: #f05454; padding: 10px;">
					
					<p>Категории уроков <br>
						<menu style="text-align: left; list-style-type: none; margin-left: 8px;">

							<?php while( $category = mysqli_fetch_assoc($category_lessons) ){ ?>
							<li> <a style="margin: 0 10px;" href="/categorylessons/<?=$category['id']?>"> <?=$category['name']?> </a> </li>
							<?php }  ?>

						</menu>

				</div>

			</div>
		</div>

	</div>

	
</body>
</html>