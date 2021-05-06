<?php
include_once "action.php";
include "header.php";
if (isset($_GET['login']) && $_GET['login'] != "") {
	$admin = $_GET['login'];
	if(check_log($admin) == true){
		echo "<h3>Привет,  $admin!</h3>";
		echo "<p>Сводка погоды для всех стран на сегодня:<br/> холодно, снег</p>";
	}
	} else {
		header("Location: index.php");
	}

include "footer.php";
