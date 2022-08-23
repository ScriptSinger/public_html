<?php
return [
	/* 
			//здесь можно добавить сообщение об ошибке, ключ - название правила
			//:label_1 - название проверяемого поля
			//:label_2 - название проверочного поля
			//:param_1 - первый числовой параметр, вместо него можно исспользовать :label_2
			//:param_2 - второй числовой параметр
			'rule' => 'Сообщение об ошибке', */
	'not_empty' => 'Поле :label_1 не должно быть пустым',
	'illegal_entry' => 'В поле :label_1 недопустимая запись',
	'unique' => 'Такая запись в поле :label_1 уже есть',
	'max_length' => 'В поле :label_1 должно быть не больше :param_1 символов',
	'min_length' => 'В поле :label_1 должно быть не меньше :param_1 символов',
	'exact_length' => 'В поле :label_1 должно быть :param_1 символов',
	'equals' => 'Значение поля :label_1 должно соответствовать значению поля :label_2',
	'email' => 'В поле :label_1 впишите правильный адрес электронной почты',
	'email_domain' => 'Поле :label_1 должно быть адресом электронной почты',
	'not_url' => 'В поле :label_1 вписаны недопустимые символы',
	'phone' => 'В поле :label_1 должен быть номер телефона',
	'date' => 'В поле :label_1 должена быть дата',
	'range' => 'В поле :label_1 должно быть от :param_1 до :param_2 символов',
	'authorized' => 'Неправильные пароль или логин!!'

];
