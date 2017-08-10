<?php
namespace cokiy\framework;

class Upload
{
	public $uploadDir = './upload';
	public $isRandName = true;
	public $isdateDir = true;
	public $maxFileSize = 200 * 1024;
	public $path;
	public $uploadInfo;
	public $errorNo;
	public $allowSubfix = ['jpg','jpeg','pjpeg','wbmp','bmp','gif','png'];
	public $allowMime = ['image/png','image/wbmp','image/jpg','image/jpeg'];
	public $error = [
				-1 => '没有文件被上传.',
				-2 => '目录不存在且尝试创建时失败.',
				-3 => '修改目录权限失败.',
				-4 => '文件大小超出用户规定.',
				-5 => '文件后缀错误.',
				-6 => '文件MIME类型错误.',
				-7 => '不是上传文件.',
				-8 => '文件移动失败.',
				0 => '上传成功.',
				1 =>'上传的文件超过了php.ini中upload_max_filesize选项限制的值.',
				2=>'上传文件的大小超过了HTML表单中MAX_FILE_SIZE选项指定的值.',
				3=>'文件只有部分被上传.',
				4=>'没有文件被上传.',
				6=>'找不到临时文件夹.',
				7=>'文件写入失败.'
			];

	public function __construct(array $config = null)
	{
		if (!empty($config)) {
			foreach ($config as $key => $value) {
				if (property_exists(__CLASS__, $key)) {
					$this->$key = $value;
				}
			}
		}
		$this->uploadDir = $this->replaceSeperator($this->uploadDir);
	}

	/**
	 * [upload 文件上传函数，类外可直接调用]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $file [form表单中input的名字]
	 * @return  [type]           [执行成功返回文件路径，否则返回false]
	 */
	public function upload($file)
	{
		// 1检查上传信息
		if (!$this->checkUploadInfo($file))
		{
			return false;
		}
		// 2检查上传目录
		if (!$this->checkDir($this->uploadDir)) {
			return false;
		}
		// 3检查标准上传错误（系统规定）
		if (!$this->checkSystemError()) {
			return false;
		}
		// 4检查自定义的错误（大小、后缀、MIME）
		if (!$this->checkCustomError()) {
			return false;
		}
		// 5判断是否是上传文件
		if (!$this->checkIsUploadFile()) {
			return false;
		}
		// 6移动文件到指定目录
		if (!$this->moveFile()) {
			return false;
		}
		return $this->path;
	}

	/**
	 * [getError 获得错误信息]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [返回错误信息]
	 */
	public function getError()
	{
		return $this->error[$this->errorNo];
	}

	/**
	 * [moveFile 移动文件到指定文件夹]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [移动成功返回路径，否则返回false]
	 */
	protected function moveFile()
	{
		// 1拼接目录
		$path = $this->uploadDir;
		// 是否启用日期文件夹
		if ($this->isdateDir) {
			$path .= date('Y/m/d');
			if (!is_dir($path)) {
				mkdir($path,0777,true);
			}
			$path .= '/';
		}
		// echo $this->uploadDir . '<br />';
		// echo $path . '<br />';
		// 2是否随机文件名
		if ($this->isRandName) {
			$path .= uniqid() . '.' . $this->getSubfix($this->uploadInfo['name']);
		} else {
			$path .= $this->uploadInfo['name'];
		}
		// echo $path . '<br />';
		// die;
		// 3移动文件
		if (!move_uploaded_file($this->uploadInfo['tmp_name'], $path)) {
			$this->errorNo = -8;
			return false;
		} 
		$this->path = $path;
		return true;
	}

	/**
	 * [checkIsUploadFile 检测是否是上传文件]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [是上传文件返回true，否则返回false]
	 */
	protected function checkIsUploadFile()
	{
		if (!is_uploaded_file($this->uploadInfo['tmp_name'])) {
			$this->errorNo = -7;
			return false;
		}
		return true;
	}

	/**
	 * [checkCustomError 检测是否符合用户自定义要求]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [符合返回true，否则返回false]
	 */
	protected function checkCustomError()
	{
		// 1检测文件大小是否超过规定
		if ($this->uploadInfo['size'] > $this->maxFileSize) {
			$this->errorNo = -4;
			return false;
		}
		// 2检测文件后缀是否在规定范围内
		if (!in_array($this->getSubfix($this->uploadInfo['name']), $this->allowSubfix)) {
			$this->errorNo = -5;
			return false;
		}
		// 3mime类型检测
		if (!in_array($this->uploadInfo['type'], $this->allowMime)) {
			$this->errorNo = -6;
			return false;
		}
		return true;
	}

	/**
	 * [getSubfix 得到文件后缀信息]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $file [form表单中input的名字]
	 * @return  [type]           [返回文件后缀]
	 */
	protected function getSubfix($file)
	{
		return pathinfo($file)['extension'];
	}

	/**
	 * [checkSystemError 检测是否符合系统要求]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @return  [type]     [符合返回true，否则返回false]
	 */
	protected function checkSystemError()
	{
		$this->errorNo = $this->uploadInfo['error'];
		if (0 == $this->errorNo) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * [checkDir 检查目录是否存在以及是否可读可写]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $dir [目录名]
	 * @return  [type]          [创建或修改成功返回true，否则返回false]
	 */
	protected function checkDir($dir)
	{
		if (!is_dir($dir)) {
			if (!mkdir($dir,0777)) {
				$this->errorNo = -2;
				return false;
			}
			return true;
		}
		if ((!is_readable($dir)) || (!is_writeable($dir))) {
			if (!chmod($dir,0777)) {
				$this->errorNo = -3;
				return false;
			}
		}
		return true;
	}

	/**
	 * [checkUploadInfo 检查上传信息]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-14
	 * @param   [type]     $file [form表单中input的名字]
	 * @return  [type]           [description]
	 */
	protected function checkUploadInfo($file)
	{
		// 1检测有没有上传信息
		if (empty($_FILES[$file])) {
			$this->errorNo = -1;
			return false;
		}
		// 2保存上传信息
		$this->uploadInfo = $_FILES[$file];
		return true;
	}

	/**
	 * [replaceSeperator 替换路径中的斜线，以适应linux环境]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $dir [路径]
	 * @return  [type]          [返回替换后的路径]
	 */
	protected function replaceSeperator($dir)
	{
		$dir = str_replace('\\', '/', $dir);
		return $dir = rtrim($dir,'/') . '/';
	}
}