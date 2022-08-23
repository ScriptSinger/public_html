<?php

namespace Core;

class App
{
	public $request;
	private $routes;
	private $ipBlackList;
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->routes = include_once ROUTING_PATH;
     	$this->ipBlackList = include_once BAN_MAP_PATH;
	}

	public function go()
	{
	    $ip = $this->request->getIp();
	    $cityFull = System::getCity($ip);
		Logger::getInstance()->addVisitLog($ip, $cityFull)->checkIpByBlacklist($ip, $this->ipBlackList);
		
	
	    $qsu = $this->request->qsu;
		//проверка на index.php---------------------------------------
		$uriParts = $this->getUriParts($_SERVER['REQUEST_URI']);
		if (strpos($uriParts['url'], BASE_URL . 'index.php') === 0 || $this->hasDoubleSlashes($uriParts['url'])) {
			$qsu = 'default';
		}
		//------------------------------------------------------------
		$route = $this->getRouteByRequest($qsu, $this->routes);
		define('URL_PARAMS', $route['params']);
		$ctrlName = $route['controller'];
		$path = "Controllers\\$ctrlName"; // двойной слэш для экранирования обратного слэша
		$ctrl = new $path($this->request);
		$action = $route['action'];
		$ctrl->$action();
		$ctrl->pageCanonical = $this->generateLinkCanonical($qsu); //сгенерировать каноническую ссылку без слэша в конце
		$ctrl->render();
	}

	private function getRouteByRequest(string $url,  array $routes): array
	{
		$res = [
			'controller' => 'ErrorController',
			'action' => 'notFoundAction',
			'params' => []
		];
		foreach ($routes as $route) {
			$matches = [];
			if (preg_match($route['pattern'], $url, $matches)) {
				$res['controller'] = $route['controller'];
				$res['action'] = $route['action'];
				if (isset($route['params'])) {
					foreach ($route['params'] as $name => $num) {
						$res['params'][$name] = $matches[$num];
					}
				}
				break;
			}
		}
		//  find route, parse params
		return $res;
	}

	//отделить базовую часть url от части с GET параметрами
	private function getUriParts(string $uri): array
	{
		$parts = explode('?', $uri);
		return [
			'url' => $parts[0] ?? '',
			'get' => $parts[1] ?? ''
		];
	}

	private function hasDoubleSlashes(string $uri): bool
	{
		$pattern = '/\/{2,}/';
		return !!preg_match($pattern, $uri);
	}

	private function generateLinkCanonical(string $qsu)
	{
		$pageCanonical = DOMAIN . BASE_URL;
		$qsuLenght = strlen($qsu);
		if ($qsuLenght > 0 && $qsu[$qsuLenght - 1] == '/') {
			$qsu = substr($qsu, 0, $qsuLenght - 1);
		}
		return	$pageCanonical .= $qsu;
	}
}
