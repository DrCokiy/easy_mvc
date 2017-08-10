<?php
namespace admin\controller;
use admin\model\DetailsModel;
use admin\controller\BasePage;
use admin\controller\BaseController;
class BlogController extends BaseController
{
	protected $var;
	protected $page;

	public function _init()
	{
		$this->var = new DetailsModel();
		$this->page = new BasePage();
		parent::_init();
	}

	public function blogList()
	{
		$first = $this->page->first();
		$pre = $this->page->pre();
		$page = $this->page->page;
		$offset = $this->page->offset;
		$max = $this->page->max;
		$next = $this->page->next();
		$last = $this->page->last();
		$total = $this->page->totalPage;
		$data = $this->var->show($this->page->page,$this->page->countOfPage);

		$this->assign('total',$total);
		$this->assign('data',$data);
		$this->assign('first',$first);
		$this->assign('pre',$pre);
		$this->assign('page',$page);
		$this->assign('offset',$offset);
		$this->assign('max',$max);
		$this->assign('next',$next);
		$this->assign('last',$last);
		$this->display();
	}

	public function delete()
	{
		$id = $_GET['id'];
		$result = $this->var->deleteBorC($id);
		if ($result) {
			$this->success('删除成功.');
		} else {
			$this->error('这货跟病毒一样顽固，删不掉啊.');
		}
	}
}