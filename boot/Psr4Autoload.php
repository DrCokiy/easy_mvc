<?php
class Psr4Autoload
{
	protected $maps;

	public function __construct($config = null)
	{
		$this->maps = $config;
		spl_autoload_register([$this,'loadClass']);
	}

	protected function loadClass($className)
	{
		$arr = explode('\\',$className);
		$realClass = array_pop($arr);
		$namespace = implode('\\',$arr);
		$this->loadMap($namespace,$realClass);
	}

	protected function loadMap($namespace,$realClass)
	{
		if (array_key_exists($namespace, $this->maps)) {
			$path = $this->maps[$namespace];
		} else {
			$path = str_replace('\\','/',$namespace);
		}
		$path = rtrim($path,'/') . '/' . ucfirst($realClass) . '.php';
		// var_dump($path);
		if (!file_exists($path)) {
			exit('文件不存在');
		}
		include $path;
	}

}