<?php
	$fp = fopen("users.txt", "r+");
	$names = unserialize(fgets($fp, 999));
	$fp = fopen("users.txt", "w+");
	$names[$_REQUEST["login"]] = array("password" => $_REQUEST["password"], "status" => "user");
	$v = serialize($names);
	fwrite($fp, $v);
	fclose($fp);
	echo "Ты зарегистрировался";
?>