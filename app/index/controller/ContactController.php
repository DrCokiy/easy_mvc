<?php
namespace index\controller;
use index\controller\BaseController;
class ContactController extends BaseController
{
	public function contact()
	{
		$nothing = 1;
		$this->assign('nothing',$nothing);
		$this->display();
	}

	public function server()
	{
		if (empty($_POST['content'])) {
			$this->error('看来您没有什么想跟我们说的.','http://118.89.243.100/blog');
			exit;
		}
		extract($_POST);
		// 验证邮箱的正则表达式
		$pattern_email = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
		if (!preg_match($pattern_email,$email)) {
			$this->error("请填写正确的邮箱,方便我们联系您");
			exit;
		} 
		$pattern_phone = '/\d+/';
		if (!preg_match($pattern_phone,$phone)) {
			$this->error("请填写正确的电话号码,方便我们联系您");
			exit;
		}
		$this->success('您的意见我们已经收到，感谢您帮助我们进步.','http://118.89.243.100/blog');
	}
}