<?php
namespace index\model;
use index\model\BaseModel;
class UserModel extends BaseModel
{
	public function userlist()
	{
		return $this->fields('uid,username,password,usertype')->select();
	}

	public function userinfo($uid)
	{
		return $this->fields('username,picture')->where("uid=$uid")->select()[0];
	}

	public function realDoRegister($name,$email,$password)
	{
		$data = $this->userlist();
		if (!empty($data)) {
			foreach ($data as $value) {
				if ($name == $value['username']) {
					return 1;
				}
			}
		}
		
		$res = $this->insertvalues(['username'=>$name,'password'=>md5($password),'email'=>$email,'regtime'=>time(),'usertype'=>0])->insert();
		if ($res) {
			return 2;
		} else {
			return 3;
		}
	}

	public function checkLogin($username,$password)
	{
		$data = $this->fields('uid,username,password,usertype,picture')->select();
		foreach ($data as $value) {
			if (($username == $value['username']) && (md5($password) == $value['password'])) {
				$_SESSION['uid'] = $value['uid'];
				$_SESSION['username'] = $username;
				$_SESSION['usertype'] = $value['usertype'];
				return true;
			}
		}
		return false;
	}
}