<?php
namespace index\model;
use index\model\BaseModel;
class DetailsModel extends BaseModel
{
	public function countBlog()
	{
		return count($this->where('parentid=0')->select());
	}

	public function countComment()
	{
		return count($this->where('parentid!=0')->select());
	}

	public function orderByReply()
	{
		return $this->fields('title,addtime,replycount,id,pic')->orderby('replycount desc,addtime desc')->where('parentid=0')->limit('4')->select();
	}

	public function showIndex($page,$countOfPage)
	{
		$page = ($page - 1) * $countOfPage;
		return $this->where('parentid=0')->limit("$page,$countOfPage")->select();
	}

	public function showSingle($id)
	{
		$blog = $this->fields('id,title,content,pic,addtime,replycount,hits')->where("id=$id")->select();
		$comment = $this->fields('id,title,content,addtime,cname')->where("parentid=$id")->select();
		return [$blog,$comment];
	}

	public function updatehits($id)
	{
		$hits = $this->fields('id,hits')->where("id=$id")->select()[0]['hits'] + 1;
		$this->updatevalues(['hits'=>$hits])->where("id=$id")->update();
	}

	public function realAddBlog($tit,$cont)
	{
		$parentid = 0;
		$authorid = 0;
		$title = $tit;
		$content = $cont;
		$addtime = time();
		$addip = ('::1' == $_SERVER['REMOTE_ADDR']) ? '127.0.0.1' :$_SERVER['REMOTE_ADDR'];
		$addip = ip2long($addip);
		// $pattern = "/src=[\'\"]((\w+\/)+)\w+.\w+[\'\"]/";
		$pattern = '/\((\w+\/)+\w+.\w+\)/';
		$res = preg_match($pattern,$content,$ma);
		if ($res) {
			$pic = $ma[0];
		} else {
			$pic = 'public/images/default.jpg';
		}
		$pic = trim($pic,'\(\)');
		return $this->insertvalues(['parentid'=>$parentid,'authorid'=>$authorid,'title'=>$title,'pic'=>$pic,'content'=>$content,'addtime'=>$addtime,'addip'=>$addip])->insert();
	}

	public function realAddComment($id,$cname,$content)
	{
		$parentid = 0;
		$authorid = 0;
		$addtime = time();
		$addip = ('::1' == $_SERVER['REMOTE_ADDR']) ? '127.0.0.1' :$_SERVER['REMOTE_ADDR'];
		$addip = ip2long($addip);
		$replycount = $this->fields('replycount')->where("id=$id")->select()[0]['replycount'] + 1;
		$this->updatevalues(['replycount'=>$replycount])->where("id=$id")->update();
		return $this->insertvalues(['parentid'=>$id,'authorid'=>$authorid,'cname'=>$cname,'content'=>$content,'addtime'=>$addtime,'addip'=>$addip])->insert();
	}
}