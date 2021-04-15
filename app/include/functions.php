<?php

require_once('conndb.php');

function formatstr($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}


function style(){
	echo "<link rel='stylesheet' href='/public/css/default.css'>";
	echo "<link rel='stylesheet' href='/public/css/style.css'>";
	echo "<link rel='stylesheet' href='/public/css/font-awesome.min.css'>";
}