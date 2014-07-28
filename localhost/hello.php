<?php
	session_start();
	if(isset($_REQUEST['login']) and isset($_REQUEST['password'])) {
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['password'] = $_REQUEST['password'];
	}		
	
	header('Content-Type: text/html; charset=utf-8');
	
	function read_file() {
		$fp = fopen("users.txt", "r");
		return unserialize(fgets($fp, 999));
	}
	
	$actions = array(
		"Пошел на работу, гавно чистить" => "Работать",
		"Ну ты ебанутый, бля" => "Как цапля стоять",
		"Ты можешь просто заткнуться, нихуя не говорить" => "Истории ахуительные рассказывать",
		"F" => "Факториал считать"
	);
	
	function selectItem($selected=0) {
		foreach($GLOBALS['actions']  as $k => $v) {
			if ($k === $selected) $ch = " selected"; else $ch = "";
			$text .= "<option$ch$ch1 value='$k'>$v</option>\n";
		}
		return $text;
	}
	
	if (isset($_REQUEST['action']))  $output = $_REQUEST['action'];
	
	function factor($n=0) {
		if ($n == 0) return 1;
		else return $n * fact($n - 1);
	}
  ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<body>	
	<? foreach (read_file() as $k => $v) : ?>
		<? if ($_SESSION["login"] ==$k && $_SESSION["password"]== $v['password']): ?>
			Доступ открыт для пользователя <?= $_SESSION['login'] ?> <br>
			<form action="<?=$_SERVER['SCRIPT_NAME'] ?>" method=post>
				Чё будем делать?
				<select name="action">
					<?= selectItem($_REQUEST['action']) ?><br>
				</select>
				<input type="submit" value="Отправить">
			</form>
			<? break; ?>
		<? else: ?>
			Доступ закрыт.
			<? break; ?>
		<? endif; ?>
	<? endforeach; ?>
	<? if (isset($output)) : ?>
		<? if  ($output != "F"): ?>
			<?= $output;  ?>
		<? endif ?>
	<? endif; ?>
	<a href="factorial.php">Браток, ну хочешь я тебе факториал посчитаю?</a>
</body>
</html> 