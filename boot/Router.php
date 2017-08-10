<?php
include 'Psr4Autoload.php';
class Router
{
	public static $autoloader;

	public static function init()
	{
		$config = include 'config/namespace.php';
		self::$autoloader = new Psr4Autoload($config);
		session_start();
	}

	public static function run()
	{
		$_GET['m'] = empty($_GET['m']) ? 'index' : $_GET['m'];
		$_GET['c'] = empty($_GET['c']) ? 'index' : $_GET['c'];
		$_GET['a'] = empty($_GET['a']) ? 'index' : $_GET['a'];
		$c = $_GET['m'] . '\\controller\\' . $_GET['c'] . 'Controller';
		call_user_func([new $c,$_GET['a']]);
	}
}