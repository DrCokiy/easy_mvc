<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\UserModel;
class IndexController extends BaseController
{
	protected $var;

	public function _init()
	{
		$this->var = new UserModel();
		parent::_init();
	}

	public function index()
	{
		$data = $this->var->showUser(6);
		$this->assign('data',$data);
		$this->display();
	}
}