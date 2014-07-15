<?php
	session_start();
	if(isset($_REQUEST['login']) and isset($_REQUEST['password'])) {
		$_SESSION['login'] = $_REQUEST['login'];
		$_SESSION['password'] = $_REQUEST['password'];
	}		
	function read_file() {
		$fp = fopen("users.txt", "r");
		return unserialize(fgets($fp, 999));
	}
	
	function selectItem($actions, $selected=0) {
		foreach($actions as $k => $v) {
			if ($k === $selected) $ch = " selected"; else $ch = "";
			$text .= "<option$ch value='$k'>$v</option>\n";
		}
		return $text;
	}
	
	if (isset($_REQUEST['action']))  $output = $_REQUEST['action'];
	
	$actions = array(
		"Пошел на работу, гавно чистить" => "Работать",
		"Ну ты ебанутый, бля" => "Как цапля стоять",
		"Ты можешь просто заткнуться, нихуя не говорить" => "Истории ахуительные рассказывать",
		"Еда" => "Покушать-то"
	);
 ?>
<html>
<head>
	<meta charset="utf8">
</head>
<body>	
	<? foreach (read_file() as $k => $v) : ?>
		<? if ($_SESSION["login"] ==$k && $_SESSION["password"]== $v['password']): ?>
			Доступ открыт для пользователя <?= $_SESSION['login'] ?> <br>
			<form action="<?=$_SERVER['SCRIPT_NAME'] ?>" method=post>
				Чё будем делать?
				<select name="action" id="">
					<?= selectItem($actions, $_REQUEST['action']) ?><br>
				</select>
				<input type="submit" value="Отправить">
			</form>
			<? break; ?>
		<? else: ?>
			Доступ закрыт.
			<? break; ?>
		<? endif; ?>
	<? endforeach; ?>	
	<? if  (isset($output) && $output != "1"): ?>
		<?= $output;  ?>
	<? endif; ?>
</body>
</html> 