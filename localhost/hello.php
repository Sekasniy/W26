<?php
	session_start();
	if(isset($_REQUEST['login']) and isset($_REQUEST['password'])) {
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['password'] = $_REQUEST['password'];
		$_SESSION['sel_actions'] = array();
	}		
	
	header('Content-Type: text/html; charset=utf-8');
	
	function read_file() {
		$fp = fopen("users.txt", "r");
		return unserialize(fgets($fp, 999));
	}
	
	$actions = [
		"Пошел на работу, гавно чистить" => "Работать",
		"Ну ты ебанутый, бля" => "Как цапля стоять",
		"Ты можешь просто заткнуться, нихуя не говорить" => "Истории ахуительные рассказывать",
	];
	
	function selectItem($selected) {
		if ($selected !== null) $_SESSION['sel_actions'][] = $actions[$selected];
		foreach($GLOBALS['actions']  as $k => $v) {
			if ($k === $selected) $ch = " selected"; else $ch = "";
			$text .= "<option$ch$ch1 value='$k'>$v</option>\n";
		}
		return $text;
	}
	
	$F = "selectItem";
	
	if (isset($_REQUEST['action']))  $output = $_REQUEST['action'];

  ?>
<html>	 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<body>	
	<? foreach (read_file() as $k => $v) : ?>
		<? if ($_SESSION["login"] ==$k && $_SESSION["password"]== $v['password']): ?>
			Доступ открыт для пользователя <?= $_SESSION['login'] ?>
			<a href="factorial.php" style="float:right; position: relative">Браток, ну хочешь я тебе факториал посчитаю?</a><br>
			<form action="<?=$_SERVER['SCRIPT_NAME'] ?>" method=post>
				Чё будем делать?
				<select name="action">
					<?= call_user_func($F, $_REQUEST['action']) ?><br>
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
			<?= $output;  ?>
			<form action="output.php"><input type="submit" value="Вывести"></form> 
	<? endif ?>
</body>
</html> 