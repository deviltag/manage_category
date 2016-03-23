<?php
	if(isset($_GET['id'])){
	$code=explode(":", $_GET['id']);

	echo "level :".$code[0]."<br>";
	echo "code  :".$code[1];
	}

	if(isset($_GET['level'])&&isset($_GET['code'])){
	
	echo "level :".$_GET['level']."<br>";
	echo "code  :".$_GET['code'];
	}
?>