<?php
namespace admin\controller;
use cokiy\framework\Page;
use admin\model\DetailsModel;
class BasePage extends Page
{
	protected $details;

	public function __construct()
	{
		$this->details = new DetailsModel();
		$totalCount = $this->details->countBlog();
		parent::__construct($totalCount,5);
	}
}