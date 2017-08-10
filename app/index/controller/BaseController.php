<?php
namespace index\controller;
use cokiy\framework\Template;
class BaseController extends Template
{
	public function __construct()
	{
		parent::__construct('./app/index/view','./cache/index');
		$this->_init();
	}

	public function _init()
	{
		
	}

	public function display($viewFile = null,$isExtract = true)
	{
		if (empty($viewFile)) {
			$viewFile = $_GET['c'] . '/' . $_GET['a'] . '.html';
		}
		parent::display($viewFile,$isExtract);
	}

	public function notice($msg,$code=1,$url=null,$wait=3)
	{
		if (empty($url)) {
			$url = $_SERVER['HTTP_REFERER'];
		}
		include "app/index/view/notice.html";
	}

	public function success($msg,$url=null,$wait = 3)
	{
		$this->notice($msg,1,$url,$wait);
	}

	public function error($msg,$url=null,$wait = 3)
	{
		$this->notice($msg,0,$url,$wait);
	}
}