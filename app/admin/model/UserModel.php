<?php
namespace admin\model;
use admin\model\BaseModel;
class UserModel extends BaseModel
{
	public function showUser($uid)
	{
		return $this->where("uid=$uid")->fields('username,picture,phone,qq,email')->select()[0];
	}

	public function doChangeUser($uid,$picture,$phone,$qq,$email)
	{
		return $this->updatevalues(['picture'=>$picture,'phone'=>$phone,'qq'=>$qq,'email'=>$email])->where("uid=$uid")->update();
	}
}