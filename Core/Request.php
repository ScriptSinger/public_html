<?php

namespace Core;

class Request
{
	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';

	public $querysystem;
	public $post;
	public $server;
	public $route;

	public $qsu;
	public $get; //массив с get параметрами

	public function __construct(array $querysystem, array $post, array $server)
	{
		$this->post = $post;
		$this->querysystem = $querysystem;
		$this->server = $server;

		// $this->makeParams();
		$this->qsu = $querysystem['querysystemural'] ?? '';
		$this->get = [];
		$this->makeParameters();
	}

	public function setGet($name, $value)
	{
		$this->querysystem[$name] = $value;
	}

	public function isGet()
	{
		return $this->server['REQUEST_METHOD'] == self::METHOD_GET;
	}

	public function isPost()
	{
		return $this->server['REQUEST_METHOD'] == self::METHOD_POST;
	}

	public function getMethod()
	{
		return $this->server['REQUEST_METHOD'];
	}

	private function makeParameters()
	{

		$buffer = explode('?', $this->server['REQUEST_URI']);
		$this->route = $buffer[0];
		if (isset($buffer[1])) {
			$rightPart = explode('&', $buffer[1]);
			foreach ($rightPart as $pair) {
				$temp = explode('=', $pair);
				$key = $temp[0];
				unset($temp[0]);
				$this->get[$key] = implode('=', $temp);
			}
		}
	}

    public function getIp()
	{
		$keys = [
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'REMOTE_ADDR'
		];
		foreach ($keys as $key) {
			if (!empty($_SERVER[$key])) {
				$ipArray = explode(',', $_SERVER[$key]);
				$ip = trim(end($ipArray));
				if (filter_var($ip, FILTER_VALIDATE_IP)) {
					return $ip;
				}
			}
		}
	}



	// private function makeParams()
	// {
	// 	$get = [];
	// 	$buffer = explode('?', $this->server['REQUEST_URI']);
	// 	$this->route = $buffer[0];

	// 	if (isset($buffer[1])) {
	// 		$pairs = explode('&', $buffer[1]);

	// 		foreach ($pairs as $pair) {
	// 			$buffer = explode('=', $pair);
	// 			$get[$buffer[0]] = $buffer[1];
	// 		}
	// 	}

	// 	$this->get = $get;
	// }
}
