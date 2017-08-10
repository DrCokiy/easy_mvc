<?php
namespace cokiy\framework;

class Page
{
	public $totalCount;
	public $totalPage;
	public $countOfPage = 10;
	public $page;
	public $url;
	public $limit = 5;
	public $offset;
	public $max;

	public function __construct($totalCount,$countOfPage)
	{
		$this->totalCount = $totalCount;
		$this->limit = ($totalCount > $this->limit) ? $this->limit : $totalCount;
		$this->countOfPage = ($countOfPage > 0) ? $countOfPage : $this->countOfPage;
		$this->totalPage = ceil($totalCount / $countOfPage);
		$this->getPage();
		$this->getUrl();
		$this->getOffset();
	}

	public function outPager()
	{
		echo "<div class='yeshutiao'>";
			echo "<b><a href='" . $this->pre() . "'" . '>上一页</a></b>';
			for ($i = $this->offset; $i <= $this->max; $i++) { 
				echo "<b><a href='" . $this->setUrl($i) . "'" . '>' . $i . '</a></b> ';
			}
			echo "<b><a href='" . $this->next() . "'" . '>下一页</a></b>';
		echo "</div>";
	}

	public function getOffset()
	{
		$this->offset = $this->page - floor($this->limit / 2);
		if ($this->offset <= 1) {
			$this->offset = 1;
		}
		$this->max = $this->limit + $this->offset;
		if ($this->max > $this->totalPage) {
			$this->max = $this->totalPage;
			$tmp = $this->max - $this->limit;
			$this->offset = ($tmp <=1) ? 1 : $tmp;
		}
	}

	/**
	 * [first 返回第一页的url]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [返回第一页的url]
	 */
	public function first()
	{
		return $this->setUrl(1);
	}

	/**
	 * [last 返回最后一页的url]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [返回最后一页的url]
	 */
	public function last()
	{
		return $this->setUrl($this->totalPage);
	}

	/**
	 * [pre 返回上一页的url]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [返回上一页的url]
	 */
	public function pre()
	{
		if ($this->page <= 1) {
			return $this->first();
		}
		return $this->setUrl($this->page - 1);
	}

	/**
	 * [next 返回下一页的url]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  function   [返回下一页的url]
	 */
	public function next()
	{
		if ($this->page >= $this->totalPage) {
			return $this->last();
		}
		return $this->setUrl($this->page + 1);
	}

	/**
	 * [setUrl 获得每一页的url]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $page [返回每一页的url]
	 */
	public function setUrl($page)
	{
		if (stripos($this->url,'?')) {
			return  $this->url . '&page=' . $page;
		} else {
			return  $this->url . '?page=' . $page;
		}
	}

	/**
	 * [getUrl 取得当前页面的url]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [无，直接将$this->url设置为当前页面的url]
	 */
	public function getUrl()
	{
		$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . ':' .  $_SERVER['SERVER_PORT']; // $_SERVER['REQUEST_URI']
		$data = parse_url($_SERVER['REQUEST_URI']);
		
		if (isset($data['query'])) {
			parse_str($data['query'],$res);
			if (array_key_exists('page',$res)) {
				unset($res['page']);
			}
			$url .= $data['path'] . '?' . http_build_query($res);
		} else {
			$url .= $_SERVER['REQUEST_URI'];
		}

		$url = rtrim($url,'?'); 
		$this->url = $url;
		// echo $url . '<br />';
	}

	/**
	 * [getPage 获得当前页页码]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [无，直接修改$this->page为当前页页码]
	 */
	public function getPage()
	{
		if (empty($_GET['page'])) {
			$this->page = 1;
		} else {
			$page = $_GET['page'];
			if ($page <= 1) {
				$this->page = 1;
			} elseif ($page >= $this->totalPage) {
				$this->page = $this->totalPage;
			} else {
				$this->page = $page;
			}
		}
	}
}