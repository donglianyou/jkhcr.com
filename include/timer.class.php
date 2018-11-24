<?php
/*
 * ============================================================================
 * 版权所有 114mps研发团队，保留所有权利。
 * 网站地址: http://my.roebx.com；
 * 博客教程：http://blog.csdn.net/qq_35921430；
 * ----------------------------------------------------------------------------
 * 这是一个自由软件！您可以对程序代码进行修改和使用。
 * ============================================================================
 * Powered By 中国健康养生网站
`*/
!(defined('SysGlbCfm')) && exit('FORBIDDEN');
class timer
{
	public $StartTime = 0;
	public $StopTime = 0;
	public $TimeSpent = 0;

	public function start()
	{
		$this->StartTime = microtime();
	}

	public function stop()
	{
		$this->StopTime = microtime();
	}

	public function spent()
	{
		if ($this->TimeSpent) {
			return $this->TimeSpent;
		}
		else {
			$StartMicro = substr($this->StartTime, 0, 10);
			$StartSecond = substr($this->StartTime, 11, 10);
			$StopMicro = substr($this->StopTime, 0, 10);
			$StopSecond = substr($this->StopTime, 11, 10);
			$start = doubleval($StartMicro) + $StartSecond;
			$stop = doubleval($StopMicro) + $StopSecond;
			$this->TimeSpent = $stop - $start;
			return substr($this->TimeSpent, 0, 8) . '秒';
		}
	}
}


?>
