<?php $title = "GoodCoder | Отчеты"; ?>

<?php require_once('app/header.php'); ?> 

																	<?php 
																		$sql = "SELECT id, text, name, image FROM gc_new ORDER BY id DESC LIMIT 4";
																		$new = mysqli_query($link, $sql);
																	?>

		<div class="wrapper">



			<content class="content">

				
				<div class="error404">
					ewfwefew
				</div>
			


			</content>	

			<?php require_once ('app/sitebar.php'); ?>

		</div>



<?php include('app/footer.php') ?>
	






