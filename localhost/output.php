<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	function myecho() {
		for ($i=0; $i<func_num_args(); $i++ ) echo func_get_arg($i)."<br>";
	}
		
	call_user_func_array("myecho", $_SESSION['sel_actions'])
?>
