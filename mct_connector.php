<?php
	// Скрипт поощрений за голосования в рейтинге MC-T.RU
	// Данные, которые необходимо отредактировать под ваш проект:
	$mct_config_arr = array(
		'priz' => << priz >>,				// Награда за 1 голос
		'host' => '<< host >>', 			// IP сервера (чаще всего это localhost)
		'user' => '<< user >>', 			// Пользователь базы данных
		'passwd' => '<< password >>', 		// Пароль к базе данных
		'name' => '<< name >>', 			// Название базы данных
		'table' => '<< table >>', 			// Таблица, в которую будут начисляться деньги
		'money' => '<< money >>', 			// Столбец, в который выдается награда
		'secretkey' => '<< secretkey >>', 	// Секретный ключ на MC-T.Ru
		'nikname' => '<< nikname >>', 		// Столбец, в котором записываются ники игроков
	);

	// Если вы не разбираетесь в PHP и SQL, дальше ничего трогать не стоит.
	if (isset($_POST)) {
		$data = array(
			'timestamp' => $_POST['timestamp'],
			'username' => htmlspecialchars($_POST['username']),
			'signature' => $_POST['signature'],
			'session_id' => $_POST['session_id'],
		);
		$connect = mysqli_connect(
			$mct_config_arr['host'],
			$mct_config_arr['user'], 
			$mct_config_arr['passwd'], 
			$mct_config_arr['name']
		) or die('error connect');
		mysqli_select_db($connect, $mct_config_arr['name']) or die(mysqli_error());

		if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) die("Bad login");

		if ($data['signature'] != sha1(
			$data['username'].
			$data['timestamp'].
			$data['session_id'].
			$mct_config_arr['secretkey']
		) die("hash mismatch");

		$table = $mct_config_arr['table'];
		$money = $mct_config_arr['money'];
		$priz = $mct_config_arr['priz'];
		$nikname = $mct_config_arr['nikname'];
		$sql_username = strtolower($data['username']);

		mysqli_query($connect, "UPDATE {$table} SET $money = $money+$priz WHERE $nikname='{$sql_username}'") or die(mysqli_error($connect));
		mysqli_close($connect);
		echo json_encode(array('status' => 'ok'));

	} else {
		die('miss request');
	}

	// MC-T.RU (с) 2019-{% now 'Y' %}. Last update: 08.05.2019
