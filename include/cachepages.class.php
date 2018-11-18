<?php
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * 程序交流QQ：3479015851
 * QQ群 ：625621054  [入群提供技术支持]
`*/
class cachepages
{
	public $cacheRoot = '';
	public $cacheLimitTime = '';
	public $cacheFileName = '';
	public $cacheFileExt = 'php';

	public function cachepages($cacheLimitTime, $curscript)
	{
		if ($cacheLimitTime) {
			$this->cacheLimitTime = $cacheLimitTime;
		}

		if (CURSCRIPT == 'information') {
			$this->cacheRoot = QQ3479015851_DATA . '/pagesinfo/';
		}
		else if (CURSCRIPT == 'category') {
			$this->cacheRoot = QQ3479015851_DATA . '/pageslist/';
		}
		else {
			$this->cacheRoot = QQ3479015851_DATA . '/pagesqq3479015851/';
		}

		$this->cacheFileName = $this->getCacheFileName($curscript);
		ob_start();
	}

	public function cacheCheck()
	{
		global $timestamp;
		if ((0 < $this->cacheLimitTime) && file_exists($this->cacheFileName)) {
			$cachePagesTime = $this->getFileCreateTime($this->cacheFileName);

			if ($timestamp < ($cachePagesTime + $this->cacheLimitTime)) {
				echo file_get_contents($this->cacheFileName);
				ob_end_flush();
				exit();
			}
		}
	}

	public function caching($staticFileName = '')
	{
		global $timestamp;

		if ($staticFileName) {
			$this->saveFile($staticFileName, $cacheContent);
		}

		$cacheContent = ob_get_contents();
		ob_end_flush();
		$this->saveFile($this->cacheFileName, $cacheContent);
	}

	public function clearCache($fileName = 'all')
	{
		if ($fileName != 'all') {
			$fileName = $this->cacheRoot . $fileName . '.' . $this->cacheFileExt;

			if (file_exists($fileName)) {
				return @unlink($fileName);
			}
			else {
				return false;
			}
		}

		if (is_dir($this->cacheRoot)) {
			if ($dir = @opendir($this->cacheRoot)) {
				while ($file = @readdir($dir)) {
					$check = is_dir($file);

					if (!($check)) {
						@unlink($this->cacheRoot . $file);
					}
				}

				@closedir($dir);
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	public function getCacheFileName($curscript)
	{
		return $this->cacheRoot . $curscript . '.' . $this->cacheFileExt;
	}

	public function getFileCreateTime($fileName)
	{
		if (file_exists($fileName)) {
			return filemtime($fileName);
		}
		else {
			return 0;
		}
	}

	public function saveFile($fileName, $text)
	{
		if (!($fileName) || !($text)) {
			return false;
		}

		if ($this->makeDir(dirname($fileName))) {
			if ($fp = fopen($fileName, 'w')) {
				if (@fwrite($fp, $text)) {
					fclose($fp);
					return true;
				}
				else {
					fclose($fp);
					return false;
				}
			}
		}

		return false;
	}

	public function makeDir($dir, $mode = '0777')
	{
		if (!(file_exists($dir))) {
			makeDir(dirname($dir));
			mkdir($dir, $mode);
			return true;
		}
		else if (file_exists($dir)) {
			return true;
		}
		else {
			return false;
		}
	}
}


?>
