<?php
namespace index\controller;
use index\controller\BaseController;
class GalleryController extends BaseController
{
	public function gallery()
	{
		$nothing = 1;
		$this->assign('nothing',$nothing);
		$this->display();
	}
}