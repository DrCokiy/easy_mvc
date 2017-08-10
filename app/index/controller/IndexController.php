<?php
namespace index\controller;
use index\controller\BaseController;
use index\model\DetailsModel;
use index\controller\BasePage;
class IndexController extends BaseController
{
	protected $var;
	protected $page;

	public function _init()
	{
		$this->var = new DetailsModel();
		$this->page = new BasePage();
	}

	public function index()
	{
		// 分页相关数据
		$first = $this->page->first();
		$pre = $this->page->pre();
		$page = $this->page->page;
		$offset = $this->page->offset;
		$max = $this->page->max;
		$next = $this->page->next();
		$last = $this->page->last();
		$total = $this->page->totalPage;
		// 得到首页需要显示的数据：博客标题及摘要
		$data = $this->var->showIndex($this->page->page,$this->page->countOfPage);
		// 首页右边的博客,按回复量排序
		$order = $this->var->orderByReply();
		// 分配数据
		$this->assign('total',$total);
		$this->assign('data',$data);
		$this->assign('first',$first);
		$this->assign('pre',$pre);
		$this->assign('page',$page);
		$this->assign('offset',$offset);
		$this->assign('max',$max);
		$this->assign('next',$next);
		$this->assign('last',$last);
		$this->assign('order',$order);
		
		// 显示模板
		$this->display();
	}
}