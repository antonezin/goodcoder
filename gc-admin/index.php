<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
	session_start();
	if ($_SESSION['is_admin'] == 1) {
		header("Location: /gc-admin/signin.php");
	}
	
	require_once('../app/include/functions.php');
?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=500px">
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="../public/css/font-awesome.min.css">

	<title>GoodCoder | Вход в админ панель</title>
</head>
<body>
		<a href="/"><div class="prev"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> </div></a>

		<form action="signin.php" method="POST">
			<div class="block__auth">
				<h1>GoodCoder</h1>
				
				<?php if($_SESSION['msg']) { ?>
					<div style=" max-width: 100%; margin-bottom: 15px; border: 1px solid #FE8A71; color: #FE8A71; padding: 10px; "> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </div>
			    <?php } ?>

				<input type="text" name="login" value="" autocomplete="on" placeholder="Логин">
				<input type="password" name="password" value="" autocomplete="on" placeholder="Пароль">
				<center> <div style="margin-bottom: 15px; max-width: 100% !important;" class="g-recaptcha" data-sitekey="6LfPHiwaAAAAAKM1gqa3CuTTp0K-C2e0PRVahF4n"></div> </center>
				<center> <input type="submit" name="auth" value="Войти"> </center>
			</div>
		</form>

	
</body>
</html>