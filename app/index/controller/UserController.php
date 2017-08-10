<?php
namespace index\controller;
use index\controller\BaseController;
use index\model\UserModel;
use cokiy\framework\VerifyCode;
class UserController extends BaseController
{
	protected $user;
	protected $image;

	public function _init()
	{
		$this->user = new UserModel();
		$this->image = new VerifyCode();
	}

	public function showyzm()
	{
		$_SESSION['code'] = $this->image->yzm();
	}

	public function registration()
	{
		$data = $this->user->userlist();
		$this->assign('data',$data);
		$this->display();
	}

	public function login()
	{
		$data = $this->user->userlist();
		$this->assign('data',$data);
		$this->display();
	}

	public function doRegister()
	{
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$name = $firstName . $lastName;
		// 验证密码的正则表达式
		$pattern_pwd = "/\D+/";
		// 验证邮箱的正则表达式
		$pattern_email = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
		if (strcasecmp($_POST['code'],$_SESSION['code'])) {
			$this->error('验证码输入错误');
			exit;
		}
		// 用户名少于3个字符，警告并退出
		if (mb_strlen($name) <= 3) {
			$this->error('用户名请用三个以上的字符');
			exit;
		}
		// 密码少于6位，警告并退出
		if (mb_strlen($password) < 6) {
			$this->error('密码长度最少6位');
			exit;
		}
		// 密码为纯数字，警告并退出
		if (!preg_match($pattern_pwd,$password)) {
			$this->error("密码不能为纯数字");
			exit;
		} 
		// 两次密码输入不一样，警告并退出
		if (strcmp($password,$repassword)) {
			$this->error("两次密码输入不一样");
			exit;
		}
		// 邮箱格式不正确，警告并退出
		if (!preg_match($pattern_email,$email)) {
			$this->error("请填写正确的邮箱");
			exit;
		} 
		$result = $this->user->realDoRegister($name,$email,$password);
		if (1 == $result) {
			$this->error("用户名已存在.");
		} elseif (2 == $result) {
			$_SESSION['username'] = $name;
			$this->success("注册成功.",'http://118.89.243.100/blog');
		} elseif (3 == $result) {
			$this->error('注册失败.');
		}
	}

	public function doLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (empty($username) || empty($password)) {
			$this->error('用户名或密码不能为空.');
			exit;
		}
		$result = $this->user->checkLogin($username,$password);
		if ($result) {
			$this->success('登陆成功.','http://118.89.243.100/blog');
		} else {
			$this->error('用户名或密码错误.');
		}
	}

	public function exit()
	{
		$_SESSION = [];
		unset($_COOKIE);
		session_destroy();
		$this->success('您已成功退出.','http://118.89.243.100/blog');
	}
}