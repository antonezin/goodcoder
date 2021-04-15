<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/gc-admin/css.css">
	<link rel="stylesheet" href="/public/css/font-awesome.min.css">
	<title>GoodCoder | Вход</title>
</head>
<body>

	<a href="/"><div class="prev"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> </div></a>
		
		<form action="/" method="POST">
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