<?php
namespace index\controller;
use index\model\DetailsModel;
use index\model\UserModel;
use index\controller\BaseController;
class ArticleController extends BaseController
{
	protected $var;
	protected $use;

	public function _init()
	{
		$this->var = new DetailsModel();
		$this->use = new UserModel();
	}

	public function newBlog()
	{
		$data = $this->var->countBlog();
		$order = $this->var->orderByReply();
		$this->assign('order',$order);
		$this->assign('data',$data);
		$this->display();
	}

	public function newBlog2()
	{
		$data = $this->var->countBlog();
		$order = $this->var->orderByReply();
		$this->assign('order',$order);
		$this->assign('data',$data);
		$this->display();
	}

	public function single()
	{
		$id = $_GET['id'];
		if (!empty($_SESSION['uid'])) {
			$uid = $_SESSION['uid'];
			$user = $this->use->userinfo($uid);
			$this->assign('user',$user);
		}
		// 浏览量加1
		$this->var->updatehits($id);
		// 从数据库取出对应博文及其回复
		$blog = $this->var->showSingle($id)[0][0];
		$comment = $this->var->showSingle($id)[1];
		$order = $this->var->orderByReply();
		
		$this->assign('blog',$blog);
		$this->assign('comment',$comment);
		$this->assign('order',$order);
		$this->display();
	}

	public function addBlog()
	{
		if (empty($_POST['title'])) {
			$this->error('标题不能为空');
		}
		if (empty($_POST['content'])) {
			$this->error('内容不能为空');
		}
		$title = $_POST['title'];
		$content = $_POST['content'];
		$result = $this->var->realAddBlog($title,$content);
		if ($result) {
			$this->success('发表成功.','http://118.89.243.100/blog');
		} else {
			$this->error('发表失败.');
		}
	}

	public function addComment()
	{
		$id = $_POST['id'];
		if (empty($_POST['content'])) {
			$this->error('评论内容不能为空.');
			exit;
		}
		$content = $_POST['content'];
		
		$cname = ('::1' == $_SERVER['REMOTE_ADDR']) ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
		$cname = 'yk' . ip2long($cname);
		if (!empty($_POST['cname'])) {
			$cname = $_POST['cname'];
		} elseif (!empty($_SESSION['username'])) {
			$cname = $_SESSION['username'];
		}

		$result = $this->var->realAddComment($id,$cname,$content);
		if ($result) {
			$this->success('发表成功.');
		} else {
			$this->error('发表失败.');
		}
	}
}