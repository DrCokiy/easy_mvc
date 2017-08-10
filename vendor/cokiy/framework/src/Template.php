<?php
namespace cokiy\framework;
class Template
{
	protected $tplDir = './view';
	protected $cacheDir = './cache/app';
	protected $vars;
	protected $expireTime = 3600 * 24;

	public function __construct($tplDir = './view',$cacheDir = './cache/app',$expireTime = 3600)
	{
		$this->tplDir = $this->checkDir($tplDir);
		$this->cacheDir = $this->checkDir($cacheDir);
		$this->expireTime = $expireTime;
	}

	/**
	 * [assign 分配变量]
	 * @param  [type] $name  [变量名]
	 * @param  [type] $value [变量值]
	 * @return [type]        [没有]
	 */
	public function assign($name,$value)
	{
		$this->vars[$name] = $value;
	}

	/**
	 * [display 编译模板文件，加载缓存文件，显示]
	 * @param  [type] $viewFile  [模板文件名]
	 * @param  [type] $isExtract [是否还原变量]
	 * @return [type]            [无]
	 */
	public function display($viewFile,$isExtract = true)
	{
		//1 拼接模板文件和缓存文件的路径
		$tplFile = $this->tplDir . $viewFile;
		$cacheFile = $this->cacheDir . $this->replaceFileName($viewFile);
		//2 检测模板文件是否存在
		// var_dump($tplFile);
		if (!file_exists($tplFile)) {
			exit('模板文件不存在.');
		}
		//3 编译模板文件
		//3.1模板文件不存在或者模板文件修改时间晚于缓存文件创建时间
		if(!file_exists($cacheFile) || (filectime($cacheFile) < filemtime($tplFile)) || (filectime($cacheFile) + $this->expireTime < time() ) )
		{
			$this->checkDir(dirname($cacheFile));
			$content = file_get_contents($tplFile);
			$content = $this->compile($content);
			file_put_contents($cacheFile, $content);
		} else {
			$this->updateInclude($tplFile);
		}
	
		if ($isExtract) {
			extract($this->vars);
			include $cacheFile;
		}
	}

	protected function updateInclude($tplFile)
	{
		//读取模板文件内容
		$content = file_get_contents($tplFile);
		$pattern = '/\{include (.+)\}/';
		preg_match_all($pattern, $content, $matches);
		foreach ($matches[1] as $key => $value) {
			$value = trim($value ,'\'"');
			$this->display($value,false);
		}
	}

	protected function compile($content)
	{
		$rules = [
					'{$%%}' 			=>  '<?=$\1;?>',
					'{if %%}' 			=>  '<?php if(\1):?>',
					'{/if}'				=>  '<?php endif;?>',
					'{else}'			=>  '<?php else: ?>',
					'{elseif %%}'   	=>  '<?php elseif(\1):?>',
					'{else if %%}'  	=>  '<?php elseif(\1):?>',
					'{foreach %%}'		=>  '<?php foreach(\1):?>',
					'{/foreach}'		=>  '<?php endforeach;?>',
					'{while %%}'		=>  '<?php while(\1):?>',
					'{/while}'			=>  '<?php endwhile;?>',
					'{for %%}'			=>  '<?php for(\1):?>',
					'{/for}'			=>  '<?php endfor;?>',
					'{continue}'		=>  '<?php continue;?>',
					'{break}'			=>  '<?php break;?>',
					'{$%%++}'			=>  '<?php $\1++;?>',
					'{$%%--}'			=>  '<?php $\1--;?>',
					'{/*}'				=>  '<?php /*',
					'{*/}'				=>  '*/?>',
					'{section}'			=>  '<?php ',
					'{/section}'		=>  '?>',
					'{$%% = $%%}'		=>  '<?php $\1 = $\2;?>',
					'{default}'			=>  '<?php default:?>',
					'{include %%}'		=>  '<?php include "\1";?>'
					];
		foreach ($rules as $key => $value) {
			$key = preg_quote($key,'/');
			$pattern = '/' . str_replace('%%', '(.+)', $key) . '/ismU';
			if (stripos($value, 'include')) {
				$content = preg_replace_callback($pattern,[$this,'parseInclude'],$content);
			} else {
				$content = preg_replace($pattern, $value,$content);
			}
		}
		return $content;
	}

	public function parseInclude($data)
	{
		$file = trim($data[1],'\'"');
		$this->display($file,false);
		$cacheFile = $this->cacheDir . $this->replaceFileName($file);
		return "<?php include '$cacheFile';?>";
	}

	protected function replaceFileName($fileName)
	{
		return str_replace('.', '_', $fileName) . '.php';
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
		$dir = $this->replaceSeperator($dir);
		$flag = true;
		if (!is_dir($dir)) {
			$flag = mkdir($dir,0777,true);
		} elseif ((!is_readable($dir)) || (!is_writeable($dir))) {
			$flag = chmod($dir,0777,true);
		}
		if (!$flag) {
			exit('目录不存在或不可读写.');
		}
		return $dir;
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