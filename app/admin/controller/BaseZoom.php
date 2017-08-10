<?php
namespace admin\controller;
use cokiy\framework\WaterMark;
class BaseZoom extends WaterMark
{
	public function __construct()
	{
		parent::__construct('./public/images','jpg');
	}
}