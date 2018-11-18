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
class Excel_XML
{
	/**
	 * Header (of document)
	 * @var string
	 */
	private $header = "<?xml version=\"1.0\" encoding=\"%s\"?\\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";
	/**
         * Footer (of document)
         * @var string
         */
	private $footer = '</Workbook>';
	/**
         * Lines to output in the excel document
         * @var array
         */
	private $lines = array();
	/**
         * Used encoding
         * @var string
         */
	private $sEncoding;
	/**
         * Convert variable types
         * @var boolean
         */
	private $bConvertTypes;
	/**
         * Worksheet title
         * @var string
         */
	private $sWorksheetTitle;

	public function __construct($sEncoding = 'UTF-8', $bConvertTypes = false, $sWorksheetTitle = 'Table1')
	{
		$this->bConvertTypes = $bConvertTypes;
		$this->setEncoding($sEncoding);
		$this->setWorksheetTitle($sWorksheetTitle);
	}

	public function setEncoding($sEncoding)
	{
		$this->sEncoding = $sEncoding;
	}

	public function setWorksheetTitle($title)
	{
		$title = preg_replace('/[\\\\|:|\\/|\\?|\\*|\\[|\\]]/', '', $title);
		$title = substr($title, 0, 31);
		$this->sWorksheetTitle = $title;
	}

	private function addRow($array)
	{
		$cells = '';

		foreach ($array as $k => $v ) {
			$type = 'String';
			if (($this->bConvertTypes === true) && is_numeric($v)) {
				$type = 'Number';
			}

			$v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
			$cells .= '<Cell><Data ss:Type="' . $type . '">' . $v . '</Data></Cell>' . "\n";
		}

		$this->lines[] = '<Row>' . "\n" . $cells . '</Row>' . "\n";
	}

	public function addArray($array)
	{
		foreach ($array as $k => $v ) {
			$this->addRow($v);
		}
	}

	public function generateXML($filename = 'excel-export')
	{
		$filename = preg_replace('/[^aA-zZ0-9\\_\\-]/', '', $filename);
		header('Content-Type: application/vnd.ms-excel; charset=' . $this->sEncoding);
		header('Content-Disposition: inline; filename="' . $filename . '.xls"');
		echo stripslashes(sprintf($this->header, $this->sEncoding));
		echo "\n" . '<Worksheet ss:Name="' . $this->sWorksheetTitle . '">' . "\n" . '<Table>' . "\n";

		foreach ($this->lines as $line ) {
			echo $line;
		}

		echo '</Table>' . "\n" . '</Worksheet>' . "\n";
		echo $this->footer;
	}
}


?>
