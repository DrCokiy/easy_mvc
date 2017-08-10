<?php
namespace cokiy\framework;
class WaterMark
{
	public $saveDir = './image';
	public $imageType = 'png';
	public $isRandFileName = true;
	public $path;

	/**
	 * [__construct 构造函数，给成员属性赋值]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $saveDir        [要保存的路径]
	 * @param   [type]     $imageType      [要保存的类型]
	 * @param   boolean    $isRandFileName [是否随机文件名]
	 */
	public function __construct($saveDir,$imageType,$isRandFileName = true)
	{
		// 替换目录中的斜线
		$this->saveDir = $this->replaceSeperator($saveDir);
		$this->saveDir = $saveDir;
		if (!$this->checkDir($saveDir)) {
			exit('目录不存在或不可读写.');
		}
		$this->isRandFileName = $isRandFileName;
	}

	/**
	 * [waterMark 给图片加水印]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $dest   [目标图片]
	 * @param   [type]     $source [水印图片]
	 * @param   integer    $pos    [水印位置，九宫格或随机]
	 * @param   integer    $alpha  [水印透明度]
	 * @return  [type]             [无]
	 */
	public function waterMark($dest,$source,$pos = 5,$alpha = 100)
	{
		// 1路径检测
		if (!file_exists($dest) || !file_exists($source)) {
			exit('目标文件或水印文件不存在');
		}
		// 2计算图片尺寸
		list($destWidth,$destHeight) = getimagesize($dest);
		list($sourceWidth,$sourceHeight) = getimagesize($source);
		// var_dump($destWidth,$destHeight);
		// var_dump($sourceWidth,$sourceHeight);
		// die;
		if (($destWidth < $sourceWidth) || ($destHeight < $sourceHeight)) {
			exit('水印图片比目标图片大.');
		}
		// 3计算水印位置
		$postion = $this->getPosition($destWidth,$destHeight,$sourceWidth,$sourceHeight,$pos);
		// 4合并图片
		$destImage = $this->openImage($dest);
		$sourceImage = $this->openImage($source);
		if (!$destImage || !$sourceImage) {
			exit('无法打开图片文件.');
		}
		imagecopymerge($destImage, $sourceImage, $postion['x'], $postion['y'], 0, 0, $sourceWidth, $sourceHeight, $alpha);
		// 5保存图片
		$this->saveImage($destImage,$dest);
		// 6销毁资源
		imagedestroy($destImage);
		imagedestroy($sourceImage);
	}

	/**
	 * [zoom 图片缩放]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $imageFile [要缩放的文件名]
	 * @param   [type]     $width     [预期宽度]
	 * @param   [type]     $height    [预期高度]
	 * @param   boolean    $isequal   [是否等比例缩放，默认true，即等比缩放]
	 * @return  [type]                [无]
	 */
	public function zoom($imageFile,$width,$height,$isequal = true)
	{
		// 1路径检测
		if (!file_exists($imageFile)) {
			exit('图片不存在.');
		}
		// 2计算缩放尺寸
		list($oldWidth,$oldHeight) = getimagesize($imageFile);
		$size = $this->scaleCul($oldWidth,$oldHeight,$width,$height,$isequal);
		// 3合并图片
		$oldImage = $this->openImage($imageFile);
		if ($isequal) {
			$destImage = imagecreatetruecolor($width, $height);
			imagecopyresampled($destImage, $oldImage, $size['x'], $size['y'], 0, 0, $size['newWidth'], $size['newHeight'], $oldWidth, $oldHeight);
		} else {
			$destImage = imagecreatetruecolor($width, $height);
			imagecopyresampled($destImage, $oldImage, $size['x'], $size['y'], 0, 0, $size['newWidth'], $size['newHeight'], $oldWidth, $oldHeight);
		}
		
		
		// 4保存图片
		$this->saveImage($destImage, $imageFile);
		// 释放资源
		imagedestroy($destImage);
		imagedestroy($oldImage);
	}

	/**
	 * [scaleCul 计算缩放后的图片宽高以及显示位置]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $oldWidth  [图片原始宽度]
	 * @param   [type]     $oldHeight [图片原始高度]
	 * @param   [type]     $width     [预期宽度]
	 * @param   [type]     $height    [预期高度]
	 * @param   [type]     $isequal   [是否等比例缩放，默认true，即等比缩放]
	 * @return  [type]                [返回新的图片宽高以及显示坐标]
	 */
	protected function scaleCul($oldWidth,$oldHeight,$width,$height,$isequal)
	{
		$widthScale = $width / $oldWidth;
		$heightScale = $height / $oldHeight;
		$scale = min($widthScale,$heightScale);
		if ($isequal) {
			$newWidth = $oldWidth * $scale;
			$newHeight = $oldHeight * $scale;
		} else {
			$newWidth = $oldWidth * $widthScale;
			$newHeight = $oldHeight * $heightScale;
		}
		if ($widthScale < $heightScale) {
			$y = ($height - $newHeight) / 2;;
			$x = 0;
		} else {
			$y = 0;
			$x = ($width - $newWidth) / 2;
		}
		return [
				'newWidth' => $newWidth,
				'newHeight' => $newHeight,
				'x' => $x,
				'y' => $y
			];
	}

	/**
	 * [saveImage 保存添加过水印的图片]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $image      [图像资源]
	 * @param   [type]     $originFile [文件名]
	 * @return  [type]                 [无]
	 */
	protected function saveImage($image,$originFile)
	{
		if ($this->isRandFileName) {
			$path = $this->saveDir . '/' . uniqid() . '.' . $this->imageType;
		} else {
			$path = $this->saveDir . '/' . pathinfo($originFile)['filename'] . '.' . $this->imageType;
		}
		$this->path = $path;
		// var_dump($path);
		// die;
		$funcName = 'image' . $this->imageType;
		if (function_exists($funcName)) {
			$funcName($image,$path);
		} else {
			exit('图片无法保存.');
		}
	}

	/**
	 * [openImage 打开图片]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $file [文件名]
	 * @return  [type]           [成功返回图像资源，失败返回false]
	 */
	protected function openImage($file)
	{
		$type = exif_imagetype($file);
		$types = [0,'gif','jpeg','png','swf','psd','wbmp'];
		$funcName = 'imagecreatefrom' . $types[$type];
		return $funcName($file);
	}

	/**
	 * [getPosition 计算水印位置]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-13
	 * @param   [type]     $destWidth    [目标文件宽度]
	 * @param   [type]     $destHeight   [目标文件高度]
	 * @param   [type]     $sourceWidth  [水印图片宽度]
	 * @param   [type]     $sourceHeight [水印图片高度]
	 * @param   [type]     $pos          [位置1~9，超出此范围则随机位置]
	 * @return  [type]                   [返回水印左上角坐标]
	 */
	protected function getPosition($destWidth,$destHeight,$sourceWidth,$sourceHeight,$pos)
	{
		if (($pos < 1) || ($pos > 9)) {
			$x = rand(0,$destWidth - $sourceWidth);
			$y = rand(0,$destHeight - $sourceHeight);
		} else {
			$x = ($pos - 1) % 3 *($destWidth - $sourceWidth) / 2;
			$y = (int)(($pos - 1) / 3) * ($destHeight - $sourceHeight) / 2;
		}
		return ['x' => $x, 'y' => $y];
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
			return mkdir($dir,0777);
		}
		if ((!is_readable($dir)) || (!is_writeable($dir))) {
			chmod($dir,0777);
		}
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

