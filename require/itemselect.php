<?php
	$str = $_POST['id'];
	$api=fopen("itemcode.txt","w");
		fwrite($api,$str);
		fclose($api);

?>