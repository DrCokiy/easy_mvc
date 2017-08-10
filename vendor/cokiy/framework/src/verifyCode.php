<?php
namespace cokiy\framework;
/**
 * 验证码,数字密码混合
 */
class VerifyCode
{
	protected $width = 80;
	protected $hight = 30;
	protected $length = 4;
	protected $imageType = 'png';
	protected $canvas;
	public $code;

	public function __construct($width = 80,$hight = 30,$length = 4,$imageType = 'png')
	{
		$this->width = ($width < 0) ? $this->width : $width;
		$this->hight = ($hight < 0) ? $this->width : $hight;
		$this->length = ($length < 3 || $length > 6) ? $this->length : $length;
		$this->imageType = $this->getImageType($imageType);
	}
	/**
	 * [getImageType 获得图片mime类型]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @param   [type]     $imageType [传入的类型]
	 * @return  [type]                [可识别的类型，否则退出]
	 */
	protected function getImageType($imageType)
	{
		$array = [
				'jpg' => 'jpeg',
				'pjpeg' => 'jpeg',
				'bmp' => 'wbmp',
				'png' => 'png'
		];
		if (array_key_exists($imageType,$array)) {
			return $imageType = $array[$imageType];
		} else {
			exit('图片格式不正确.');
		}
	}

	public function getCode()
	{
		return $this->code;
	}

	public function outputImage()
	{
		// 1创造画布
		$this->createImage();
		// 2生成验证码字符串
		$this->createCode();
		// 3画字符串
		$this->drawCode();
		// 4画干扰元素
		$this->drawInterferon();
		$this->drawLine();
		// 5输出到浏览器
		$this->sendImage();
		// 6销毁资源
		$this->destory();
	}

	protected function destory()
	{
		imagedestroy($this->canvas);
	}

	/**
	 * [drawInterferon 画干扰元素，点]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @return  [type]     [无]
	 */
	protected function drawInterferon()
	{
		for ($i=0; $i < 180; $i++) { 
			$x = rand(2,$this->width - 2);
			$y = rand(2,$this->hight - 2);
			imagesetpixel($this->canvas, $x, $y, $this->randColor(50,100));
		}
	}

	public function drawLine()
	{
		imageline($this->canvas, 0, 10, $this->width, $this->length, $this->randColor(50,90));
		imageline($this->canvas, ($this->width / 3), 0, ($this->width / 5 * 8), $this->width, $this->randColor(50,90));
	}

	/**
	 * [drawCode 画验证码字符串]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @return  [type]     [无]
	 */
	protected function drawCode()
	{
		for ($i=0; $i < $this->length; $i++) { 
			$x = 5 + $i * (($this->width - 5) / $this->length);
			$y = rand(2,($this->hight - 15));
			imagechar($this->canvas, 5, $x, $y, $this->code[$i], $this->randColor(1,80));
		}
	}

	/**
	 * [createCode 生成随机验证码，字母数字混合]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @return  [type]     [description]
	 */
	protected function createCode()
	{
		$this->code = substr(md5(rand() . ''),2,$this->length);
	}

	/**
	 * [sendImage 将图片输出到浏览器显示]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @return  [type]     [无]
	 */
	protected function sendImage()
	{
		header("content-type:image/" . $this->imageType);
		$funcName = 'image' . $this->imageType;
		if (function_exists($funcName)) {
			$funcName($this->canvas);
		} else {
			exit('不存在此类函数.');
		}
	}

	/**
	 * [createImage 创建画布]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @return  [type]     [无]
	 */
	protected function createImage()
	{
		$this->canvas = imagecreatetruecolor($this->width,$this->hight);
		$color = $this->randColor(127,200);
		imagefill($this->canvas, 0, 0, $color);
	}

	/**
	 * [randColor 产生随机颜色]
	 * @author cokiy
	 * @version [1.0]
	 * @date    2017-06-12
	 * @return  [type]     [无]
	 */
	protected function randColor($low,$height)
	{
		return imagecolorallocate($this->canvas, rand($low,$height), rand($low,$height), rand($low,$height));
	}


	public function yzm($width=100,$height=30,$len=4,$imageType='png')
	{
		$obj = new self($width=100,$height=30,$len=4,$imageType='png');
		$obj->outputImage();
		return $obj->code;
	}
}
