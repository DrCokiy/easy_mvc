<?php
namespace admin\controller;
use admin\controller\BaseController;
use admin\model\UserModel;
use admin\controller\BaseZoom;
use cokiy\framework\Upload;
class UserController extends BaseController
{
	protected $var;
	protected $upload;
	protected $uid;
	protected $image;

	public function _init()
	{
		parent::_init();
		$this->var = new UserModel();
		$this->upload = new Upload();
		$this->image = new BaseZoom();
		$this->uid = $_SESSION['uid'];
	}

	public function userinfo()
	{
		$data = $this->var->showUser($this->uid);
		$this->assign('data',$data);
		$this->display();
	}


	public function updateUser()
	{
		// 上传头像
		$this->upload->upload('file');
		$this->image->zoom($this->upload->path,80,80);
		$picture = $this->image->path;
		$phone = $_POST['phone'];
		$qq = $_POST['qq'];
		$email = $_POST['email'];
		// 验证数字的正则表达式
		$pattern_phone = '/\d+/';
		if (!preg_match($pattern_phone,$qq)) {
			$this->error("请填写正确的手机号码");
			exit;
		}
		// 验证数字的正则表达式
		$pattern_phone = '/\d+/';
		if (!preg_match($pattern_phone,$phone)) {
			$this->error("请填写正确的手机号码");
			exit;
		}
		// 验证邮箱的正则表达式
		$pattern_email = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
		if (!preg_match($pattern_email,$email)) {
			$this->error("请填写正确的邮箱");
			exit;
		}
		$result = $this->var->doChangeUser($this->uid,$picture,$phone,$qq,$email);
		if ($result) {
			$this->success('修改成功.');
		} else {
			$this->error('修改失败.');
		}
	}
}