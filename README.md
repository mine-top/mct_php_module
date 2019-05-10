# Модуль подключения топа к своему проекту

```php
	// Скрипт поощрений за голосования в рейтинге MC-T.RU
	// Данные, которые необходимо отредактировать под ваш проект:
	$mct_config_arr = array(
		'priz' => {{ priz }},				      // Награда за 1 голос
		'host' => '{{ host }}', 			    // IP сервера (чаще всего это localhost)
		'user' => '{{ user }}', 			    // Пользователь базы данных
		'passwd' => '{{ password }}', 		// Пароль к базе данных
		'name' => '{{ name }}', 			    // Название базы данных
		'table' => '{{ table }}', 			  // Таблица, в которую будут начисляться деньги
		'money' => '{{ money }}', 			  // Столбец, в который выдается награда
		'secretkey' => '{{ secretkey }}', // Секретный ключ на MC-T.Ru
		'nikname' => '{{ nikname }}', 		// Столбец, в котором записываются ники игроков
	);
```

