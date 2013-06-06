<?php 

class Insert extends CI_Controller
{
	public function index()
	{
		$path = './books.csv'; 
		$this->load->library('ExceltoMysql',$path);
		$this->exceltomysql->setFilePath($path);
		$this->exceltomysql->InsertToMysql();

	}
}
?>
