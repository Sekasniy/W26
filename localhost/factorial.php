<?php
	function fact ($n=0) {
		if ($n != 0) return $n * fact($n - 1);
		else return $n;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factorial</title>
</head>
<body>
	<form action="<? $_SERVER['SCRIPT_NAME'] ?>">
		<input type="input" name="fact">
		<input type="submit"><br>
		<?= fact($_REQUEST['fact']); ?>
	</form>
</body>
</html>