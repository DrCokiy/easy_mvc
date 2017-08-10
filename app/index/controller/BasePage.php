<?php
namespace index\controller;
use cokiy\framework\Page;
use index\model\DetailsModel;
class BasePage extends Page
{
	protected $details;

	public function __construct()
	{
		$this->details = new DetailsModel();
		$totalPage = $this->details->countBlog();
		parent::__construct($totalPage,2);
	}
}