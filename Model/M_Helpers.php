<?php

namespace Model;

class M_Helpers
{
	private static $privs;

	// public static function can_look($priv)
	// {
	// 	if (self::$privs === null)
	// 		self::$privs = M_Users::Instance()->GetPrivs();

	// 	return (in_array('ALL', self::$privs) || in_array($priv, self::$privs));
	// }

	public static function unique_name($dir, $name, $translit = false)
	{
		$name = preg_replace('/[:\/\"]+/', '', $name);
		$temp = explode('\\', $name);
		$name = end($temp);

		if ($name == '')
			return '';

		$temp = explode(' ', $name);
		$name = implode('_', $temp);

		if ($translit)
			$name = self::make_tarnslit($name);

		if (file_exists($dir . $name)) {
			$temp = explode('.', $name);
			$ext = array_pop($temp);
			$i = 1;
			$str = "($i)";
			$name = implode('.', $temp) . $str . ".$ext";

			while (file_exists($dir . $name)) {
				$i++;
				$str = "($i)";
				$name = implode('.', $temp) . $str . ".$ext";
			}
		}

		return $name;
	}

	// public static function get_hash($str)
	// {
	// 	$i = 0;
	// 	while ($i++ < 4)
	// 		$str = md5(md5($str . HASH_KEY) . $str);

	// 	return $str;
	// }

	// public static function text($alias){
	// 	$text = M_Texts::Instance()->getByA($alias);

	// 	if(M_Users::Instance()->Can('PAGES'))
	// 		$text['content'] = self::front_text_wrap($text);

	// 	return $text['content'];
	// }

	// public static function front_text_wrap($text){
	// 	return "<div widget-toggle=\"text\" id_widget_note=\"{$text['id_text']}\"
	// 				 style = \"display: inline-block;\">
	// 				<span change_key=\"content\" replace=\"textarea\">{$text['content']}</span>
	// 			</div>";
	// }

	// public static function front_widget($type, $one)
	// {
	// 	$res = '';

	// 	if (M_Users::Instance()->Can('PAGES')) {
	// 		$pk = "id_$type";
	// 		$res = "widget-toggle=\"$type\" id_widget_note=\"{$one[$pk]}\"";
	// 	}

	// 	return $res;
	// }

	// public static function front_field($key, $type)
	// {
	// 	$res = '';

	// 	if (M_Users::Instance()->Can('PAGES'))
	// 		$res = "change_key=\"$key\" replace=\"$type\"";

	// 	return $res;
	// }

	public static function make_tarnslit($str)
	{
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',

			'г' => 'g',   'д' => 'd',   'е' => 'e',

			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

			'и' => 'i',   'й' => 'y',   'к' => 'k',

			'л' => 'l',   'м' => 'm',   'н' => 'n',

			'о' => 'o',   'п' => 'p',   'р' => 'r',

			'с' => 's',   'т' => 't',   'у' => 'u',

			'ф' => 'f',   'х' => 'h',   'ц' => 'c',

			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

			'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



			'А' => 'A',   'Б' => 'B',   'В' => 'V',

			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

			'И' => 'I',   'Й' => 'Y',   'К' => 'K',

			'Л' => 'L',   'М' => 'M',   'Н' => 'N',

			'О' => 'O',   'П' => 'P',   'Р' => 'R',

			'С' => 'S',   'Т' => 'T',   'У' => 'U',

			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

			'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

		);

		return strtr($str, $converter);
	}
}
