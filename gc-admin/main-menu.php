<?php if ($_SESSION['is_admin'] != 1) {
		header("Location: /gc-admin");
	}
?>

<div class="main__menu">
			

			<div class="main__menu_m">
				<menu>
					<ul>

						<li>
							<a href="/gc-admin/signin.php"> <i class="fa fa-home" style="margin-right: 10px;" aria-hidden="true"></i> Главная</a>
						</li>

						<li>
							<a href="/gc-admin/news.php"> <i class="fa fa-hacker-news" style="margin-right: 10px;" aria-hidden="true"></i> Новости</a>
						</li>

						<li>
							<a href="/gc-admin/lessons.php"> <i class="fa fa-graduation-cap" style="margin-right: 2px;" aria-hidden="true"></i> Уроки</a>
						</li>

					</ul>
				</menu>
			</div>

</div>