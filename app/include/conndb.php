<?php 

$host = '';
$user_db = '';
$passworr = '';

$link = mysqli_connect($host, $user_db, $passworr, $user_db);


if( mysqli_connect_errno() ){
	echo 'Ошибка подключения к БД (' . mysqli_connect_errno() . '): ' . mysqli_connect_error();
	exit();
}