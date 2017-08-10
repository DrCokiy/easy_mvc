<?php
namespace admin\model;
use admin\model\BaseModel;
class DetailsModel extends BaseModel
{
	public function show($page,$countOfPage)
	{
		$page = ($page - 1) * $countOfPage;
		return $this->limit("$page,$countOfPage")->select();
	}

	public function countBlog()
	{
		return count($this->select());
	}

	public function deleteBorC($id)
	{
		return $this->where("id=$id")->delete();
	}
}