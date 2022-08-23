<?php

namespace Controllers;

abstract class BaseController
{
	// поля базового шаблона
	protected $description;
	protected $pageTitle;
	protected $pageContent;
	public $pageCanonical;

	protected $title;

	// свойства для работы контроллеров
	protected $request;
	protected $articleModel;
	protected $categoryModel;

	protected $scripts;
	protected $apiScripts;
	protected $styles;
	protected $user; //авторизированный пользовтель || null
	protected $path; //свойство для пагинации

	public function __construct()
	{
	}

	public function render()
	{
		echo $this->tmpGenerate('base/v_main', [
			'description' => $this->description,
			'pageTitle' => $this->pageTitle,
			'pageContent' => $this->pageContent,
			'canonical' => $this->pageCanonical,
			'user' => $this->user,
			'scripts' => $this->scripts,
			'apiScripts' => $this->apiScripts,
			'styles' => $this->styles
		]);
	}

	protected function tmpGenerate($path, array $vars = [])
	{
		extract($vars);
		ob_start();
		include("views/$path.php");
		return ob_get_clean();
	}

	//вспомогательная функция для функци getPagination
	protected function getTotal($url)
	{
		$lines = $this->articleModel->countLines($url); //получаем количество всех строк, если url существут, тогда берем количество строк по урлу
		return ceil($lines / ARTICLES_LIMIT); //получаем общее количество страниц
	}

	protected function getPagination(int $page, $url): ?array
	{
	    $page = (int)$page;
		$total = $this->getTotal($url);
		if ($page > $total) {
			return null;
		}
		$url = ($url !== null) ? $this->path . '/' . $url . '?' : $this->path . '?';

		$left = $page - 2;
		$right = $page  + 2;
		while ($left <= 0) {
			$left++;
			$right++;
		}
		while ($right > $total) {
			$left--;
			$right--;
		}
		return [
			'url' => $url,
			'total' => $total,
			'page' => $page,
			'left' => $left,
			'right' => $right,
		];
	}

	protected function getUrl(): string
	{
		$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$url = explode('?', $url);
		return $url[0];
	}


	protected function checkHasEntity($entity): bool
	{
		return isset($entity);
	}

	protected function previewText(string $article, int $start, int $end): string
	{
		$article = htmlspecialchars_decode($article);
		$article = strip_tags($article);
		$article = mb_substr($article, $start, $end, 'UTF-8');
		$article = rtrim($article, "!,.-");
		$article = substr($article, 0, strrpos($article, ' '));
		return $article . '...';
	}

	protected function cuteDate($date)
	{
		$today = date('d.m.Y', time());
		$yesterday = date('d.m.Y', time() - 86400);
		$dbDate = date('d.m.Y', strtotime($date));
		$dbTime = date('H:i', strtotime($date));
		switch ($dbDate) {
			case $today:
				$output = 'Сегодня в ' . $dbTime;
				break;
			case $yesterday:
				$output = 'Вчера в ' . $dbTime;
				break;
			default:
				$output = $dbDate;
		}
		return $output;
	}

	protected function getRedirect($url)
	{
		header("Location: $url");
		die;
	}

	protected function generateError(int $code)
	{
		$protocolHttp = $_SERVER['SERVER_PROTOCOL'];
		switch ($code) {
			case 403:
				$this->pageTitle = "Error $code Forbidden";
				$this->pageContent = $this->tmpGenerate("errors/v_$code");
				return header("$protocolHttp 403 Forbidden");
			case 404:
				$this->pageTitle = "Error $code Found";
				$this->pageContent = $this->tmpGenerate("errors/v_$code");
				return header("$protocolHttp 404 Not Found");
			case 301:
				$this->pageTitle = "Error $code Moved Permanently";
				$this->pageContent = $this->tmpGenerate("errors/v_$code");
				return header("$protocolHttp 301 Moved Permanently");
				//после return  break не требуется 
		}
	}

	protected function selectOption(int $selector, int $option)
	{
		if ($selector == $option)
			return "selected";
	}
}
