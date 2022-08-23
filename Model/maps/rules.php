<?php
//если в массиве только одно значения запись должна быть в таком виде 'role' => array('field')
return array(
	'pages' => array(
		'fields' => array('id_parent', 'url', 'full_cache_url', 'title_in_menu', 'title', 'keywords', 'description', 'content', 'id_template', 'is_show', 'id_menu'), // поля, чтобы выкинуть из массива $_POST лишние элементы
		'not_empty' => array('id_parent', 'url', 'full_cache_url', 'title_in_menu', 'title', 'keywords', 'description', 'content'), // не могут быть пустыми
		'html_allowed' => array('content'), // для них не применяем htmlspecialchars
		'unique' => array('url', 'title_in_menu', 'title', 'full_cache_url'), // не даём занести в базу, если такие уже есть
		'min_length' => array(
			'title_in_menu' => '3',
			'title' => '3',
			'keywords' => '3',
			'description' => '3',
			'content' => '3'
		),
		'max_length' => array(
			'title_in_menu' => '200',
			'title' => '200',
			'keywords' => '500',
			'description' => '1000',
			'content' => '8000'
		),
		'range' => array(
			//количество символв в диапазоне от до
			'url' => array('3', '200')
		),
		'not_url' => array('url'),
		/*
			//правило для проверки соответствия одного поля другому
			//equals записывается только в таком виде ключ-проверочное поле, значение проверяемое поле
			'equals' => array(
						'field1' => 'field2',
						'field3' => 'field4'
						), */
		/*
			//для каждой таблицы можно добавить новое правило
			'rule' => array(),*/

		// специальные правила для полей типа пароля итп
		'special_rules' => array(
			//значения этих полей не должно быть одинаковым
			'illegal_entry' => array('id_parent', 'id_page'),
			'column1' => '>3',
			'column2' => 'int'
		),
		'labels' => array(
			/* 
				//здесь можно присвоить полю человекопонятное название
				'field' => '"Название"', */
			'url' => '"Адрес страницы"',
			'title_in_menu' => '"Заголовок в меню"',
			'title' => '"Заголовок страницы"',
			'keywords' => '"Ключевые слова"',
			'description' => '"Описание страницы"',
			'content' => '"Контент"',
			'id_parent' => '"Раздел"'
		),
		//первичный ключ таблицы
		'pk' => 'id_page'
	),
	'menu' => array(
		'fields' => array('title'),
		'not_empty' => array('title'),
		//массив 'html_allowed' нужно объявлять обязательно, даже если он пустой
		'html_allowed' => array(),
		'unique' => array('title'),
		'range' => array(
			'title' => array('3', '20')
		),
		'labels' => array(
			/* 
				//здесь можно присвоить полю человекопонятное название
				'field' => '"Название"', */
			'title' => '"Название меню"'
		),
		'pk' => 'id_menu'
	),




	'articles' => [
		'fields' => ['id_user', 'id_cat', 'title', 'url_art', 'description', 'words', 'content',  'img', 'alt',	'dt_add'],
		'not_empty' => ['title', 'content'],
		//массив 'html_allowed' нужно объявлять обязательно, даже если он пустой
		'html_allowed' => [],
		'unique' => [],
		'range' => [
			'title' => ['3', '200']
		],
		'labels' => [
			'title' => '"Название статьи"',
			'content' => '"Контент статьи"',
			'dt' => '"Дата"',
		],
		'pk' => 'id_article'
	],

	'cats' => [
		'fields' => [
			'title_cat',
			'url_cat',
			'nav_cat',
			'description_cat'
		],
		'not_empty' => [
			'title_cat',
			'nav_cat',
			'description_cat'
		],
		//массив 'html_allowed' нужно объявлять обязательно, даже если он пустой
		'html_allowed' => [],
		'unique' => [],
		'range' => [
			'title_cat' => ['3', '200']
		],
		'labels' => [
			'title_cat' => '"Название"',
			'nav_cat' => '"Навигационное название"',
			'description_cat' => '"Описание"'
		],
		'pk' => 'id_cat'
	],



	'call_back' => [
		'fields' => ['name', 'phone', 'qecode', 'info'],
		'not_empty' => ['phone'],
		'phone' => ['phone'], //проверка на телефон
		//массив 'html_allowed' нужно объявлять обязательно, даже если он пустой
		'html_allowed' => [],
		'unique' => [],
		'range' => [
			'title' => ['3', '200']
		],
		'labels' => [
			'name' => '"контактное лицо"',
			'phone' => '"номер телефона"',
			'dt' => '"Дата"',
		],
		'pk' => 'id_article'
	],




	'users' => array(
		'fields' => array('login', 'password'),
		'not_empty' => array('login', 'password'),
		'unique' => array(''),
		'authorized' => array(''),
		'html_allowed' => array(),
		'labels' => array(
			/* 
				//здесь можно присвоить полю человекопонятное название
				'field' => '"Название"', */
			'login' => '"Логин"',
			'password' => '"Пароль"',

		),
		'pk' => 'id_user'
	),
	'gallery' => array(
		'fields' => array('name', 'title'),
		'not_empty' => array('name', 'title'),
		'html_allowed' => array(),
		'unique' => array('name', 'title'),
		'max_length' => array(
			'name' => '20',
			'title' => '20',
		),
		'labels' => array(
			/* 
				//здесь можно присвоить полю человекопонятное название
				'field' => '"Название"', */
			'name' => '"Имя в системе"',
			'title' => '"Название"'
		),
		'pk' => 'id_gallery'
	),
	'templates' => array(
		'fields' => array('name', 'path'),
		'not_empty' => array('name', 'title'),
		'html_allowed' => array(),
		'unique' => array('name', 'path'),
		'pk' => 'id_template',
		'labels' => array(
			'name' => '"Имя в системе"',
			'path' => '"Путь"'
		)
	),
	'images' => array(
		'fields' => array('path', 'title_image', 'alt'),
		'not_empty' => array('path'),
		'html_allowed' => array(),
		'unique' => array('path'),
		'pk' => 'id_image',
		'labels' => array(
			'path' => '"Путь до изображения"',
			'title_image' => '"Тайтл изображения"',
			'alt' => '"Альтернативный текст"'
		)
	),
	'docs' => array(
		'fields' => array('title', 'path', 'type', 'is_show'),
		'not_empty' => array('title', 'path', 'type'),
		'html_allowed' => array(),
		'unique' => array('path'),
		'pk' => 'id_doc',
		'labels' => array(
			'title' => '"Название документа"',
			'path' => '"Путь до документа"'

		)
	),
	'texts' => array(
		'fields' => array('id_text', 'alias', 'title', 'content', 'dt', 'is_show'),
		'not_empty' => array('id_text', 'alias', 'content', 'dt'),
		'html_allowed' => array('content'),
		'unique' => array('alias'),
		'not_url' => array('alias'),
		'range' => array(
			'alias' => array('3', '30'),
			'title' => array('3', '200')
		),
		'labels' => array(
			'alias' => '"Алиас (ссылка)"',
			'title' => '"Название"',
			'content' => '"Текст"',
			'dt' => '"Дата"',
		),
		'pk' => 'id_text'
	),
);
